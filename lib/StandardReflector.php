<?php

namespace Auryn;

class StandardReflector implements Reflector
{
    public function getClass($class)
    {
        return new \ReflectionClass($class);
    }

    public function getCtor($class)
    {
        $reflectionClass = new \ReflectionClass($class);

        return $reflectionClass->getConstructor();
    }

    public function getCtorParams($class)
    {
        return ($reflectedCtor = $this->getCtor($class))
            ? $reflectedCtor->getParameters()
            : null;
    }

    public function getParamTypeHint(\ReflectionFunctionAbstract $function, \ReflectionParameter $param)
    {
        // php 8 deprecates getClass method
        if (PHP_VERSION_ID >= 80000) {
            $reflectionClass = $param->getType() ? (string) $param->getType() : null;
        } else {
            /** @var ?\ReflectionClass $reflectionClass */
            $reflectionClass = $param->getClass();
            if ($reflectionClass) {
                $reflectionClass = $reflectionClass->getName();
            }
        }
        return $reflectionClass ?? null;
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
