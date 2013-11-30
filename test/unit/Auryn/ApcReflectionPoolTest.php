<?php

use Auryn\ApcReflectionPool;

class ApcReflectionPoolTest extends PHPUnit_Framework_TestCase {

    /**
     * @covers Auryn\ApcReflectionPool::setTimeToLive
     * @requires extension apc
     */
    public function testSetTimeToLive() {
        $pool = new ApcReflectionPool();
        $pool->setTimeToLive(42);
    }

    /**
     * @covers Auryn\ApcReflectionPool::fetchFromCache
     * @covers Auryn\ApcReflectionPool::storeInCache
     * @requires extension apc
     */
    public function testGetClassRetrievesNewReflectionIfNotCached() {
        $pool = $this->getMock('Auryn\\ApcReflectionPool', array('doApcFetch', 'doApcStore'));
        $pool->expects($this->once())
             ->method('doApcFetch')
             ->will($this->returnValue(false));

        $pool->expects($this->once())
             ->method('doApcStore');

        $this->assertInstanceOf('ReflectionClass', $pool->getClass('TestClass'));

        return $pool;
    }

    /**
     * @depends testGetClassRetrievesNewReflectionIfNotCached
     * @covers Auryn\ApcReflectionPool::fetchFromCache
     * @requires extension apc
     */
    public function testGetClassRetrievesCachedReflectionIfAvailable($pool) {
        $this->assertInstanceOf('ReflectionClass', $pool->getClass('TestClass'));
    }

    /**
     * @requires extension apc
     */
    function testCache(){
        $provider = new Auryn\Provider(new ApcReflectionPool());
        $provider->make('ClassWithCtor');
        $provider->make('ClassWithCtor');
    }
}

class TestClass {}