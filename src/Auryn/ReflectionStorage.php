<?php

namespace Auryn;

use ReflectionParameter;

interface ReflectionStorage {
    
    /**
     * Retrieves ReflectionClass instances, caching them for future retrieval
     * 
     * @param string $class
     */
    function getClass($class);
    
    /**
     * Retrieves and caches the constructor (ReflectionMethod) for the specified class
     * 
     * @param string $class
     */
    function getConstructor($class);
    
    /**
     * Retrieves and caches an array of constructor parameters for the given class
     * 
     * @param string $class
     */
    function getConstructorParameters($class);
    
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
     */
    function getTypehint(ReflectionParameter $reflParam);
}
