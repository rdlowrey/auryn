<?php

namespace Auryn;

class StandardReflector implements ReflectorInterface
{
    public function getClass($className)
    {
        return new \ReflectionClass($className);
    }

    public function getCtor($className)
    {
        $reflectionClass = new \ReflectionClass($className);

        return $reflectionClass->getCtor();
    }

    public function getCtorParams($className)
    {
        return ($reflectedCtor = $this->getCtor($className))
            ? $reflectedCtor->getParameters()
            : null;
    }

    public function getParamTypeHint(\ReflectionFunctionAbstract $function, \ReflectionParameter $param)
    {
        return ($reflectionClass = $param->getClass())
            ? $reflectionClass->getName()
            : null;
    }

    public function getFunction($functionName)
    {
        return new \ReflectionFunction($functionName);
    }

    public function getMethod($classNameOrInstance, $methodName)
    {
        $className = is_string($classNameOrInstance)
            ? $classNameOrInstance
            : get_class($classNameOrInstance);

        return new \ReflectionMethod($className, $methodName);
    }
}
