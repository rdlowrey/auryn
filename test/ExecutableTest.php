<?php

namespace Auryn\Test;

namespace Auryn\Test;

use Auryn\Executable;
use Auryn\Injector;
use Auryn\Test\ExecutableHelper;
use PHPUnit\Framework\TestCase;

class ExecutableTest extends TestCase
{
    public function testBasicWorks()
    {
        $rc = new \ReflectionClass(ExecutableHelper::class);
        $rm = $rc->getMethod('foo');
        $obj = $rc->newInstanceWithoutConstructor();
        $executable = new Executable($rm, $obj);

        $this->assertSame($obj, $executable->getInvocationObject());
        $this->assertSame($rm, $executable->getCallableReflection());
        $this->assertTrue($executable->isInstanceMethod());
    }

    public function testBasicErrors()
    {
        $rc = new \ReflectionClass(ExecutableHelper::class);
        $rm = $rc->getMethod('foo');
        $this->expectExceptionMessage("ReflectionMethod callables must specify an invocation object");
        $this->expectException(\InvalidArgumentException::class);
        new Executable($rm, null);
    }
}