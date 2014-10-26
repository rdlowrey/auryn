<?php

namespace Auryn;

class Invokable {
    private $reflFunc;
    private $invokeObj;
    private $isInstanceMethod;

    public function __construct(\ReflectionFunctionAbstract $reflFunc, $invokeObj = NULL) {
        if ($reflFunc instanceof \ReflectionMethod) {
            $this->isInstanceMethod = TRUE;
            $this->setMethodCallable($reflFunc, $invokeObj);
        } else {
            $this->isInstanceMethod = FALSE;
            $this->reflFunc = $reflFunc;
        }
    }

    private function setMethodCallable(\ReflectionMethod $reflection, $invokeObj) {
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

    public function __invoke() {
        $args = func_get_args();
        $reflection = $this->callableReflection;

        if ($this->isMethod) {
            return $reflection->invokeArgs($this->invocationObject, $args);
        }

        return $this->callableReflection->isClosure()
            ? call_user_func_array(\Closure::bind($reflection->getClosure(), $reflection->getClosureThis(), $reflection->getClosureScopeClass()->name), $args)
            : $reflection->invokeArgs($args);
    }

    public function getCallableReflection() {
        return $this->reflFunc;
    }

    public function getInvocationObject() {
        return $this->invokeObj;
    }

    public function isInstanceMethod() {
        return $this->isInstanceMethod;
    }
}
