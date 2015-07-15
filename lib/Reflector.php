<?php

namespace Auryn;

interface Reflector
{
    /**
     * Retrieves ReflectionClass instances, caching them for future retrieval
     *
     * @param string $class
     * @return \ReflectionClass
     */
    public function getClass($class);

    /**
     * Retrieves and caches the constructor (ReflectionMethod) for the specified class
     *
     * @param string $class
     * @return \ReflectionMethod
     */
    public function getCtor($class);

    /**
     * Retrieves and caches an array of constructor parameters for the given class
     *
     * @param string $class
     * @return \ReflectionParameter[]
     */
    public function getCtorParams($class);

    /**
     * Retrieves the class type-hint from a given ReflectionParameter
     *
     * There is no way to directly access a parameter's type-hint without
     * instantiating a new ReflectionClass instance and calling its getName()
     * method. This method stores the results of this approach so that if
     * the same parameter type-hint or ReflectionClass is needed again we
     * already have it cached.
     *
     * @param \ReflectionFunctionAbstract $function
     * @param \ReflectionParameter $param
     */
    public function getParamTypeHint(\ReflectionFunctionAbstract $function, \ReflectionParameter $param);

    /**
     * Retrieves and caches a reflection for the specified function
     *
     * @param string $functionName
     * @return \ReflectionFunction
     */
    public function getFunction($functionName);

    /**
     * Retrieves and caches a reflection for the specified class method
     *
     * @param mixed $classNameOrInstance
     * @param string $methodName
     * @return \ReflectionMethod
     */
    public function getMethod($classNameOrInstance, $methodName);
}
