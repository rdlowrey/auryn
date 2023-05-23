<?php

namespace Auryn\Test\Benchmark;

class DelegatedClass
{
    private function __construct()
    {
    }

    public static function create()
    {
        return new self();
    }
}