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
        $reflectionClass = $this->getClass($class);
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
            $type = $param->getType();
            if ($type instanceof \ReflectionNamedType && $type->isBuiltin()) {
                return null;
            }

            return $type ? ltrim((string)$type, '?') : null;
        } else {
            /* @var ?\ReflectionClass $reflectionClass */
            $reflectionClass = $param->getClass();
            return $reflectionClass ? $reflectionClass->getName() : null;
        }
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
