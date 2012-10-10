<?php

namespace Auryn;

use BadFunctionCallException,
    InvalidArgumentException,
    OutOfBoundsException,
    ReflectionException,
    ReflectionParameter,
    ReflectionMethod,
    Traversable,
    StdClass;

class Provider implements Injector {
    
    /**
     * @var string
     */
    const RAW_INJECTION_PREFIX = ':';
    
    /**
     * @var array
     */
    private $injectionDefinitions = array();
    
    /**
     * @var array
     */
    private $nonConcreteImplementations = array();
    
    /**
     * @var array
     */
    private $sharedClasses = array();

    /**
     * @var array
     */
    private $delegatedClasses = array();

    /**
     * @var ReflectionStorage
     */
    private $reflectionStorage;

    /**
     * @param ReflectionStorage $reflectionStorage
     * @return \Auryn\Provider
     */
    public function __construct(ReflectionStorage $reflectionStorage) {
        $this->reflectionStorage = $reflectionStorage;
    }
    
    /**
     * Instantiate a class according to a predefined or call-time injection definition
     * 
     * @param string $class Class name
     * @param array  $customDefinition An optional array of custom instantiation parameters
     * @throws InjectionException
     * @return mixed A dependency-injected object
     */
    public function make($class, array $customDefinition = NULL) {
        $lowClass = strtolower($class);
        
        if (isset($this->sharedClasses[$lowClass])) {
            return $this->sharedClasses[$lowClass];
        }
        
        if ($this->isDelegated($lowClass)) {
            $obj = $this->doDelegation($this->delegatedClasses[$lowClass], $class);
        } else {
            $definition = $this->selectDefinition($lowClass, $customDefinition);
            $obj = $this->getInjectedInstance($class, $definition);
        }
        
        if ($this->isShared($lowClass)) {
            $this->sharedClasses[$lowClass] = $obj;
        }
        
        return $obj;
    }
    
    /**
     * @param string $class
     * @return bool
     */
    private function isDelegated($class) {
        return array_key_exists($class, $this->delegatedClasses);
    }
    
    /**
     * @param mixed $callable
     * @param string $class
     * @throws InjectionException
     * @return mixed
     */
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
    
    /**
     * @param string $lowClass
     * @param array $customDefinition
     * @return array
     */
    private function selectDefinition($lowClass, $customDefinition) {
        if (!is_null($customDefinition)) {
            return $customDefinition;
        } elseif ($this->isDefined($lowClass)) {
            return $this->injectionDefinitions[$lowClass];
        } else {
            return array();
        }
    }
    
    /**
     * Defines a custom injection definition for the specified class
     * 
     * @param string $className
     * @param array $injectionDefinition An associative array matching constructor params to values
     * @throws InjectionException
     * @return void
     */
    public function define($className, array $injectionDefinition) {
        $this->validateInjectionDefinition($injectionDefinition);
        $lowClass = strtolower($className);
        $this->injectionDefinitions[$lowClass] = $injectionDefinition;
    }
    
    /**
     * @param array $injectionDefinition
     * @throws InjectionException
     * @return void
     */
    private function validateInjectionDefinition(array $injectionDefinition) {
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
     * Determines if an injection definition exists for the given class name
     * 
     * @param string $class Class name
     * @return bool Returns true if a definition is stored or false otherwise
     */
    public function isDefined($class) {
        $lowClass = strtolower($class);
        return isset($this->injectionDefinitions[$lowClass]);
    }

    /**
     * Defines multiple injection definitions at one time
     *
     * @param mixed $iterable The variable to iterate over: an array, StdClass or Traversable
     * @throws \InvalidArgumentException
     * @return int Returns the number of definitions stored by the operation.
     */
    public function defineAll($iterable) {
        if (!($iterable instanceof StdClass
            || is_array($iterable)
            || $iterable instanceof Traversable)
        ) {
            throw new InvalidArgumentException(
                get_class($this) . '::defineAll expects an array, StdClass or '
                .'Traversable object at Argument 1'
            );
        }
        
        $added = 0;
        foreach ($iterable as $class => $definition) {
            $this->define($class, $definition);
            ++$added;
        }
        
        return $added;
    }
    
    /**
     * Clear a previously defined injection definition
     * 
     * @param string $class Class name
     * @return void
     */
    public function clearDefinition($class) {
        $lowClass = strtolower($class);
        unset($this->injectionDefinitions[$lowClass]);
    }
    
    /**
     * Clear all injection definitions from the container
     * 
     * @return void
     */
    public function clearAllDefinitions() {
        $this->injectionDefinitions = array();
    }
    
    /**
     * Defines an implementation class for all occurrences of a given interface or abstract
     * 
     * @param string $nonConcreteType
     * @param string $className
     * @return void
     */
    public function implement($nonConcreteType, $className) {
        $lowNonConcrete = strtolower($nonConcreteType);
        $this->nonConcreteImplementations[$lowNonConcrete] = $className;
    }
    
    /**
     * Determines if an implementation is specified for the non-concrete type
     * 
     * @param string $nonConcreteType
     * @return bool
     */
    public function isImplemented($nonConcreteType) {
        $lowNonConcrete = strtolower($nonConcreteType);
        return isset($this->nonConcreteImplementations[$lowNonConcrete]);
    }

    /**
     * Defines multiple type implementations at one time
     *
     * @param mixed $iterable The variable to iterate over: an array, StdClass or Traversable
     * @throws \InvalidArgumentException
     * @return int Returns the number of implementations stored by the operation.
     */
    public function implementAll($iterable) {
        if (!($iterable instanceof StdClass
            || is_array($iterable)
            || $iterable instanceof Traversable)
        ) {
            throw new InvalidArgumentException(
                get_class($this) . '::implementAll expects an array, StdClass or '
                .'Traversable object at Argument 1'
            );
        }
        
        $added = 0;
        foreach ($iterable as $nonConcreteType => $implementationClass) {
            $this->implement($nonConcreteType, $implementationClass);
            ++$added;
        }
        
        return $added;
    }
    
    /**
     * Clears an existing implementation definition for the non-concrete type
     * 
     * @param string $nonConcreteType
     * @return void
     */
    public function clearImplementation($nonConcreteType) {
        $lowNonConcrete = strtolower($nonConcreteType);
        unset($this->nonConcreteImplementations[$lowNonConcrete]);
    }

    /**
     * Clears an existing implementation definition for the non-concrete type
     *
     * @return void
     */
    public function clearAllImplementations() {
        $this->nonConcreteImplementations = array();
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
    public function share($classNameOrInstance) {
        if (is_string($classNameOrInstance)) {
            $lowClass = strtolower($classNameOrInstance);
            $this->sharedClasses[$lowClass] = NULL;
        } elseif (is_object($classNameOrInstance)) {
            $lowClass = strtolower(get_class($classNameOrInstance));
            $this->sharedClasses[$lowClass] = $classNameOrInstance;
        } else {
            $parameterType = gettype($classNameOrInstance);
            throw new InvalidArgumentException(
                get_class($this).'::share() requires a string class name or object instance at ' .
                "Argument 1; $parameterType specified"
            );
        }
    }
    
    /**
     * Shares all specified classes/instances
     * 
     * @param mixed $arrayOrTraversable
     * @return void
     * @throws \InvalidArgumentException
     */
    public function shareAll($arrayOrTraversable) {
        if (!(is_array($arrayOrTraversable) || $arrayOrTraversable instanceof Traversable)) {
            $type = is_object($arrayOrTraversable)
                ? get_class($arrayOrTraversable)
                : gettype($arrayOrTraversable);
            throw new InvalidArgumentException(
                get_class($this).'::shareAll() requires an array or Traversable object at ' .
                "Argument 1; $type specified"
            );
        }
        
        foreach ($arrayOrTraversable as $toBeShared) {
            $this->share($toBeShared);
        }
    }
    
    /**
     * Determines if a given class name is marked as shared
     * 
     * @param string $class Class name
     * @return bool Returns true if a shared instance is stored or false if not
     */
    public function isShared($class) {
        $lowClass = strtolower($class);
        return isset($this->sharedClasses[$lowClass])
            || array_key_exists($lowClass, $this->sharedClasses);
    }
    
    /**
     * Forces re-instantiation of a shared class the next time it's requested
     * 
     * @param string $class Class name
     * @return void
     */
    public function refreshShare($class) {
        $lowClass = strtolower($class);
        if (isset($this->sharedClasses[$lowClass])) {
            $this->sharedClasses[$lowClass] = NULL;
        }
    }
    
    /**
     * Unshares the specified class
     * 
     * @param string $class Class name
     * @return void
     */
    public function unshare($class) {
        $lowClass = strtolower($class);
        unset($this->sharedClasses[$lowClass]);
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
    public function delegate($class, $callable) {
        if (!(is_callable($callable) || is_string($callable))) {
            throw new BadFunctionCallException(
                get_class($this) . '::delegate expects the second parameter to be a valid ' .
                'callable or string class name'
            );
        }

        $this->delegatedClasses[strtolower($class)] = $callable;
    }

    /**
     * @param string $className
     * @param array $definition
     * @throws InjectionException
     * @return mixed Returns a dependency-injected object
     */
    protected function getInjectedInstance($className, array $definition) {
        try {
            $ctorParams = $this->reflectionStorage->getConstructorParameters($className);
        } catch (ReflectionException $e) {
            throw new InjectionException(
                "Provider instantiation failure: $className doesn't exist".
                ' and could not be found by any registered autoloaders.',
                0, $e
            );
        }
        
        if ($ctorParams) {
            $args = $this->buildNewInstanceArgs($className, $definition);
            $reflectionClass = $this->reflectionStorage->getClass($className);
            return $reflectionClass->newInstanceArgs($args);
        } else {
            return $this->buildWithoutConstructorParams($className);
        }
    }

    /**
     * @param string $className
     * @throws InjectionException
     * @return mixed
     */
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
    
    /**
     * @param string $className
     * @return bool
     */
    private function isInstantiable($className) {
        $reflectionInstance = $this->reflectionStorage->getClass($className);
        return $reflectionInstance->isInstantiable();
    }
    
    /**
     * @param string $interfaceOrAbstractName
     * @throws InjectionException
     * @return mixed
     */
    private function buildImplementation($interfaceOrAbstractName) {
        $lowClass  = strtolower($interfaceOrAbstractName);
        $implClass = $this->nonConcreteImplementations[$lowClass];
        $implObj   = $this->make($implClass);
        $implRefl  = $this->reflectionStorage->getClass($implClass);
        
        if (!$implRefl->isSubclassOf($interfaceOrAbstractName)) {
            throw new InjectionException(
                "Bad implementation: {$implRefl->name} does not implement $interfaceOrAbstractName"
            );
        }
        
        return $implObj;
    }
    
    /**
     * @param ReflectionMethod $reflectedCtor
     * @param array $reflectedCtorParams[ReflectionParameter]
     * @param array $definition
     * @throws InjectionException
     * @return array
     */
    private function buildNewInstanceArgs($className, array $definition) {
        $instanceArgs = array();
        
        $ctorMethod = $this->reflectionStorage->getConstructor($className);
        $ctorParams = $this->reflectionStorage->getConstructorParameters($className);
        
        foreach ($ctorParams as $ctorParam) {
            if (isset($definition[$ctorParam->name])) {
                $instanceArgs[] = $this->make($definition[$ctorParam->name]);
                continue;
            }
            
            $rawParamKey = self::RAW_INJECTION_PREFIX . $ctorParam->name;
            if (isset($definition[$rawParamKey])) {
                $instanceArgs[] = $definition[$rawParamKey];
                continue;
            }
            
            $instanceArgs[] = $this->buildArgumentFromTypeHint($ctorMethod, $ctorParam);
        }
        
        return $instanceArgs;
    }
    
    /**
     * @param ReflectionMethod $reflectionMethod
     * @param ReflectionParameter $reflectionParam
     * @throws InjectionException
     * @return mixed
     */
    private function buildArgumentFromTypeHint(
        ReflectionMethod $reflectionMethod,
        ReflectionParameter $reflectionParam
    ) {
        $typeHint = $this->reflectionStorage->getParamTypeHint($reflectionMethod, $reflectionParam);
          
        if ($typeHint && $this->isInstantiable($typeHint)) {
            return $this->make($typeHint);
        } elseif ($typeHint) {
            return $this->buildAbstractTypehintParam($typeHint, $reflectionParam->name);
        } elseif ($reflectionParam->isDefaultValueAvailable()) {
            return $reflectionParam->getDefaultValue();
        } else {
            return NULL;
        }
    }
    
    /**
     * @param string $typehint
     * @param string $paramName
     * @return mixed
     * @throws InjectionException
     */
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
