<?php

namespace Auryn\Test\Benchmark;

class Noop
{
    public function noop()
    {
        // call-target, intenionally left empty
    }
    
    public function namedNoop($name)
    {
        // call-target, intenionally left empty
    }
    
    public function typehintedNoop(noop $noop)
    {
        // call-target, intenionally left empty
    }
}
