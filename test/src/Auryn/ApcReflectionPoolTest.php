<?php

use Auryn\ApcReflectionPool;

class ApcReflectionPoolTest extends PHPUnit_Framework_TestCase {
    
    /**
     * @covers Auryn\ApcReflectionPool::setTimeToLive
     */
    public function testSetTimeToLive() {
        $pool = new ApcReflectionPool();
        $pool->setTimeToLive(42);
    }
    
    /**
     * @covers Auryn\ApcReflectionPool::fetchFromCache
     * @covers Auryn\ApcReflectionPool::storeInCache
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
     */
    public function testGetClassRetrievesCachedReflectionIfAvailable($pool) {
        $this->assertInstanceOf('ReflectionClass', $pool->getClass('TestClass'));
    }
}

class TestClass {}