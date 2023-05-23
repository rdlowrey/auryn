<?php

namespace Auryn\Test\Benchmark;

class NonTrivial
{
    private DelegatedClass $dc;
    private AliasedInterface $ai;
    private SharedInstance $si;

    public function __construct(
        DelegatedClass $dc,
        AliasedInterface $ai,
        SharedInstance $si
    )
    {

    }
}