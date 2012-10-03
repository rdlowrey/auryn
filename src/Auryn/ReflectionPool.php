<?php

namespace Auryn;

use SplObjectStorage,
    ReflectionClass,
    ReflectionParameter;

class ReflectionPool implements ReflectionStorage {

    /**
     * @var array
     */
    private $classes = array();
    
    /**
     * @var array
     */ 
    private $constructors = array();
    
    /**
     * @var array
     */ 
    private $constructorParams = array();
    
    /**
     * @var \SplObjectStorage
     */
    private $typeHints;
    
    /**
     * Retrieves and caches the ReflectionClass objects
     * 
     * @param string $class The class we want to reflect
     * @throws \ReflectionException If the class can't be found or auto-loaded
     * @return \ReflectionClass
     */
    public function getClass($class) {
        $lowClass = strtolower($class);
        
        if (isset($this->classes[$lowClass])) {
            return $this->classes[$lowClass];
        }
        
        $reflectionClass = new ReflectionClass($class);
        $this->classes[$lowClass] = $reflectionClass;
        
        return $reflectionClass;
    }
    
    /**
     * Retrieves and caches the class's constructor ReflectionMethod
     * 
     * @param string $class The class whose constructor we want to reflect
     * @return \ReflectionMethod Returns reflected constructor or NULL if class has no constructor.
     */
    public function getConstructor($class) {
        $lowClass = strtolower($class);
        
        if (isset($this->constructors[$lowClass])
            || array_key_exists($lowClass, $this->constructors)
        ) {
            return $this->constructors[$lowClass];
        }
        
        $reflectionClass = $this->getClass($class);
        $reflectionConstructor  = $reflectionClass->getConstructor();
        
        $this->constructors[$lowClass] = $reflectionConstructor;
        
        return $reflectionConstructor;
    }
    
    /**
     * Retrieves and caches constructor parameters for the given class name
     *
     * @param string $class The class whose constructor parameters we're retrieving
     * @return array An array of ReflectionParameter objects or NULL if no constructor exists
     */
    public function getConstructorParameters($class) {
        $lowClass = strtolower($class);
        
        if (isset($this->constructorParams[$lowClass])
            || array_key_exists($lowClass, $this->constructorParams)
        ) {
            return $this->constructorParams[$lowClass];
        }
        
        if ($reflectionConstructor = $this->getConstructor($class)) {
            $constructorParameters = $reflectionConstructor->getParameters();
        } else {
            $constructorParameters = NULL;
        }
        
        $this->constructorParams[$lowClass] = $constructorParameters;
        
        return $constructorParameters;
    }
    
    /**
     * Retrieves the class type-hint from a given ReflectionParameter
     * 
     * There is no way to directly access a parameter's type-hint without
     * instantiating a new ReflectionClass instance and calling its getName()
     * method. This method stores the results of this approach so that if
     * the same parameter type-hint or ReflectionClass is needed again we
     * already have it cached.
     *
     * @param ReflectionParameter $reflectionParameter
     * @return string The type-hinted class name of the given parameter or NULL if none
     */
    public function getTypeHint(ReflectionParameter $reflectionParameter) {
        if (empty($this->typeHints)) {
            $this->typeHints = new SplObjectStorage;
        }
        
        if ($this->typeHints->contains($reflectionParameter)) {
            return $this->typeHints->offsetGet($reflectionParameter);
        }
        
        if ($reflectionClass = $reflectionParameter->getClass()) {
            $class = $reflectionClass->getName();
            $lowClass  = strtolower($class);
            if (!isset($this->classes[$lowClass])) {
                $this->classes[$lowClass] = $reflectionClass;
            }
            $typeHint = $class;
        } else {
            $typeHint = NULL;
        }
        
        $this->typeHints->attach($reflectionParameter, $typeHint);
        
        return $typeHint;
    }
}
