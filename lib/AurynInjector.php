<?php

namespace Auryn;

/**
 * The Provider exposes functionality for defining context-wide instantiation, instance sharing,
 * implementation and delegation rules for injecting and automatically provisioning deeply nested
 * class dependencies.
 */
class AurynInjector implements Injector {

    const RAW_INJECTION_PREFIX = ':';

    const E_MAKE_FAILURE = 0;
    const E_DELEGATION_FAILURE = 1;
    const E_INVALID_CLASS = 2;
    const E_CLASS_NOT_FOUND = 3;
    const E_RAW_PREFIX = 4;
    const E_NON_EMPTY_STRING_ALIAS = 5;
    const E_SHARE_ARGUMENT = 6;
    const E_DELEGATE_ARGUMENT = 7;
    const E_CALLABLE = 8;
    const E_BAD_IMPLEMENTATION = 9;
    const E_BAD_PARAM_IMPLEMENTATION = 10;
    const E_UNDEFINED_PARAM = 11;
    const E_NEEDS_DEFINITION = 12;
    const E_CYCLIC_DEPENDENCY = 13;
    const E_ALIASED_CANNOT_SHARE = 14;
    const E_SHARED_CANNOT_ALIAS = 15;
    const E_NON_PUBLIC_CONSTRUCTOR = 16;
    const E_NOT_EXECUTABLE = 17;

    /** @var  \Auryn\Plugin\ProviderInjectionPlugin */
    private $providerPlugin;
    
    /** @var ReflectionStorage */
    private $reflectionStorage;

    /** @var ExecutableFactory  */
    private $executableFactory;

    /** @var array List of the typename of the objects being created, in hierarchy */
    private $classConstructorChain = array();

    public static $errorMessages = array(
        self::E_MAKE_FAILURE => "Could not make %s: %s",
        self::E_DELEGATION_FAILURE => 'Delegation failed while attempting to provision %s',
        self::E_INVALID_CLASS => 'Delegate callable must return an instance of %s; %s returned',
        self::E_CLASS_NOT_FOUND => 'Provider instantiation failure: %s doesn\'t exist and could not be found by any registered autoloaders',
        self::E_RAW_PREFIX => 'Invalid injection definition for parameter %s; raw parameter names must be prefixed with `:` (:$s) to differentiate them from provisionable type-hints.',
        self::E_NON_EMPTY_STRING_ALIAS => 'Invalid alias: non-empty string required at both Argument 1 and Argument 2',
        self::E_SHARE_ARGUMENT => '%s::share() requires a string class name or object instance at Argument 1; %s specified',
        self::E_DELEGATE_ARGUMENT => '%s::delegate expects a valid callable or provisionable executable class or method reference at Argument 2',
        self::E_CALLABLE => 'Invalid executable: callable, invokable class name or array in the form [className, methodName] required',
        self::E_BAD_IMPLEMENTATION => 'Bad implementation: %s does not implement %s',
        self::E_BAD_PARAM_IMPLEMENTATION => 'Bad implementation definition encountered while attempting to provision non-concrete parameter %s of type %s',
        self::E_UNDEFINED_PARAM => 'No definition available while attempting to provision typeless non-concrete parameter for %s(%s)',
        self::E_NEEDS_DEFINITION => 'Injection definition/implementation required for non-concrete parameter $%s of type %s',
        self::E_CYCLIC_DEPENDENCY => "Detected a cyclic dependency while provisioning %s",
        self::E_ALIASED_CANNOT_SHARE => 'Cannot share class %s, it has already been aliased to %s',
        self::E_SHARED_CANNOT_ALIAS => 'Cannot alias class %s to %s, it has already been shared.',
        self::E_NON_PUBLIC_CONSTRUCTOR => 'Cannot instantiate class %s; constructor method is protected/private'
    );


    public function __construct(
        \Auryn\Plugin\ProviderInjectionPlugin $providerPlugin, 
        ReflectionStorage $reflectionStorage = NULL) {
        $this->providerPlugin = $providerPlugin;
        $this->reflectionStorage = $reflectionStorage ?: new ReflectionPool;
        $this->executableFactory = new ExecutableFactory($this, $this->reflectionStorage);
    }

    private function resetClassConstructorChain() {
        $this->classConstructorChain = array();
    }

    /**
     * Instantiate a class according to a predefined or custom call-time injection definition
     *
     * @param string $className The class to provision
     * @param array  $customDefinition An optional array of one-time instantiation parameters
     * @throws \Auryn\InjectionException
     * @return mixed A provisioned instance of the $className class
     */
    public function make($className, array $customDefinition = array()) {
        $this->resetClassConstructorChain();
        return $this->makeInternal($className, $customDefinition);
    }

    private function makeInternal($className, array $customDefinition = array()) {
        list($className, $normalizedClass) = $this->providerPlugin->resolveAlias($className, $this->classConstructorChain);

        $this->guardAgainstCyclicDependency($className, $normalizedClass);

        $provisionedObject = $this->makeClass($className, $normalizedClass, $customDefinition);
        $this->providerPlugin->shareIfNeeded($normalizedClass, $provisionedObject, $this->classConstructorChain);
        $this->prepareInstance($normalizedClass, $provisionedObject);
        $this->unguardAgainstCyclicDependency();

        return $provisionedObject;
    }


    /**
     * Invoke the specified callable or class/method array, provisioning dependencies along the way
     *
     * @param mixed $callableOrMethodArr Valid PHP callable or an array of the form [class, method]
     * @param array $invocationArgs Optional array specifying params to invoke the provisioned callable
     * @param bool $makeAccessible If TRUE, protected/private methods will execute successfully
     * @throws \Auryn\BadArgumentException
     * @throws \Auryn\InjectionException
     * @return mixed Returns the invocation result from the generated executable
     */
    public function execute($callableOrMethodArr, array $invocationArgs = array(), $makeAccessible = FALSE) {
        $this->resetClassConstructorChain();
        return $this->executeInternal($callableOrMethodArr, $invocationArgs, $makeAccessible);
    }

    private function executeInternal($callableOrMethodArr, array $invocationArgs = array(), $makeAccessible = FALSE) {
        $executable = $this->buildExecutable($callableOrMethodArr, $makeAccessible);
        $reflectionFunction = $executable->getReflection();
        $args = $this->generateInvocationArgs($reflectionFunction, $invocationArgs);

        return call_user_func_array(array($executable, '__invoke'), $args);
    }

    
    /**
     * Generate and provision an executable object from any PHP callable or class/method string array
     *
     * @param mixed $callableOrMethodArr Valid PHP callable or an array of the form [class, method]
     * @param bool $makeAccessible If TRUE, protected/private methods will execute successfully
     * @throws \Auryn\BadArgumentException
     * @throws \Auryn\InjectionException
     * @return \Auryn\Executable Returns an executable object
     */
    public function buildExecutable($callableOrMethodArr, $makeAccessible = FALSE) {
        $makeAccessible = (bool)$makeAccessible;
        
        return $this->executableFactory->generateExecutableReflection(
            $callableOrMethodArr, 
            $makeAccessible
        );
    }


    /**
     * @param $className
     * @param array $definition
     * @return mixed
     */
    protected function getInjectedInstance($className, array $definition) {
        try {
            $ctorMethod = $this->reflectionStorage->getConstructor($className);

            if (!$ctorMethod) {
                $object = $this->buildWithoutConstructorParams($className);
            } elseif (!$ctorMethod->isPublic()) {
                throw new InjectionException(
                    sprintf(self::$errorMessages[self::E_NON_PUBLIC_CONSTRUCTOR], $className),
                    self::E_NON_PUBLIC_CONSTRUCTOR
                );
            } elseif ($ctorParams = $this->reflectionStorage->getConstructorParameters($className)) {
                $args = $this->generateInvocationArgs($ctorMethod, $definition);
                $reflectionClass = $this->reflectionStorage->getClass($className);
                $object = $reflectionClass->newInstanceArgs($args);
            } else {
                $object = $this->buildWithoutConstructorParams($className);
            }

            return $object;

        } catch (\ReflectionException $e) {
            throw new InjectionException(
                sprintf(self::$errorMessages[self::E_MAKE_FAILURE], $className, $e->getMessage()),
                self::E_MAKE_FAILURE,
                $e
            );
        }
    }

    private function prepareInstance($normalizedClass, $obj) {
        $preparer = $this->providerPlugin->getPrepareDefine($normalizedClass, $this->classConstructorChain);
        if ($preparer) {
            $exe = $this->buildExecutable($preparer);
            $exe($obj, $this);
        }

        if ($interfacesImplemented = class_implements($obj)) {
            $interfacePrepares = $this->providerPlugin->getInterfacePrepares($interfacesImplemented);
            foreach ($interfacePrepares as $preparer) {
                $exe = $this->buildExecutable($preparer);
                $exe($obj, $this);
            }
        }
    }
    
    private function guardAgainstCyclicDependency($className, $normalizedClass) {
        if (in_array($normalizedClass, $this->classConstructorChain)) {
            throw new CyclicDependencyException(
                $className,
                sprintf(self::$errorMessages[self::E_CYCLIC_DEPENDENCY], $className),
                self::E_CYCLIC_DEPENDENCY
            );
        }
        $this->classConstructorChain[] = $normalizedClass;
    }

    private function unguardAgainstCyclicDependency() {
        array_pop($this->classConstructorChain);
    }

    private function provisionFromDelegate($className) {
        list($delegate, $args) = $this->providerPlugin->getDelegated($className, $this->classConstructorChain);
        $provisionedObject = $this->executeInternal($delegate, $args);

        if (!$provisionedObject instanceof $className) {
            throw new InjectionException(
                sprintf(self::$errorMessages[self::E_INVALID_CLASS], $className, get_class($provisionedObject)),
                self::E_INVALID_CLASS
            );
        }

        return $provisionedObject;
    }


    /**
     * @param $className
     * @param array $customDefinition
     * @return mixed
     */
    private function provisionInstance($className, array $customDefinition) {
        
        try {
            $injectionDefinition = $this->selectClassDefinition($className, $customDefinition);
            return $this->getInjectedInstance($className, $injectionDefinition);
        } catch (CyclicDependencyException $e) {
            $cycleDetector = $e->getCycleDetector();

            throw new CyclicDependencyException(
                $cycleDetector,
                sprintf(self::$errorMessages[self::E_CYCLIC_DEPENDENCY], $className),
                self::E_CYCLIC_DEPENDENCY,
                $e
            );
        }
    }


    private function selectClassDefinition($className, $customDefinition) {
        $definitions = $this->selectParentDefinition($className, $this->providerPlugin->getDefinition($className, $this->classConstructorChain));

        return array_merge($definitions, $customDefinition);
    }


    private function selectParentDefinition($className, $childDefinition) {
        try {
            $classReflector = $this->reflectionStorage->getClass($className);
            $parent = $classReflector->getParentClass();

            return $parent
                ? $this->selectParentDefinition($parent->getName(), $childDefinition)
                : array_merge($this->providerPlugin->getDefinition($className, $this->classConstructorChain), $childDefinition);

        } catch (\ReflectionException $e) {
            throw new InjectionException(
                sprintf(self::$errorMessages[self::E_CLASS_NOT_FOUND], $className),
                self::E_CLASS_NOT_FOUND,
                $e
            );
        }
    }


    private function generateExecutableFromArray($arrayExecutable) {
        list($classOrObj, $method) = $arrayExecutable;

        if (is_object($classOrObj) && method_exists($classOrObj, $method)) {
            $callableRefl = $this->reflectionStorage->getMethod($classOrObj, $method);
            $executableArr = array($callableRefl, $classOrObj);
        } elseif (is_string($classOrObj)) {
            list($className, $normalizedClass) = $this->providerPlugin->resolveAlias(
                $classOrObj, $this->classConstructorChain
            );
            $executableArr = $this->generateStringClassMethodCallable($className, $method);
        } else {
            throw new BadArgumentException(
                self::$errorMessages[self::E_CALLABLE],
                self::E_CALLABLE
            );
        }

        return $executableArr;
    }

    private function generateStringClassMethodCallable($class, $method) {
        $relativeStaticMethodStartPos = strpos($method, 'parent::');

        if ($relativeStaticMethodStartPos === 0) {
            $childReflection = $this->reflectionStorage->getClass($class);
            $class = $childReflection->getParentClass()->name;
            $method = substr($method, $relativeStaticMethodStartPos + 8);
        }

        $reflectionMethod = $this->reflectionStorage->getMethod($class, $method);

        return $reflectionMethod->isStatic()
            ? array($reflectionMethod, NULL)
            : array($reflectionMethod, $this->makeInternal($class));
    }


    private function generateInvocationArgs(\ReflectionFunctionAbstract $function, array $definition) {
        $invocationArgs = array();

        // @TODO store this in ReflectionStorage
        $reflectionParams = $function->getParameters();

        foreach ($reflectionParams as $param) {
            $rawParamKey = self::RAW_INJECTION_PREFIX . $param->name;

            if (isset($definition[$param->name])) {
                $argument = $this->makeInternal($definition[$param->name]);
            } elseif (array_key_exists($rawParamKey, $definition)) {
                $argument = $definition[$rawParamKey];
            } elseif (!$argument = $this->buildArgumentFromTypeHint($function, $param)) {
                $argument = $this->buildArgumentFromReflectionParameter($param);
            }

            $invocationArgs[] = $argument;
        }

        return $invocationArgs;
    }


    private function buildArgumentFromReflectionParameter(\ReflectionParameter $param) {
        
        if ($this->providerPlugin->isParamDefined($param->name, $this->classConstructorChain)) {
            list(, $argument) = $this->providerPlugin->getParamDefine($param->name, $this->classConstructorChain);
        } elseif ($delegation = $this->providerPlugin->getParamDelegation($param->name, $this->classConstructorChain)) {
            list($delegate, $args) = $delegation;
            $argument = $this->executeInternal($delegate, $args);
        } elseif ($param->isDefaultValueAvailable()) {
            $argument = $param->getDefaultValue();
        } elseif ($param->isOptional()) {
            // This branch is required to work around PHP bugs where a parameter is optional
            // but has no default value available through reflection. Specifically, PDO exhibits
            // this behavior.
            $argument = NULL;
        } else {

            $declaringContext = 'Unknown';
 
            if ($declaringClass = $param->getDeclaringClass()) {
                $declaringContext = sprintf( 
                    "%s::%s",
                    $declaringClass->getName(),
                    $param->getDeclaringFunction()->getName()
                );
            }
            else if ($declaringFunction = $param->getDeclaringFunction()) {
                $declaringContext = sprintf(
                    "`function %s file %s line %s`",
                    $declaringFunction->getName(),
                    $declaringFunction->getFileName(),
                    $declaringFunction->getStartLine()
                );
            }

            throw new InjectionException(
                sprintf(self::$errorMessages[self::E_UNDEFINED_PARAM], $declaringContext, $param->name),
                self::E_UNDEFINED_PARAM
            );
        }

        return $argument;
    }

    private function buildWithoutConstructorParams($className) {
        if ($this->isInstantiable($className)) {
            $object = new $className;
        } else {
            $reflectionClass = $this->reflectionStorage->getClass($className);
            $type = $reflectionClass->isInterface() ? 'interface' : 'abstract';
            throw new InjectionException(
                sprintf(self::$errorMessages[self::E_NEEDS_DEFINITION], $type, $className),
                self::E_NEEDS_DEFINITION
            );
        }

        return $object;
    }


    private function isInstantiable($className) {
        $reflectionInstance = $this->reflectionStorage->getClass($className);

        return $reflectionInstance->isInstantiable();
    }


    private function buildArgumentFromTypeHint(\ReflectionFunctionAbstract $function, \ReflectionParameter $param) {
        $typeHint = $this->reflectionStorage->getParamTypeHint($function, $param);

        if (!$typeHint) {
            return NULL;
        }

        if ($param->isDefaultValueAvailable()) {
            $normalizedClassname = $this->providerPlugin->normalizeClassName($typeHint);

            //If it's already been shared to an instance, return that
            $object = $this->providerPlugin->getShared($normalizedClassname, $this->classConstructorChain);

            if ($object) {
                return $object;
            }
            
            //TODO - add if aliased then use that otherwise default.

            return $param->getDefaultValue();
        } else {
            return $this->makeInternal($typeHint);
        }
    }

    private function makeClass($className, $normalizedClass, array $customDefinition) {
        // isset() is used specifically here instead of $this->isShared() because classes may be
        // marked as "shared" before an instance is stored. In these cases the class is "shared,"
        // but it has a NULL value and instantiation is needed.

        if ($provisionedObject = $this->providerPlugin->getShared($normalizedClass, $this->classConstructorChain)){
            //nothing to do.
        } elseif ($this->providerPlugin->isDelegated($normalizedClass, $this->classConstructorChain)) {
            $provisionedObject = $this->provisionFromDelegate($className);
        } else {
            $provisionedObject = $this->provisionInstance($className, $customDefinition);
        }
        return $provisionedObject;
    }
    
}
