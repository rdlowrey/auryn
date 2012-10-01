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
    private $ctorParams = array();
    
    /**
     * @var SplObjectStorage
     */
    private $typehints;
    
    /**
     * Retrieves and caches the ReflectionClass objects
     * 
     * @param string $class The class we want to reflect
     * @return ReflectionClass
     * @throws ReflectionException If the class can't be found or autoloaded
     */
    public function getClass($class) {
        $lowClass = strtolower($class);
        
        if (isset($this->classes[$lowClass])) {
            return $this->classes[$lowClass];
        }
        
        $reflClass = new ReflectionClass($class);
        $this->classes[$lowClass] = $reflClass;
        
        return $reflClass;
    }
    
    /**
     * Retrieves and caches the class's constructor ReflectionMethod
     * 
     * @param string $class The class whose constructor we want to reflect
     * @return ReflectionMethod Returns the reflected constructor or NULL if
     *                          the specified class has no constructor.
     */
    public function getConstructor($class) {
        $lowClass = strtolower($class);
        
        if (isset($this->constructors[$lowClass])
            || array_key_exists($lowClass, $this->constructors)
        ) {
            return $this->constructors[$lowClass];
        }
        
        $reflClass = $this->getClass($class);
        $reflCtor  = $reflClass->getConstructor();
        
        $this->constructors[$lowClass] = $reflCtor;
        
        return $reflCtor;
    }
    
    /**
     * Retrieves and caches constructor parameters for the given class name
     * 
     * @param string $class The name of the class whose constructor 
     *                          parameters we'd like to retrieve
     * 
     * @return array Returns an array of ReflectionParameter objects or 
     *               NULL if no constructor exists for the class.
     */
    public function getConstructorParameters($class) {
        $lowClass = strtolower($class);
        
        if (isset($this->ctorParams[$lowClass])
            || array_key_exists($lowClass, $this->ctorParams)
        ) {
            return $this->ctorParams[$lowClass];
        }
        
        if ($reflCtor = $this->getConstructor($class)) {
            $ctorParams = $reflCtor->getParameters();
        } else {
            $ctorParams = NULL;
        }
        
        $this->ctorParams[$lowClass] = $ctorParams;
        
        return $ctorParams;
    }
    
    /**
     * Retrieves the class typehint from a given ReflectionParameter
     * 
     * There is no way to directly access a parameter's typehint without
     * instantiating a new ReflectionClass instance and calling its getName()
     * method. This method stores the results of this approach so that if
     * the same parameter typehint or ReflectionClass is needed again we
     * already have it cached.
     * 
     * @param ReflectionParameter $reflParam
     * @return string Returns the typehinted class name of the given parameter
     *                or NULL if none exists.
     */
    public function getTypehint(ReflectionParameter $reflParam) {
        if (empty($this->typehints)) {
            $this->typehints = new SplObjectStorage;
        }
        
        if ($this->typehints->contains($reflParam)) {
            return $this->typehints->offsetGet($reflParam);
        }
        
        if ($reflClass = $reflParam->getClass()) {
            $class = $reflClass->getName();
            $lowClass  = strtolower($class);
            if (!isset($this->classes[$lowClass])) {
                $this->classes[$lowClass] = $reflClass;
            }
            $typehint = $class;
        } else {
            $typehint = NULL;
        }
        
        $this->typehints->attach($reflParam, $typehint);
        
        return $typehint;
    }
}
