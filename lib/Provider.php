<?php

namespace Auryn;

/**
 * The Provider exposes functionality for defining context-wide instantiation, instance sharing,
 * implementation and delegation rules for injecting and automatically provisioning deeply nested
 * class dependencies.
 */
class Provider implements Injector {

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

    private $reflectionStorage;
    private $aliases = array();
    private $prepares = array();
    private $sharedClasses = array();
    private $delegatedClasses = array();
    private $beingProvisioned = array();
    private $paramDefinitions = array();
    private $injectionDefinitions = array();
    private $errorMessages = array(
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
        self::E_UNDEFINED_PARAM => 'No definition available while attempting to provision typeless non-concrete parameter %s(%s)',
        self::E_NEEDS_DEFINITION => 'Injection definition/implementation required for non-concrete parameter $%s of type %s',
        self::E_CYCLIC_DEPENDENCY => "Detected a cyclic dependency while provisioning %s",
        self::E_ALIASED_CANNOT_SHARE => 'Cannot share class %s, it has already been aliased to %s',
        self::E_SHARED_CANNOT_ALIAS => 'Cannot alias class %s to %s, it has already been shared.',
        self::E_NON_PUBLIC_CONSTRUCTOR => 'Cannot instantiate class %s; constructor method is protected/private'
    );


    public function __construct(ReflectionStorage $reflectionStorage = NULL) {
        $this->reflectionStorage = $reflectionStorage ?: new ReflectionPool;
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
        list($className, $normalizedClass) = $this->resolveAliasIfNeeded($className);
        $this->guardAgainstCyclicDependency($className, $normalizedClass);

        $provisionedObject = $this->makeClass($className, $normalizedClass, $customDefinition);
        $this->shareIfNeeded($normalizedClass, $provisionedObject);
        $this->prepareIfNeeded($normalizedClass, $provisionedObject);

        $this->unguardAgainstCyclicDependency($normalizedClass);
        return $provisionedObject;
    }


    /**
     * Defines a custom injection definition for the specified class
     *
     * @param string $className
     * @param array $injectionDefinition An associative array matching constructor params to values
     * @throws \Auryn\BadArgumentException On missing raw injection prefix
     * @return \Auryn\Provider Returns the current instance
     */
    public function define($className, array $injectionDefinition) {
        $this->validateInjectionDefinition($injectionDefinition);
        $normalizedClass = $this->normalizeClassName($className);
        $this->injectionDefinitions[$normalizedClass] = $injectionDefinition;

        return $this;
    }


    /**
     * Assign a global default value for all parameters named $paramName
     *
     * Global parameter definitions are only used for parameters with no typehint, pre-defined or
     * call-time definition.
     *
     * @param string $paramName The parameter name for which this value applies
     * @param mixed $value The value to inject for this parameter name
     * @return \Auryn\Provider Returns the current instance
     */
    public function defineParam($paramName, $value) {
        $this->paramDefinitions[$paramName] = $value;

        return $this;
    }


    /**
     * Defines an alias class name for all occurrences of a given typehint
     *
     * @param string $typehintToReplace
     * @param string $alias
     * @throws InjectionException
     * @throws BadArgumentException On non-empty string argument
     * @return \Auryn\Provider Returns the current instance
     */
    public function alias($typehintToReplace, $alias) {
        if (empty($typehintToReplace) || !is_string($typehintToReplace)) {
            throw new BadArgumentException(
                $this->errorMessages[self::E_NON_EMPTY_STRING_ALIAS],
                self::E_NON_EMPTY_STRING_ALIAS
            );
        } elseif (empty($alias) || !is_string($alias)) {
            throw new BadArgumentException(
                $this->errorMessages[self::E_NON_EMPTY_STRING_ALIAS],
                self::E_NON_EMPTY_STRING_ALIAS
            );
        }

        $normalizedTypehint = $this->normalizeClassName($typehintToReplace);
        $normalizedAlias = $this->normalizeClassName($alias);

        if (isset($this->sharedClasses[$normalizedTypehint])) {
            $sharedClassName = $this->normalizeClassName(get_class($this->sharedClasses[$normalizedTypehint]));
            throw new InjectionException(
                sprintf($this->errorMessages[self::E_SHARED_CANNOT_ALIAS], $sharedClassName, $alias),
                self::E_SHARED_CANNOT_ALIAS
            );
        } else {
            $this->aliases[$normalizedTypehint] = $alias;
        }

        if (array_key_exists($normalizedTypehint, $this->sharedClasses)) {
            $this->sharedClasses[$normalizedAlias] = $this->sharedClasses[$normalizedTypehint];
            unset($this->sharedClasses[$normalizedTypehint]);
        }

        return $this;
    }


    /**
     * Stores a shared instance of the specified class
     *
     * If an instance of the class is specified, it will be stored and shared
     * for calls to `Provider::make` for that class until the shared instance
     * is manually removed or refreshed.
     *
     * If a string class name is specified, the Provider will mark the class
     * as "shared" and the next time the Provider is used to instantiate the
     * class it's instance will be stored and shared.
     *
     * @param mixed $classNameOrInstance
     * @throws InjectionException
     * @throws BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    public function share($classNameOrInstance) {
        if (is_string($classNameOrInstance)) {
            $this->shareClass($classNameOrInstance);
        } elseif (is_object($classNameOrInstance)) {
            $this->shareObject($classNameOrInstance);
        } else {
            throw new BadArgumentException(
                sprintf($this->errorMessages[self::E_SHARE_ARGUMENT], __CLASS__, gettype($classNameOrInstance)),
                self::E_SHARE_ARGUMENT
            );
        }

        return $this;
    }


    /**
     * Unshares the specified class (or the class of the specified object)
     *
     * @param mixed $classNameOrInstance Class name or object instance
     * @return \Auryn\Provider Returns the current instance
     */
    public function unshare($classNameOrInstance) {
        $className = is_object($classNameOrInstance)
            ? get_class($classNameOrInstance)
            : $classNameOrInstance;
        $className = $this->normalizeClassName($className);

        unset($this->sharedClasses[$className]);

        return $this;
    }


    /**
     * Forces re-instantiation of a shared class the next time it's requested
     *
     * @param mixed $classNameOrInstance Class name or instance
     * @return \Auryn\Provider Returns the current instance
     */
    public function refresh($classNameOrInstance) {
        if (is_object($classNameOrInstance)) {
            $classNameOrInstance = get_class($classNameOrInstance);
        }
        $className = $this->normalizeClassName($classNameOrInstance);
        if (isset($this->sharedClasses[$className])) {
            $this->sharedClasses[$className] = NULL;
        }

        return $this;
    }


    /**
     * Delegates the creation of $class to $callable. Passes $class to $callable as the only argument
     *
     * @param string $className
     * @param callable $callable
     * @param array $args [optional]
     * @throws BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    public function delegate($className, $callable, array $args = array()) {
        if ($this->canExecute($callable)) {
            $delegate = array($callable, $args);
        } else {
            throw new BadArgumentException(
                sprintf($this->errorMessages[self::E_DELEGATE_ARGUMENT], __CLASS__),
                self::E_DELEGATE_ARGUMENT
            );
        }

        $normalizedClass =$this->normalizeClassName($className);
        $this->delegatedClasses[$normalizedClass] = $delegate;

        return $this;
    }


    /**
     * Register a mutator callable to modify objects after instantiation
     *
     * @param string $classInterfaceOrTraitName
     * @param mixed $executable Any callable or provisionable executable method
     * @throws \Auryn\BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    public function prepare($classInterfaceOrTraitName, $executable) {
        if (!$this->canExecute($executable)) {
            throw new BadArgumentException(
                $this->errorMessages[self::E_CALLABLE],
                self::E_CALLABLE
            );
        }

        $normalizedName = $this->normalizeClassName($classInterfaceOrTraitName);
        $this->prepares[$normalizedName] = $executable;

        return $this;
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
        $executable = $this->buildExecutable($callableOrMethodArr, $makeAccessible);
        $reflectionFunction = $executable->getCallableReflection();
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
        $executableArr = $this->generateExecutableReflection($callableOrMethodArr);
        list($reflectionFunction, $invocationObject) = $executableArr;

        if ($makeAccessible
            && $reflectionFunction instanceof \ReflectionMethod
            && !$reflectionFunction->isPublic()
        ) {
            $reflectionFunction->setAccessible(TRUE);
        }

        return new Executable($reflectionFunction, $invocationObject);
    }


    protected function getInjectedInstance($className, array $definition) {
        try {
            $ctorMethod = $this->reflectionStorage->getConstructor($className);

            if (!$ctorMethod) {
                $object = $this->buildWithoutConstructorParams($className);
            } elseif (!$ctorMethod->isPublic()) {
                throw new InjectionException(
                    sprintf($this->errorMessages[self::E_NON_PUBLIC_CONSTRUCTOR], $className),
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
                sprintf($this->errorMessages[self::E_MAKE_FAILURE], $className, $e->getMessage()),
                self::E_MAKE_FAILURE,
                $e
            );
        }
    }


    private function canExecute($exe) {
        if (is_callable($exe)) {
            return TRUE;
        }

        if (is_string($exe) && method_exists($exe, '__invoke')) {
            return TRUE;
        }

        if (is_array($exe) && isset($exe[0], $exe[1]) && method_exists($exe[0], $exe[1])) {
            return TRUE;
        }

        return FALSE;
    }


    private function prepareInstance($obj, $normalizedClass) {
        if (isset($this->prepares[$normalizedClass])) {
            $preparer = $this->prepares[$normalizedClass];
            $exe = $this->buildExecutable($preparer);
            $exe($obj, $this);
        }

        if ($interfacesImplemented = class_implements($obj)) {
            $interfacesImplemented = array_flip(array_map(array($this, 'normalizeClassName'), $interfacesImplemented));
            $interfacePrepares = array_intersect_key($this->prepares, $interfacesImplemented);
            foreach ($interfacePrepares as $preparer) {
                $exe = $this->buildExecutable($preparer);
                $exe($obj, $this);
            }
        }
    }


    private function validateInjectionDefinition(array $injectionDefinition) {
        foreach ($injectionDefinition as $paramName => $value) {
            if ($paramName[0] !== self::RAW_INJECTION_PREFIX && !is_string($value)) {
                throw new BadArgumentException(
                    sprintf($this->errorMessages[self::E_RAW_PREFIX], $paramName, $paramName),
                    self::E_RAW_PREFIX
                );
            }
        }
    }


    private function generateExecutableReflection($exeCallable) {
        if (is_string($exeCallable)) {
            $executableArr = $this->generateExecutableFromString($exeCallable);
        } elseif ($exeCallable instanceof \Closure) {
            $callableRefl = new \ReflectionFunction($exeCallable);
            $executableArr = array($callableRefl, NULL);
        } elseif (is_object($exeCallable) && is_callable($exeCallable)) {
            $invocationObj = $exeCallable;
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            $executableArr = array($callableRefl, $invocationObj);
        } elseif (is_array($exeCallable)
            && isset($exeCallable[0], $exeCallable[1])
            && count($exeCallable) === 2
        ) {
            $executableArr = $this->generateExecutableFromArray($exeCallable);
        } else {
            throw new BadArgumentException(
                $this->errorMessages[self::E_CALLABLE],
                self::E_CALLABLE
            );
        }

        return $executableArr;
    }


    private function guardAgainstCyclicDependency($className, $normalizedClass) {
        if (isset($this->beingProvisioned[$normalizedClass])) {
            throw new CyclicDependencyException(
                $className,
                sprintf($this->errorMessages[self::E_CYCLIC_DEPENDENCY], $className),
                self::E_CYCLIC_DEPENDENCY
            );
        }

        $this->beingProvisioned[$normalizedClass] = TRUE;
    }


    private function unguardAgainstCyclicDependency($normalizedClass) {
        unset($this->beingProvisioned[$normalizedClass]);
    }


    private function provisionFromDelegate($className) {
        $normalizedClass = $this->normalizeClassName($className);

        list($delegate, $args) = $this->delegatedClasses[$normalizedClass];

        $provisionedObject = $this->execute($delegate, $args);

        if (!$provisionedObject instanceof $className) {
            throw new InjectionException(
                sprintf($this->errorMessages[self::E_INVALID_CLASS], $className, get_class($provisionedObject)),
                self::E_INVALID_CLASS
            );
        }

        return $provisionedObject;
    }


    private function provisionInstance($className, array $customDefinition) {
        $normalizedClass = $this->normalizeClassName($className);
        try {
            $injectionDefinition = $this->selectClassDefinition($className, $customDefinition);

            return $this->getInjectedInstance($className, $injectionDefinition);

        } catch (CyclicDependencyException $e) {
            unset($this->beingProvisioned[$normalizedClass]);
            $cycleDetector = $e->getCycleDetector();

            throw new CyclicDependencyException(
                $cycleDetector,
                sprintf($this->errorMessages[self::E_CYCLIC_DEPENDENCY], $className),
                self::E_CYCLIC_DEPENDENCY,
                $e
            );
        }
    }


    private function selectClassDefinition($className, $customDefinition) {
        $definitions = $this->selectParentDefinition($className, $this->getDefinition($className));

        return array_merge($definitions, $customDefinition);
    }


    private function selectParentDefinition($className, $childDefinition) {
        try {
            $classReflector = $this->reflectionStorage->getClass($className);
            $parent = $classReflector->getParentClass();

            return $parent
                ? $this->selectParentDefinition($parent->getName(), $childDefinition)
                : array_merge($this->getDefinition($className), $childDefinition);

        } catch (\ReflectionException $e) {
            throw new InjectionException(
                sprintf($this->errorMessages[self::E_CLASS_NOT_FOUND], $className),
                self::E_CLASS_NOT_FOUND,
                $e
            );
        }
    }


    private function getDefinition($className) {
        $normalizedClass = $this->normalizeClassName($className);

        return $this->isDefined($normalizedClass)
            ? $this->injectionDefinitions[$normalizedClass]
            : array();
    }


    private function isDefined($className) {
        $normalizedClass = $this->normalizeClassName($className);

        return isset($this->injectionDefinitions[$normalizedClass]);
    }


    private function isShared($className) {
        $normalizedClass = $this->normalizeClassName($className);

        return array_key_exists($normalizedClass, $this->sharedClasses);
    }


    private function generateExecutableFromArray($arrayExecutable) {
        list($classOrObj, $method) = $arrayExecutable;

        if (is_object($classOrObj) && method_exists($classOrObj, $method)) {
            $callableRefl = $this->reflectionStorage->getMethod($classOrObj, $method);
            $executableArr = array($callableRefl, $classOrObj);
        } elseif (is_string($classOrObj)) {
            $executableArr = $this->generateStringClassMethodCallable($classOrObj, $method);
        } else {
            throw new BadArgumentException(
                $this->errorMessages[self::E_CALLABLE],
                self::E_CALLABLE
            );
        }

        return $executableArr;
    }


    private function generateExecutableFromString($stringExecutable) {
        if (function_exists($stringExecutable)) {
            $callableRefl = $this->reflectionStorage->getFunction($stringExecutable);
            $executableArr = array($callableRefl, NULL);
        } elseif (method_exists($stringExecutable, '__invoke')) {
            $invocationObj = $this->make($stringExecutable);
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            $executableArr = array($callableRefl, $invocationObj);
        } elseif (strpos($stringExecutable, '::') !== FALSE) {
            list($class, $method) = explode('::', $stringExecutable, 2);
            $executableArr = $this->generateStringClassMethodCallable($class, $method);
        } else {
            throw new BadArgumentException(
                $this->errorMessages[self::E_CALLABLE],
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
            : array($reflectionMethod, $this->make($class));
    }


    private function generateInvocationArgs(\ReflectionFunctionAbstract $function, array $definition) {
        $invocationArgs = array();

        // @TODO store this in ReflectionStorage
        $reflectionParams = $function->getParameters();

        foreach ($reflectionParams as $param) {
            $rawParamKey = self::RAW_INJECTION_PREFIX . $param->name;

            if (isset($definition[$param->name])) {
                $argument = $this->make($definition[$param->name]);
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
        if (array_key_exists($param->name, $this->paramDefinitions)) {
            $argument = $this->paramDefinitions[$param->name];
        } elseif ($param->isDefaultValueAvailable()) {
            $argument = $param->getDefaultValue();
        } elseif ($param->isOptional()) {
            // This branch is required to work around PHP bugs where a parameter is optional
            // but has no default value available through reflection. Specifically, PDO exhibits
            // this behavior.
            $argument = NULL;
        } else {
            $declaringClass = $param->getDeclaringClass()->getName();
            throw new InjectionException(
                sprintf($this->errorMessages[self::E_UNDEFINED_PARAM], $declaringClass, $param->name),
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
                sprintf($this->errorMessages[self::E_NEEDS_DEFINITION], $type, $className),
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
            $object = NULL;
        } elseif ($param->isDefaultValueAvailable()) {
            $object = $param->getDefaultValue();
        } else {
            $object = $this->make($typeHint);
        }

        return $object;
    }


    private function makeClass($className, $normalizedClass, array $customDefinition) {
        // isset() is used specifically here instead of $this->isShared() because classes may be
        // marked as "shared" before an instance is stored. In these cases the class is "shared,"
        // but it has a NULL value and instantiation is needed.
        if (isset($this->sharedClasses[$normalizedClass])) {
            $provisionedObject = $this->sharedClasses[$normalizedClass];
        } elseif (isset($this->delegatedClasses[$normalizedClass])) {
            $provisionedObject = $this->provisionFromDelegate($className);
        } else {
            $provisionedObject = $this->provisionInstance($className, $customDefinition);
        }
        return $provisionedObject;
    }


    private function resolveAliasIfNeeded($className) {
        $normalizedClass = $this->normalizeClassName($className);

        if (isset($this->aliases[$normalizedClass])) {
            $className = $this->aliases[$normalizedClass];
            $normalizedClass = $this->normalizeClassName($className);
        }
        return array($className, $normalizedClass);
    }


    private function shareIfNeeded($normalizedClass, $provisionedObject) {
        if ($this->isShared($normalizedClass)) {
            $this->sharedClasses[$normalizedClass] = $provisionedObject;
        }
    }


    /**
     * @param $normalizedClass
     * @param $provisionedObject
     */
    private function prepareIfNeeded($normalizedClass, $provisionedObject) {
        if ($this->prepares) {
            $this->prepareInstance($provisionedObject, $normalizedClass);
        }
    }


    private function shareClass($classNameOrInstance) {
        list(, $normalizedClass) = $this->resolveAliasIfNeeded($classNameOrInstance);

        $this->sharedClasses[$normalizedClass] = isset($this->sharedClasses[$normalizedClass])
            ? $this->sharedClasses[$normalizedClass]
            : NULL;
    }


    private function shareObject($classNameOrInstance) {
        $normalizedClass = $this->normalizeClassName(get_class($classNameOrInstance));
        if (isset($this->aliases[$normalizedClass])) {
            // You cannot share an instance of a class that has already been aliased to another class.
            throw new InjectionException(
                sprintf($this->errorMessages[self::E_ALIASED_CANNOT_SHARE], $normalizedClass, $this->aliases[$normalizedClass]),
                self::E_ALIASED_CANNOT_SHARE
            );
        }
        $this->sharedClasses[$normalizedClass] = $classNameOrInstance;
    }


    private function normalizeClassName($className) {
        return ltrim(strtolower($className), '\\');
    }


}
