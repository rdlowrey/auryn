<?php

namespace Auryn;

class Executable {
    protected $callableReflection;

    public function __construct(\ReflectionFunction $reflection) {
        $this->callableReflection = $reflection;
    }

    function getInvocationObject() {
        return NULL;
    }

    public function getReflection() {
        return $this->callableReflection;
    }

    public function __invoke() {
        $args = func_get_args();

        return $this->callableReflection->invokeArgs($args);
    }
    
    public function makeAccessible() {
    }
}
