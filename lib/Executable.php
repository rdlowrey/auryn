<?php

namespace Auryn;

class Executable
{
    private $callableReflection;
    private $invocationObject;
    private $isInstanceMethod;

    public function __construct(\ReflectionFunctionAbstract $reflFunc, $invocationObject = null)
    {
        if ($reflFunc instanceof \ReflectionMethod) {
            $this->isInstanceMethod = true;
            $this->setMethodCallable($reflFunc, $invocationObject);
        } else {
            $this->isInstanceMethod = false;
            $this->callableReflection = $reflFunc;
        }
    }

    private function setMethodCallable(\ReflectionMethod $reflection, $invocationObject)
    {
        if (is_object($invocationObject)) {
            $this->callableReflection = $reflection;
            $this->invocationObject = $invocationObject;
        } elseif ($reflection->isStatic()) {
            $this->callableReflection = $reflection;
        } else {
            throw new \InvalidArgumentException(
                'ReflectionMethod callables must specify an invocation object'
            );
        }
    }

    public function __invoke()
    {
        $args = func_get_args();
        $reflection = $this->callableReflection;

        if ($this->isInstanceMethod) {
            return $reflection->invokeArgs($this->invocationObject, $args);
        }

        return $this->callableReflection->isClosure()
            ? $this->invokeClosureCompat($reflection, $args)
            : $reflection->invokeArgs($args);
    }

    /**
     * @TODO Remove this extra indirection when 5.3 support is dropped
     */
    private function invokeClosureCompat($reflection, $args)
    {
        if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            $scope = $reflection->getClosureScopeClass();
            $closure = \Closure::bind(
                $reflection->getClosure(),
                $reflection->getClosureThis(),
                $scope ? $scope->name : null
            );
            return call_user_func_array($closure, $args);
        } else {
            return $reflection->invokeArgs($args);
        }
    }

    public function getCallableReflection()
    {
        return $this->callableReflection;
    }

    public function getInvocationObject()
    {
        return $this->invocationObject;
    }

    public function isInstanceMethod()
    {
        return $this->isInstanceMethod;
    }
}
