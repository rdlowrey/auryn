<?php

namespace Auryn\Test\Benchmark;

class TwoDeps
{
    public function __construct(Noop $foo, Noop $bar) {

    }
}
