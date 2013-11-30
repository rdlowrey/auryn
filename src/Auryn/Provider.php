<?php

namespace Auryn;

/**
 * A dependency injection container
 *
 * The Provider exposes functionality for defining context-wide instantiation, instance sharing,
 * implementation and delegation rules for injecting deeply nested class dependencies.
 */
class Provider implements Injector {

    const RAW_INJECTION_PREFIX = ':';

    private $injectionDefinitions = array();
    private $aliases = array();
    private $sharedClasses = array();
    private $delegatedClasses = array();
    private $reflectionStorage;
    private $beingProvisioned = array();
    private $paramDefinitions = array();

    const E_MAKE_FAILURE_CODE = 0;
    const E_MAKE_FAILURE_MESSAGE = "Could not make %s: %s";

    const E_DELEGATION_FAILURE_CODE = 1;
    const E_DELEGATION_FAILURE_MESSAGE = 'Delegation failed while attempting to provision %s';

    const E_INVALID_CLASS_CODE = 2;
    const E_INVALID_CLASS_MESSAGE = 'Delegate callable must return an instance of %s; %s returned';

    const E_CLASS_NOT_FOUND_CODE = 3;
    const E_CLASS_NOT_FOUND_MESSAGE = 'Provider instantiation failure: %s doesn\'t exist and could not be found by any registered autoloaders';

    const E_PREFIX_CODE = 4;
    const E_PREFIX_MESSAGE = 'Invalid injection definition for parameter %s; raw parameter names must be prefixed with `:` (:$s) to differentiate them from provisionable type-hints.';

    const E_NON_EMPTY_STRING_ALIAS_CODE = 5;
    const E_NON_EMPTY_STRING_ALIAS_MESSAGE = 'Invalid alias: non-empty string required at both Argument 1 and Argument 2';

    const E_SHARE_ARGUMENT_CODE = 6;
    const E_SHARE_ARGUMENT_MESSAGE = '%s::share() requires a string class name or object instance at Argument 1; %s specified';

    const E_DELEGATE_ARGUMENT_CODE = 7;
    const E_DELEGATE_ARGUMENT_MESSAGE = '%s::delegate expects a valid callable or provisionable executable class or method reference at Argument 2';

    const E_CALLABLE_CODE = 8;
    const E_CALLABLE_MESSAGE = 'Invalid executable: callable, invokable class name or array in the form [className, methodName] required';

    const E_NON_CONCRETE_PARAMETER_WITHOUT_ALIAS_CODE = 9;
    const E_NON_CONCRETE_PARAMETER_WITHOUT_ALIAS_MESSAGE = 'Cannot instantiate %s %s without an injection definition or implementation';

    const E_BAD_IMPLEMENTATION_CODE = 10;
    const E_BAD_IMPLEMENTATION_MESSAGE = 'Bad implementation: %s does not implement %s';

    const E_BAD_PARAM_IMPLEMENTATION_CODE = 11;
    const E_BAD_PARAM_IMPLEMENTATION_MESSAGE = 'Bad implementation definition encountered while attempting to provision non-concrete parameter %s of type %s';

    const E_UNDEFINED_PARAM_CODE = 12;
    const E_UNDEFINED_PARAM_MESSAGE = 'No definition available while attempting to provision typeless non-concrete parameter %s';

    const E_NEEDS_DEFINITION_CODE = 13;
    const E_NEEDS_DEFINITION_MESSAGE = 'Injection definition/implementation required for non-concrete parameter $%s of type %s';

    const E_CYCLIC_DEPENDENCY_CODE = 14;
    const E_CYCLIC_DEPENDENCY_MESSAGE = 'Detected a cyclic dependency while provisioning %s';

    const E_CANNOT_SHARE_ALREADY_ALIASED_CODE = 14;
    const E_CANNOT_SHARE_ALREADY_ALIASED_MESSAGE = 'Cannot share class %s, it has already been aliased to %s';

    const E_CANNOT_ALIAS_ALREADY_SHARED_CODE = 15;
    const E_CANNOT_ALIAS_ALREADY_SHARED_MESSAGE = 'Cannot alias class %s to %s, it has already been shared.';

    const E_NON_PUBLIC_CONSTRUCTOR = 16;
    const E_NON_PUBLIC_CONSTRUCTOR_MESSAGE = 'Cannot instantiate class %s; constructor method is protected/private';
    
    function __construct(ReflectionStorage $reflectionStorage = NULL) {
        $this->reflectionStorage = $reflectionStorage ?: new ReflectionPool;
    }

    /**
     * Instantiate a class according to a predefined or call-time injection definition
     *
     * @param string $className Class name
     * @param array  $customDefinition An optional array of custom instantiation parameters
     * @throws \Auryn\InjectionException
     * @return mixed A dependency-injected object
     */
    function make($className, array $customDefinition = array()) {
        $lowClass = strtolower($className);

        if (isset($this->aliases[$lowClass])) {
            $className = $this->aliases[$lowClass];
            $lowClass = strtolower($className);
        }

        $this->doCyclicDependencyCheck($className, $lowClass);

        // isset() is used specifically here instead of $this->isShared() because classes may be
        // marked as "shared" before an instance is stored. In these cases the class is "shared,"
        // but it has a NULL value and instantiation is needed.
        if (isset($this->sharedClasses[$lowClass])) {
            $provisionedObject = $this->sharedClasses[$lowClass];
        } elseif (isset($this->delegatedClasses[$lowClass])) {
            $provisionedObject = $this->provisionFromDelegate($className);
        } else {
            $provisionedObject = $this->provisionInstance($className, $customDefinition);
        }

        if ($this->isShared($lowClass)) {
            $this->sharedClasses[$lowClass] = $provisionedObject;
        }

        unset($this->beingProvisioned[$lowClass]);

        return $provisionedObject;
    }

    private function doCyclicDependencyCheck($className, $lowClass) {
        if (isset($this->beingProvisioned[$lowClass])) {
            throw new CyclicDependencyException(
                sprintf(self::E_CYCLIC_DEPENDENCY_MESSAGE, $className),
                self::E_CYCLIC_DEPENDENCY_CODE
            );
        }

        $this->beingProvisioned[$lowClass] = TRUE;
    }

    private function provisionFromDelegate($className) {
        $lowClass = strtolower($className);

        list($delegate, $args) = $this->delegatedClasses[$lowClass];

        $provisionedObject = $this->execute($delegate, $args);

        if (!$provisionedObject instanceof $className) {
            throw new InjectionException(
                sprintf(self::E_INVALID_CLASS_MESSAGE, $className, get_class($provisionedObject)),
                self::E_INVALID_CLASS_CODE
            );
        }

        return $provisionedObject;
    }

    private function provisionInstance($className, array $customDefinition) {
        try {
            $lowClass = strtolower($className);
            $injectionDefinition = $this->selectClassDefinition($className, $customDefinition);

            return $this->getInjectedInstance($className, $injectionDefinition);

        } catch (\ReflectionException $e) {
            unset($this->beingProvisioned[$lowClass]);
            throw new InjectionException(
                sprintf(self::E_MAKE_FAILURE_MESSAGE, $className, $e->getMessage()),
                self::E_MAKE_FAILURE_CODE,
                $e
            );
        } catch (CyclicDependencyException $e) {
            unset($this->beingProvisioned[$lowClass]);
            $cycleDetector = $e->getCycleDetector();
            if ($cycleDetector !== $className) {
                throw new CyclicDependencyException(
                    $cycleDetector,
                    sprintf(self::E_CYCLIC_DEPENDENCY_MESSAGE, $className),
                    self::E_CYCLIC_DEPENDENCY_CODE,
                    $e
                );
            }
            throw $e;
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
                sprintf(self::E_CLASS_NOT_FOUND_MESSAGE, $className),
                self::E_CLASS_NOT_FOUND_CODE,
                $e
            );
        }
    }

    private function getDefinition($className) {
        $lowClass = strtolower($className);

        if ($this->isDefined($lowClass)) {
            return $this->injectionDefinitions[$lowClass];
        } else {
            return array();
        }
    }

    private function isDefined($className) {
        $lowClass = strtolower($className);

        return isset($this->injectionDefinitions[$lowClass]);
    }

    private function isShared($className) {
        $lowClass = strtolower($className);

        return array_key_exists($lowClass, $this->sharedClasses);
    }

    /**
     * Defines a custom injection definition for the specified class
     *
     * @param string $className
     * @param array $injectionDefinition An associative array matching constructor params to values
     * @throws \Auryn\BadArgumentException On missing raw injection prefix
     * @return \Auryn\Provider Returns the current instance
     */
    function define($className, array $injectionDefinition) {
        $this->validateInjectionDefinition($injectionDefinition);
        $lowClass = strtolower($className);
        $this->injectionDefinitions[$lowClass] = $injectionDefinition;

        return $this;
    }

    /**
     * Sets the default value to be used where a parameter without typehinting with
     * the name '$paramName' needs to be injected, and has no other value available.
     * @param $paramName
     * @param $value
     */
    function defineParam($paramName, $value) {
        $this->paramDefinitions[$paramName] = $value;
    }

    private function validateInjectionDefinition(array $injectionDefinition) {
        foreach ($injectionDefinition as $paramName => $value) {
            if ($paramName[0] !== self::RAW_INJECTION_PREFIX && !is_string($value)) {
                throw new BadArgumentException(
                    sprintf(self::E_PREFIX_MESSAGE, $paramName, $paramName),
                    self::E_PREFIX_CODE
                );
            }
        }
    }

    /**
     * Defines an alias class name for all occurrences of a given typehint
     *
     * @param string $typehintToReplace
     * @param string $alias
     * @throws \Auryn\BadArgumentException On non-empty string argument
     * @return \Auryn\Provider Returns the current instance
     */
    function alias($typehintToReplace, $alias) {
        if (empty($typehintToReplace) || !is_string($typehintToReplace)) {
            throw new BadArgumentException(
                self::E_NON_EMPTY_STRING_ALIAS_MESSAGE,
                self::E_NON_EMPTY_STRING_ALIAS_CODE
            );
        } elseif (empty($alias) || !is_string($alias)) {
            throw new BadArgumentException(
                self::E_NON_EMPTY_STRING_ALIAS_MESSAGE,
                self::E_NON_EMPTY_STRING_ALIAS_CODE
            );
        }
        
        $lowTypehint = strtolower($typehintToReplace);
        $lowAlias = strtolower($alias);
        
        if (isset($this->sharedClasses[$lowTypehint])) {
            $sharedClassName = strtolower(get_class($this->sharedClasses[$lowTypehint]));
            throw new InjectionException(
                sprintf(self::E_CANNOT_ALIAS_ALREADY_SHARED_MESSAGE, $sharedClassName, $alias),
                self::E_CANNOT_ALIAS_ALREADY_SHARED_CODE
            );
        } elseif (array_key_exists($lowAlias, $this->sharedClasses)) {
            $this->sharedClasses[$lowTypehint] = $this->sharedClasses[$lowAlias];
            unset($this->sharedClasses[$lowAlias]);
        } else {
            $this->aliases[$lowTypehint] = $alias;
        }
        
        if (array_key_exists($lowTypehint, $this->sharedClasses)) {
            $this->sharedClasses[$lowAlias] = $this->sharedClasses[$lowTypehint];
            unset($this->sharedClasses[$lowTypehint]);
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
     * @throws \Auryn\BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    function share($classNameOrInstance) {
        if (is_string($classNameOrInstance)) {
            $lowClass = strtolower($classNameOrInstance);
            $lowClass = isset($this->aliases[$lowClass])
                ? strtolower($this->aliases[$lowClass])
                : $lowClass;

            $this->sharedClasses[$lowClass] = isset($this->sharedClasses[$lowClass])
                ? $this->sharedClasses[$lowClass]
                : NULL;
        } elseif (is_object($classNameOrInstance)) {
            $lowClass = strtolower(get_class($classNameOrInstance));
            if (isset($this->aliases[$lowClass])) {
                //You cannot share an instance of a class that has already been aliased to another class.
                throw new InjectionException(
                    sprintf(self::E_CANNOT_SHARE_ALREADY_ALIASED_MESSAGE, $lowClass, $this->aliases[$lowClass]),
                    self::E_CANNOT_SHARE_ALREADY_ALIASED_CODE
                );
            }
            $this->sharedClasses[$lowClass] = $classNameOrInstance;
        } else {
            throw new BadArgumentException(
                sprintf(self::E_SHARE_ARGUMENT_MESSAGE, __CLASS__, gettype($classNameOrInstance)),
                self::E_SHARE_ARGUMENT_CODE
            );
        }

        return $this;
    }

    /**
     * Unshares the specified class (or the class of the specified object)
     *
     * @param mixed $classNameOrObject Class name or object instance
     * @return \Auryn\Provider Returns the current instance
     */
    function unshare($classNameOrInstance) {
        $className = is_object($classNameOrInstance)
            ? get_class($classNameOrInstance)
            : $classNameOrInstance;
        $className = strtolower($className);

        unset($this->sharedClasses[$className]);

        return $this;
    }

    /**
     * Forces re-instantiation of a shared class the next time it's requested
     * 
     * @param mixed $classNameOrInstance Class name or instance
     * @return \Auryn\Provider Returns the current instance
     */
    function refresh($classNameOrInstance) {
        if (is_object($classNameOrInstance)) {
            $classNameOrInstance = get_class($classNameOrInstance);
        }
        $className = strtolower($classNameOrInstance);
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
     * @throws \Auryn\BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    function delegate($className, $callable, array $args = array()) {
        if (is_callable($callable)
            || (is_string($callable) && method_exists($callable, '__invoke'))
            || (is_array($callable) && isset($callable[0], $callable[1]) && method_exists($callable[0], $callable[1]))
        ) {
            $delegate = array($callable, $args);
        } else {
            throw new BadArgumentException(
                sprintf(self::E_DELEGATE_ARGUMENT_MESSAGE, __CLASS__),
                self::E_DELEGATE_ARGUMENT_CODE
            );
        }

        $lowClass = strtolower($className);
        $this->delegatedClasses[$lowClass] = $delegate;

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
    function execute($callableOrMethodArr, array $invocationArgs = array(), $makeAccessible = FALSE) {
        $executable = $this->getExecutable($callableOrMethodArr, $makeAccessible);
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
    function getExecutable($callableOrMethodArr, $makeAccessible = FALSE) {
        $makeAccessible = (bool) $makeAccessible;
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
                self::E_CALLABLE_MESSAGE,
                self::E_CALLABLE_CODE
            );
        }

        return $executableArr;
    }

    private function generateExecutableFromArray($arrayExecutable) {
        list($classOrObj, $method) = $arrayExecutable;

        if (is_object($classOrObj) && method_exists($classOrObj, $method)) {
            $callableRefl = $this->reflectionStorage->getMethod($classOrObj, $method);
            $executableArr = array($callableRefl, $classOrObj);
        } elseif (is_string($classOrObj)) {
            $executableArr = $this->generateStringClassMethodCallable($classOrObj, $method);
        } else {
            // @TODO maybe add new code/msg?
            throw new BadArgumentException(
                self::E_CALLABLE_MESSAGE,
                self::E_CALLABLE_CODE
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
            // @TODO maybe add new code/msg?
            throw new BadArgumentException(
                self::E_CALLABLE_MESSAGE,
                self::E_CALLABLE_CODE
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
        } else {
            throw new InjectionException(
                sprintf(self::E_UNDEFINED_PARAM_MESSAGE, $param->name),
                self::E_UNDEFINED_PARAM_CODE
            );
        }
        
        return $argument;
    }

    protected function getInjectedInstance($className, array $definition) {
        try {
            $ctorMethod = $this->reflectionStorage->getConstructor($className);
            
            if (!$ctorMethod) {
                $object = $this->buildWithoutConstructorParams($className);
            } elseif (!$ctorMethod->isPublic()) {
                throw new InjectionException(
                    sprintf(self::E_NON_PUBLIC_CONSTRUCTOR_MESSAGE, $className),
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
                sprintf(self::E_MAKE_FAILURE_MESSAGE, $className, $e->getMessage()),
                self::E_MAKE_FAILURE_CODE,
                $e
            );
        }
    }

    private function buildWithoutConstructorParams($className) {
        if ($this->isInstantiable($className)) {
            $object = new $className;
        } elseif (isset($this->aliases[strtolower($className)])) {
            $object = $this->buildNonConcreteImplementation($className);
        } else {
            $reflectionClass = $this->reflectionStorage->getClass($className);
            $type = $reflectionClass->isInterface() ? 'interface' : 'abstract';
            throw new InjectionException(
                sprintf(self::E_NON_CONCRETE_PARAMETER_WITHOUT_ALIAS_MESSAGE, $type, $className),
                self::E_NON_CONCRETE_PARAMETER_WITHOUT_ALIAS_CODE
            );
        }
        
        return $object;
    }

    private function isInstantiable($className) {
        $reflectionInstance = $this->reflectionStorage->getClass($className);
        
        return $reflectionInstance->isInstantiable();
    }

    private function buildNonConcreteImplementation($interfaceOrAbstractName) {
        $lowClass  = strtolower($interfaceOrAbstractName);
        $implClass = $this->aliases[$lowClass];
        $implObj   = $this->make($implClass);
        $implRefl  = $this->reflectionStorage->getClass($implClass);

        if (!$implRefl->isSubclassOf($interfaceOrAbstractName)) {
            throw new BadArgumentException(
                sprintf(self::E_BAD_IMPLEMENTATION_MESSAGE, $implRefl->name, $interfaceOrAbstractName),
                self::E_BAD_IMPLEMENTATION_CODE
            );
        }

        return $implObj;
    }

    private function buildArgumentFromTypeHint(\ReflectionFunctionAbstract $function, \ReflectionParameter $param) {
        $typeHint = $this->reflectionStorage->getParamTypeHint($function, $param);
        $typeHintLower = strtolower($typeHint);
        
        if (!$typeHint) {
            $object = NULL;
        } elseif ($this->isInstantiable($typeHint)
            || isset($this->aliases[$typeHintLower])
            || isset($this->delegatedClasses[$typeHintLower])
        ) {
            $object = $this->make($typeHint);
        } elseif ($param->isDefaultValueAvailable()) {
            $object = $param->getDefaultValue();
        } else {
            throw new InjectionException(
                sprintf(self::E_NEEDS_DEFINITION_MESSAGE, $param->getName(), $typeHint),
                self::E_NEEDS_DEFINITION_CODE
            );
        }
        
        return $object;
    }
}
