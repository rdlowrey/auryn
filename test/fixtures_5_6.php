<?php

namespace Auryn\Test;

class NoTypeNoDefaultConstructorVariadicClass
{
    public $testParam = 1;
    public function __construct(TestDependency $val1, ...$arg)
    {
        $this->testParam = $arg;
    }
}

class TypeNoDefaultConstructorVariadicClass
{
    public $testParam = 1;
    public function __construct(TestDependency ...$arg)
    {
        $this->testParam = $arg;
    }
}