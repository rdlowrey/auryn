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
        
        try {
            // `isset` is used specifically here instead of `isShared` because classes may be marked
            // as "shared" before an instance is stored. In such cases, the class is shared, but
            // has a NULL value and must be instantiated by the Provider to create the shared instance.
            if (isset($this->sharedClasses[$lowClass])) {
                $provisionedObject = $this->sharedClasses[$lowClass];
            } elseif ($this->delegateExists($lowClass)) {
                $delegate = $this->delegatedClasses[$lowClass];
                $provisionedObject = $this->doDelegation($delegate, $className);
            } else {
                $injectionDefinition = $this->selectDefinition($className, $customDefinition);
                $provisionedObject = $this->getInjectedInstance($className, $injectionDefinition);
            }
        } catch(\ReflectionException $e){
            throw new InjectionException("Could not make $className: ".$e->getMessage(), $e->getCode(), $e);
        }

        if ($this->isShared($lowClass)) {
            $this->sharedClasses[$lowClass] = $provisionedObject;
        }

        return $provisionedObject;
    }
    
    private function delegateExists($class) {
        return isset($this->delegatedClasses[strtolower($class)]);
    }
    
    private function doDelegation(array $callable, $class) {
        try {
            $provisionedObject = $this->execute($callable[0], $callable[1]);
        } catch (\Exception $e) {
            throw new InjectionException(
                "Delegation failed while attempting to provision {$class}",
                0, $e
            );
        }
        
        if (!($provisionedObject instanceof $class)) {
            throw new InjectionException(
                "Delegate callable must return an instance of {$class}; " .
                get_class($provisionedObject) . ' returned'
            );
        }
        
        return $provisionedObject;
    }
    
    private function selectDefinition($className, $customDefinition) {
        $definitions = $this->selectParentDefinitions($className, $this->getDefinition($className));
        
        return array_merge($definitions, $customDefinition);
    }

    private function selectParentDefinitions($className, $childDefinition) {
        try {
            $classReflector = $this->reflectionStorage->getClass($className);
            $parent = $classReflector->getParentClass();
            if ($parent) {
                return $this->selectParentDefinitions($parent->getName(), $childDefinition);
            } else {
                return array_merge($this->getDefinition($className), $childDefinition);
            }
        } catch (\ReflectionException $e) {
            throw new InjectionException(
                "Provider instantiation failure: $className doesn't exist".
                ' and could not be found by any registered autoloaders.',
                0, $e
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
    
    private function validateInjectionDefinition(array $injectionDefinition) {
        foreach ($injectionDefinition as $paramName => $value) {
            if ($paramName[0] !== self::RAW_INJECTION_PREFIX && !is_string($value)) {
                throw new BadArgumentException(
                    "Invalid injection definition for parameter {$paramName}; raw parameter " .
                    "names must be prefixed with `:` (:{$paramName}) to differentiate them " .
                    'from provisionable type-hints.'
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
        if ($typehintToReplace && $alias && is_string($typehintToReplace) && is_string($alias)) {
            $typehintToReplace = strtolower($typehintToReplace);
            $this->aliases[$typehintToReplace] = $alias;

            //If the class has already been shared by name, replace that sharing entry
            //with one pointing to the aliased class name. 
            if (array_key_exists($typehintToReplace, $this->sharedClasses) == true) {
                $this->sharedClasses[strtolower($alias)] = $this->sharedClasses[$typehintToReplace];
                unset($this->sharedClasses[$typehintToReplace]);
            }
        } else {
            throw new BadArgumentException(
                'Invalid alias: non-empty string required at both Argument 1 and Argument 2'
            );
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
            $this->sharedClasses[$lowClass] = $classNameOrInstance;
        } else {
            $parameterType = gettype($classNameOrInstance);
            throw new BadArgumentException(
                get_class($this).'::share() requires a string class name or object instance at ' .
                'Argument 1; ' . gettype($classNameOrInstance) . ' specified'
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
     * @param string $class Class name
     * @return \Auryn\Provider Returns the current instance
     */
    function refresh($className) {
        $className = strtolower($className);
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
                get_class($this) . '::delegate expects a valid callable or provisionable executable ' .
                'class or method reference at Argument 2'
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
    
    private function generateExecutableReflection($callableOrMethodArr) {
        $isString = is_string($callableOrMethodArr);
        
        if ($callableOrMethodArr instanceof \Closure) {
            $callableRefl = new \ReflectionFunction($callableOrMethodArr);
            $executableArr = array($callableRefl, NULL);
        } elseif ($isString && function_exists($callableOrMethodArr)) {
            $callableRefl = $this->reflectionStorage->getFunction($callableOrMethodArr);
            $executableArr = array($callableRefl, NULL);
        } elseif ($isString && method_exists($callableOrMethodArr, '__invoke')) {
            $invocationObj = $this->make($callableOrMethodArr);
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            $executableArr = array($callableRefl, $invocationObj);
        } elseif ($isString && strpos($callableOrMethodArr, '::') !== FALSE) {
            list($staticClass, $staticMethod) = explode('::', $callableOrMethodArr, 2);
            $callableRefl = $this->generateStaticReflectionMethod($staticClass, $staticMethod);
            $executableArr = array($callableRefl, NULL);
        } elseif (is_object($callableOrMethodArr) && is_callable($callableOrMethodArr)) {
            $invocationObj = $callableOrMethodArr;
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            $executableArr = array($callableRefl, $invocationObj);
        } elseif (isset($callableOrMethodArr[0], $callableOrMethodArr[1])
            && is_object($callableOrMethodArr[0])
        ) {
            list($invocationObj, $method) = $callableOrMethodArr;
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, $method);
            $executableArr = array($callableRefl, $invocationObj);
        } elseif (is_callable($callableOrMethodArr)) {
            list($class, $method) = $callableOrMethodArr;
            $invocationObj = $this->make($class);
            $callableRefl = strpos($method, '::')
                ? $this->generateStaticReflectionMethod($class, $method)
                : $this->reflectionStorage->getMethod($class, $method);
            $executableArr = array($callableRefl, $invocationObj);
        } elseif (is_array($callableOrMethodArr)
            && isset($callableOrMethodArr[0], $callableOrMethodArr[1])
            && method_exists($callableOrMethodArr[0], $callableOrMethodArr[1])
        ) {
            list($class, $method) = $callableOrMethodArr;
            $invocationObj = $this->make($class);
            $callableRefl = $this->reflectionStorage->getMethod($class, $method);
            $executableArr = array($callableRefl, $invocationObj);
        } else {
            throw new BadArgumentException(
                'Invalid executable: callable, invokable class name or array in the form ' .
                '[className, methodName] required'
            );
        }
        
        return $executableArr;
    }
    
    private function generateStaticReflectionMethod($staticClass, $staticMethod) {
        if (0 === ($methodStartPos = strpos($staticMethod, 'parent::'))) {
            $childReflection = $this->reflectionStorage->getClass($staticClass);
            $staticClass = $childReflection->getParentClass()->name;
            $staticMethod = substr($staticMethod, $methodStartPos + 8);
        }
        
        return $this->reflectionStorage->getMethod($staticClass, $staticMethod);
    }
    
    private function generateInvocationArgs(\ReflectionFunctionAbstract $funcRefl, array $definition) {
        $funcArgs = array();
        
        // @TODO store this in ReflectionStorage
        $funcReflParamsArr = $funcRefl->getParameters();
        
        foreach ($funcReflParamsArr as $funcParam) {
            $rawParamKey = self::RAW_INJECTION_PREFIX . $funcParam->name;

            if (isset($definition[$funcParam->name])) {
                $funcArgs[] = $this->make($definition[$funcParam->name]);
            } elseif (isset($definition[$rawParamKey])) {
                $funcArgs[] = $definition[$rawParamKey];
            } else {
                $funcArgs[] = $this->buildArgumentFromTypeHint($funcRefl, $funcParam);
            }
        }
        
        return $funcArgs;
    }
    
    protected function getInjectedInstance($className, array $definition) {
        try {
            $ctorParams = $this->reflectionStorage->getConstructorParameters($className);
        } catch (\ReflectionException $e) {
            throw new InjectionException(
                "Provider instantiation failure: $className doesn't exist".
                ' and could not be found by any registered autoloaders.',
                0, $e
            );
        }
        
        if ($ctorParams) {
            $ctorMethod = $this->reflectionStorage->getConstructor($className);
            $args = $this->generateInvocationArgs($ctorMethod, $definition);
            $reflectionClass = $this->reflectionStorage->getClass($className);
            return $reflectionClass->newInstanceArgs($args);
        } else {
            return $this->buildWithoutConstructorParams($className);
        }
    }
    
    private function buildWithoutConstructorParams($className) {
        if ($this->isInstantiable($className)) {
            return new $className;
        } elseif ($this->isImplemented($className)) {
            return $this->buildImplementation($className);
        } else {
            $reflectionClass = $this->reflectionStorage->getClass($className);
            $type = $reflectionClass->isInterface() ? 'interface' : 'abstract';
            throw new InjectionException(
                "Cannot instantiate $type $className without an injection definition or " .
                "implementation"
            );
        }
    }
    
    private function isInstantiable($className) {
        $reflectionInstance = $this->reflectionStorage->getClass($className);
        return $reflectionInstance->isInstantiable();
    }
    
    private function isImplemented($nonConcreteType) {
        $lowNonConcrete = strtolower($nonConcreteType);
        return isset($this->aliases[$lowNonConcrete]);
    }
    
    private function buildImplementation($interfaceOrAbstractName) {
        $lowClass  = strtolower($interfaceOrAbstractName);
        $implClass = $this->aliases[$lowClass];
        $implObj   = $this->make($implClass);
        $implRefl  = $this->reflectionStorage->getClass($implClass);
        
        if (!$implRefl->isSubclassOf($interfaceOrAbstractName)) {
            throw new InjectionException(
                "Bad implementation: {$implRefl->name} does not implement $interfaceOrAbstractName"
            );
        }
        
        return $implObj;
    }
    
    private function buildArgumentFromTypeHint(\ReflectionFunctionAbstract $reflFunc, \ReflectionParameter $reflParam) {
        $typeHint = $this->reflectionStorage->getParamTypeHint($reflFunc, $reflParam);
          
        if ($typeHint && ($this->isInstantiable($typeHint) || $this->delegateExists($typeHint))) {
            return $this->make($typeHint);
        } elseif ($typeHint) {
            return $this->buildAbstractTypehintParam($typeHint, $reflParam->name);
        } elseif ($reflParam->isDefaultValueAvailable()) {
            return $reflParam->getDefaultValue();
        } else {
            return NULL;
        }
    }
    
    private function buildAbstractTypehintParam($typehint, $paramName) {
        if ($this->isImplemented($typehint)) {
            try {
                return $this->buildImplementation($typehint);
            } catch (InjectionException $e) {
                throw new InjectionException(
                    'Bad implementation definition encountered while attempting to provision ' .
                    "non-concrete parameter \$$paramName of type $typehint",
                    0,
                    $e
                );
            }
        }
        
        throw new InjectionException(
            'Injection definition/implementation required for non-concrete parameter '.
            "\$$paramName of type $typehint"
        );
    }
}
