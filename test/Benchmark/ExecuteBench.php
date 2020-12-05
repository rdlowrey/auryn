<?php

namespace Auryn\Test\Benchmark;

use Auryn\Injector;

class ExecuteBench
{
    private $injector;
    private $noop;

    public function __construct()
    {
        $this->injector = new Injector();
        $this->noop = new Noop();
    }

    /**
     * @Revs(10000)
     */
    public function benchnative_invoke_closure()
    {
        call_user_func(function () {
            // call-target, intenionally left empty
        });
    }

    /**
     * @Revs(10000)
     */
    public function benchnative_invoke_method()
    {
        call_user_func(array($this->noop, 'noop'));
    }

    /**
     * @Revs(10000)
     */
    public function benchinvoke_closure()
    {
        $this->injector->execute(function () {
            // call-target, intenionally left empty
        });
    }

    /**
     * @Revs(10000)
     */
    public function benchinvoke_method()
    {
        $this->injector->execute(array($this->noop, 'noop'));
    }

    /**
     * @Revs(10000)
     */
    public function benchinvoke_with_named_parameters()
    {
        $this->injector->execute(array($this->noop, 'namedNoop'), array(':name' => 'foo'));
    }

    /**
     * @Revs(10000)
     */
    public function bench_make_noop()
    {
        $this->injector->make(Noop::class);
    }

    /**
     * @Revs(10000)
     */
    public function bench_make_two_dependency_object()
    {
        $this->injector->make(TwoDeps::class);
    }
}
