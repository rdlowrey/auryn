<?php

namespace Auryn\Test;

class NoTypehintNoDefaultConstructorVariadicClass
{
    public $testParam = 1;
    public function __construct(TestDependency $val1, ...$arg)
    {
        $this->testParam = $arg;
    }
}