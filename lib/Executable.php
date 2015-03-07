<?php

namespace Auryn;

class Executable {
    private $callableReflection;
    private $invocationObject;
    private $isInstanceMethod;

    public function __construct(\ReflectionFunctionAbstract $reflFunc, $invocationObject = null) {
        if ($reflFunc instanceof \ReflectionMethod) {
            $this->isInstanceMethod = true;
            $this->setMethodCallable($reflFunc, $invocationObject);
        } else {
            $this->isInstanceMethod = false;
            $this->callableReflection = $reflFunc;
        }
    }

    private function setMethodCallable(\ReflectionMethod $reflection, $invocationObject) {
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

    public function __invoke() {
        $args = func_get_args();
        $reflection = $this->callableReflection;

        if ($this->isInstanceMethod) {
            return $reflection->invokeArgs($this->invocationObject, $args);
        }

        return $this->callableReflection->isClosure()
            ? call_user_func_array(\Closure::bind($reflection->getClosure(), $reflection->getClosureThis(), $reflection->getClosureScopeClass()->name), $args)
            : $reflection->invokeArgs($args);
    }

    public function getCallableReflection() {
        return $this->callableReflection;
    }

    public function getInvocationObject() {
        return $this->invocationObject;
    }

    public function isInstanceMethod() {
        return $this->isInstanceMethod;
    }
}
