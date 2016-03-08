<?php

namespace Auryn;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Context;

class StandardReflector implements Reflector
{
    public function getClass($class)
    {
        return new ExtendedReflectionClass($class);
    }

    public function getCtor($class)
    {
        $reflectionClass = new ExtendedReflectionClass($class);

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

    public function getDocBlock($method)
    {
        $class = $this->getClass($method->class);

        return new DocBlock(
            $method->getDocComment(),
            new Context(
                $class->getNamespaceName(),
                $class->getUseStatements()
            )
        );
    }

    public function getImplemented($className)
    {
        return array_merge(array($className), class_implements($className));
    }
}
