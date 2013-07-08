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
     * @throws InjectionException
     * @return mixed A dependency-injected object
     */
    function make($className, array $customDefinition = array()) {
        $lowClass = strtolower($className);
        
        // `isset` is used specifically here instead of `isShared` because classes may be marked
        // as "shared" before an instance is stored. In such cases, the class is shared, but
        // has a NULL value and must be instantiated by the Provider to create the shared instance.
        if (isset($this->sharedClasses[$lowClass])) {
            return $this->sharedClasses[$lowClass];
        }
        
        if ($this->hasDelegate($lowClass)) {
            $obj = $this->doDelegation($this->delegatedClasses[$lowClass], $className);
        } else {
            $definition = $this->selectDefinition($lowClass, $customDefinition);
            $obj = $this->getInjectedInstance($className, $definition);
        }
        
        if ($this->isShared($lowClass)) {
            $this->sharedClasses[$lowClass] = $obj;
        }
        
        return $obj;
    }
    
    private function hasDelegate($class) {
        $lowClass = strtolower($class);
        return array_key_exists($lowClass, $this->delegatedClasses);
    }
    
    private function doDelegation($callable, $class) {
        if (is_string($callable)) {
            try {
                $callableObj = $this->make($callable);
            } catch (\Exception $error) {
                throw new InjectionException(
                    "Delegate class instantiation failure: $callable",
                    0,
                    $error
                );
            }
            if (!is_callable($callableObj, '__invoke')) {
                throw new InjectionException(
                    "Delegate class '$callable' must expose a public __invoke method",
                    0
                );
            }
            
            $callable = array($callableObj, '__invoke');
        }
        
        try {
            $obj = call_user_func($callable, $class);
        } catch (\Exception $error) {
            throw new InjectionException(
                "Delegated function threw an exception while creating '$class'",
                0,
                $error
            );
        }

        if (!($obj instanceof $class)) {
            throw new InjectionException(
                "Delegated function did not create an instance of '$class'"
            );
        }
        
        return $obj;
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
        $className = strtolower($className);
        return isset($this->injectionDefinitions[$className]);
    }
    
    private function isShared($className) {
        $className = strtolower($className);
        return array_key_exists($className, $this->sharedClasses);
    }
    
    /**
     * Defines a custom injection definition for the specified class
     * 
     * @param string $className
     * @param array $injectionDefinition An associative array matching constructor params to values
     * @throws InjectionException
     * @return void
     */
    function define($className, array $injectionDefinition) {
        $this->validateInjectionDefinition($injectionDefinition);
        $className = strtolower($className);
        $this->injectionDefinitions[$className] = $injectionDefinition;
    }
    
    private function validateInjectionDefinition($injectionDefinition) {
        if (!is_array($injectionDefinition)) {
            throw new \InvalidArgumentException;
        }
        
        foreach ($injectionDefinition as $paramName => $value) {
            if (0 !== strpos($paramName, self::RAW_INJECTION_PREFIX) && !is_string($value)) {
                throw new InjectionException(
                    "Invalid injection definition for parameter `$paramName`; raw parameter " .
                    "names must be prefixed with `:` (:$paramName) to differentiate them " .
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
     * @return void
     */
    function alias($typehintToReplace, $alias) {
        $typehintToReplace = strtolower($typehintToReplace);
        $this->aliases[$typehintToReplace] = $alias;
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
     * @return void
     * @throws \InvalidArgumentException
     */
    function share($classNameOrInstance) {
        if (is_string($classNameOrInstance)) {
            $lowClass = strtolower($classNameOrInstance);
            $this->sharedClasses[$lowClass] = NULL;
        } elseif (is_object($classNameOrInstance)) {
            $lowClass = strtolower(get_class($classNameOrInstance));
            $this->sharedClasses[$lowClass] = $classNameOrInstance;
        } else {
            $parameterType = gettype($classNameOrInstance);
            throw new \InvalidArgumentException(
                get_class($this).'::share() requires a string class name or object instance at ' .
                "Argument 1; $parameterType specified"
            );
        }
    }
    
    /**
     * Unshares the specified class
     * 
     * @param string $class Class name
     * @return void
     */
    function unshare($className) {
        $className = strtolower($className);
        unset($this->sharedClasses[$className]);
    }
    
    /**
     * Forces re-instantiation of a shared class the next time it's requested
     * 
     * @param string $class Class name
     * @return void
     */
    function refresh($className) {
        $className = strtolower($className);
        if (isset($this->sharedClasses[$className])) {
            $this->sharedClasses[$className] = NULL;
        }
    }
    /**
     * Delegates the creation of $class to $callable.  Passes $class to $callable as the only
     * argument
     *
     * @param string $class
     * @param callable $callable
     * @throws \BadFunctionCallException
     * @return void
     */
    function delegate($className, $callable) {
        if (!(is_callable($callable) || is_string($callable))) {
            throw new \BadFunctionCallException(
                get_class($this) . '::delegate expects the second parameter to be a valid ' .
                'callable or string class name'
            );
        }
        
        $className = strtolower($className);
        $this->delegatedClasses[$className] = $callable;
    }
    
    /**
     * Invoke the specified callable or class/method array, provisioning dependencies along the way.
     * 
     * @param mixed $callableOrMethodArr Valid PHP callable or an array of the form [$className, $methodName]
     * @param array $invocationArgs Optional array specifying params to invoke the provisioned callable
     */
    function execute($callableOrMethodArr, array $invocationArgs = array()) {
        list($callableRefl, $invocationObj) = $this->generateCallableReflection($callableOrMethodArr);
        $args = $this->generateInvocationArgs($callableRefl, $invocationArgs);
        
        return ($callableRefl instanceof \ReflectionMethod)
            ? $callableRefl->invokeArgs($invocationObj, $args)
            : $callableRefl->invokeArgs($args);
    }
    
    private function generateCallableReflection($callableOrMethodArr) {
        $isString = is_string($callableOrMethodArr);
        
        if ($callableOrMethodArr instanceof \Closure) {
            $callableRefl = new \ReflectionFunction($callableOrMethodArr);
            $invocationObj = NULL;
        } elseif (($isString = is_string($callableOrMethodArr))
            && function_exists($callableOrMethodArr)
        ) {
            $callableRefl = $this->reflectionStorage->getFunction($callableOrMethodArr);
            $invocationObj = NULL;
        } elseif ($isString && method_exists($callableOrMethodArr, '__invoke')) {
            $invocationObj = $this->make($callableOrMethodArr);
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
        } elseif ($isString && strpos($callableOrMethodArr, '::') !== FALSE) {
            list($staticClass, $staticMethod) = explode('::', $callableOrMethodArr, 2);
            $callableRefl = $this->generateStaticReflectionMethod($staticClass, $staticMethod);
            $invocationObj = NULL;
        } elseif (is_object($callableOrMethodArr) && is_callable($callableOrMethodArr)) {
            $invocationObj = $callableOrMethodArr;
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
        } elseif (isset($callableOrMethodArr[0], $callableOrMethodArr[1])
            && is_object($callableOrMethodArr[0])
        ) {
            list($invocationObj, $method) = $callableOrMethodArr;
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, $method);
        } elseif (is_callable($callableOrMethodArr)) {
            list($class, $method) = $callableOrMethodArr;
            $invocationObj = $this->make($class);
            $callableRefl = strpos($method, '::')
                ? $this->generateStaticReflectionMethod($class, $method)
                : $this->reflectionStorage->getMethod($class, $method);
        } else {
            throw new \UnexpectedValueException(
                'Invalid executable: callable or array of the form [className, methodName] required'
            );
        }
        
        return array($callableRefl, $invocationObj);
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
    
    private function buildArgumentFromTypeHint(\ReflectionMethod $reflMethod, \ReflectionParameter $reflParam) {
        $typeHint = $this->reflectionStorage->getParamTypeHint($reflMethod, $reflParam);
          
        if ($typeHint && $this->isInstantiable($typeHint)) {
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
