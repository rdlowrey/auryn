<?php


namespace Auryn;


class ClosureExecutable extends Executable {

    private $closure;
    
    public function __construct(\Closure $closure) {
        $this->closure = $closure;
    }

    public function __invoke() {
        $args = func_get_args();
        return call_user_func_array($this->closure, $args);
    }

    public function getReflection() {
        return new \ReflectionFunction($this->closure);
    }
}

 