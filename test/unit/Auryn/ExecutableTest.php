<?php

use Auryn\Executable;

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
        $exe = new Executable($reflectionFunction, $invocationObj);
    }

    function testGetters() {
        $reflectionFunction = new \ReflectionFunction('var_dump');
        $invocationObj = NULL;
        $exe = new Executable($reflectionFunction, $invocationObj);

        $this->assertSame($reflectionFunction, $exe->getCallableReflection());
        $this->assertSame($invocationObj, $exe->getInvocationObject());
    }

}
