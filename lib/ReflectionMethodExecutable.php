<?php


namespace Auryn;


class ReflectionMethodExecutable extends Executable {

    protected $invocationObject;
    
    public function __construct(\ReflectionMethod $reflection, $invocationObject = NULL) {
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

        return $this->callableReflection->invokeArgs($this->invocationObject, $args);
    }

    public function getInvocationObject() {
        return $this->invocationObject;
    }
    
    public function makeAccessible() {
        if (!$this->callableReflection->isPublic()) {
            $this->callableReflection->setAccessible(TRUE);
        }
    }
}

 