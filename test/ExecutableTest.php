<?php

use Auryn\Executable;
use Auryn\ReflectionMethodExecutable;

class ExecutableTest extends PHPUnit_Framework_TestCase {

    function testConstructor() {
        $exe = new Executable(new \ReflectionFunction('var_dump'), NULL);
        $this->assertInstanceOf('Auryn\Executable', $exe);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    function testConstructorThrowsOnInstanceMethodCallableWithoutInvocationObject() {
        $reflectionFunction = new \ReflectionMethod('ArrayObject::count');
        $invocationObj = NULL;
        $exe = new ReflectionMethodExecutable($reflectionFunction, $invocationObj);
    }

    function testGetters() {
        $reflectionFunction = new \ReflectionFunction('var_dump');
        $invocationObj = NULL;
        $exe = new Executable($reflectionFunction, $invocationObj);

        $this->assertSame($reflectionFunction, $exe->getReflection());
        $this->assertSame($invocationObj, $exe->getInvocationObject());
    }

}
