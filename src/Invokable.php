<?php

namespace Auryn;

class Invokable
{
    private $reflFunc;
    private $invokeObj;
    private $isInstanceMethod;

    public function __construct(\ReflectionFunctionAbstract $reflFunc, $invokeObj = null)
    {
        if ($reflFunc instanceof \ReflectionMethod) {
            $this->isInstanceMethod = true;
            $this->setMethodCallable($reflFunc, $invokeObj);
        } else {
            $this->isInstanceMethod = false;
            $this->reflFunc = $reflFunc;
        }
    }

    private function setMethodCallable(\ReflectionMethod $reflection, $invokeObj)
    {
        if (is_object($invokeObj)) {
            $this->reflFunc = $reflection;
            $this->invokeObj = $invokeObj;
        } elseif ($reflection->isStatic()) {
            $this->reflFunc = $reflection;
        } else {
            throw new \InvalidArgumentException(
                'ReflectionMethod callables must specify an invocation object'
            );
        }
    }

    public function __invoke()
    {
        $args = func_get_args();

        return $this->isInstanceMethod
            ? $this->reflFunc->invokeArgs($this->invokeObj, $args)
            : $this->reflFunc->invokeArgs($args);
    }

    public function getCallableReflection()
    {
        return $this->reflFunc;
    }

    public function getInvocationObject()
    {
        return $this->invokeObj;
    }

    public function isInstanceMethod()
    {
        return $this->isInstanceMethod;
    }
}
