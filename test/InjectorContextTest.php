<?php

namespace Auryn\Test;

use Auryn\InjectionException;
use Auryn\Injector;
use PHPUnit\Framework\TestCase;

class InjectorContextTest extends TestCase
{
    public function testSeparationWorks_coverage()
    {
        $injector = new Injector();
        $next_injector = $injector->separateContext();
        $this->assertEquals(new TestNoConstructor, $next_injector->make('Auryn\Test\TestNoConstructor'));
    }

    public function testSeparationWorks_with_shared_interface()
    {
        $injector = new Injector();
        $message = "shared instance has one off message";

        // We're sharing the interface
        $injector->share(SharedClass::class);
        $injector->alias(SharedClass::class, SharedClassInInjector::class);
        $next_injector = $injector->separateContext();
        $injector->defineParam('message', $message);
        $obj1 = $injector->make(SharedClassInInjector::class);
        $obj2 = $next_injector->make(SharedClassInInjector::class);

        $this->assertSame($message, $obj1->getMessage());
        $this->assertSame($message, $obj2->getMessage());
        $this->assertSame($obj1, $obj2);
    }

    public function testSeparationWorks_with_shared_instance()
    {
        $injector = new Injector();
        $message = "shared instance has one off message";

        $next_injector = $injector->separateContext();

        // We're sharing the instantiated object
        $injector->share(new SharedClassInInjector($message));
        $injector->alias(SharedClass::class, SharedClassInInjector::class);

        $obj1 = $injector->make(SharedClassInInjector::class);
        $obj2 = $next_injector->make(SharedClassInInjector::class);

        $this->assertSame($message, $obj1->getMessage());
        $this->assertSame($message, $obj2->getMessage());
        $this->assertSame($obj1, $obj2);
    }

    public function testSeparationWorks_has_correct_error_message()
    {
        $injector = new Injector();
        // We're sharing the class.
        $injector->share(SharedClassInInjector::class);
        $next_injector = $injector->separateContext();

        try {
            $injector->make(SharedClassInInjector::class);
        }
        catch (\Auryn\InjectionException $ie) {
            $this->assertStringMatchesFormat(Injector::M_UNDEFINED_PARAM, $ie->getMessage());
            $this->assertSame(Injector::E_UNDEFINED_PARAM, $ie->getCode());
        }

        try {
            $next_injector->make(SharedClassInInjector::class);
        }
        catch (\Auryn\InjectionException $ie) {
            $this->assertStringMatchesFormat(
                Injector::M_SHARED_CONTEXT_FAILED,
                $ie->getMessage()
            );
            $this->assertSame(Injector::E_SHARED_CONTEXT_FAILED, $ie->getCode());
        }
    }


}
