<?php

use Auryn\ReflectionPool;

class ReflectionPoolTest extends PHPUnit_Framework_TestCase {

    /**
     * @covers Auryn\ReflectionPool::getClass
     * @covers Auryn\ReflectionPool::storeInCache
     */
    public function testGetClassRetrievesNewReflectionIfNotCached() {
        $rc   = new ReflectionPool;
        $refl = $rc->getClass('Test');
        $this->assertInstanceOf('ReflectionClass', $refl);
        return $rc;
    }

    /**
     * @depends testGetClassRetrievesNewReflectionIfNotCached
     * @covers Auryn\ReflectionPool::getClass
     * @covers Auryn\ReflectionPool::fetchFromCache
     * @covers Auryn\ReflectionPool::storeInCache
     */
    public function testGetClassRetrievesCachedReflectionIfAvailable($rc) {
        $cached = $rc->getClass('Test');
        $new = new ReflectionPool;

        $this->assertFalse($new === $cached);
        $this->assertTrue($rc->getClass('Test') === $cached);
        return $rc;
    }

    /**
     * @depends testGetClassRetrievesCachedReflectionIfAvailable
     * @covers Auryn\ReflectionPool::getConstructor
     */
    public function testGetConstructorRetrievesNewReflectionIfNotCached($rc) {
        $ctor = $rc->getConstructor('Test');
        $this->assertInstanceOf('ReflectionMethod', $ctor);
        return $rc;
    }

    /**
     * @depends testGetConstructorRetrievesNewReflectionIfNotCached
     * @covers Auryn\ReflectionPool::getConstructor
     */
    public function testGetConstructorCachesReflectionIfAvailable($rc) {
        $cached = $rc->getConstructor('Test');
        $new    = $rc->getClass('Test')->getConstructor();

        $this->assertFalse($cached === $new);
        $this->assertTrue($rc->getConstructor('Test') === $cached);

        return $rc;
    }

    /**
     * @depends testGetConstructorCachesReflectionIfAvailable
     * @covers Auryn\ReflectionPool::getConstructorParameters
     */
    public function testGetCtorParamsRetrievesNewReflectionIfNotCached($rc) {
        $params = $rc->getConstructorParameters('Test');
        $this->assertTrue(is_array($params));
        $this->assertInstanceOf('ReflectionParameter', $params[0]);

        return $rc;
    }

    /**
     * @depends testGetCtorParamsRetrievesNewReflectionIfNotCached
     * @covers Auryn\ReflectionPool::getConstructorParameters
     */
    public function testGetCtorParamsReturnsNullIfNoConstructorExists($rc) {
        $params = $rc->getConstructorParameters('Param');
        $this->assertNull($params);

        return $rc;
    }

    /**
     * @depends testGetCtorParamsReturnsNullIfNoConstructorExists
     * @covers Auryn\ReflectionPool::getConstructorParameters
     */
    public function testGetCtorParamsRetrievesCachedReflectionIfAvailable($rc) {
        $params = $rc->getConstructorParameters('Test');
        $p1 = $rc->getConstructor('Test')->getParameters();
        $this->assertTrue(is_array($p1));
        $this->assertEquals($p1[0], $params[0]);

        return $rc;
    }

    /**
     * @depends testGetCtorParamsRetrievesCachedReflectionIfAvailable
     * @covers Auryn\ReflectionPool::getParamTypeHint
     */
    public function testGetTypeHintRetrievesNewClassNameIfNotStoredForParam($rc) {
        $method = $rc->getConstructor('Test');
        $param = $rc->getConstructorParameters('Test');
        $typeHint = $rc->getParamTypeHint($method, $param[0]);
        $this->assertEquals('Param', $typeHint);

        return $rc;
    }

    /**
     * @depends testGetTypeHintRetrievesNewClassNameIfNotStoredForParam
     * @covers Auryn\ReflectionPool::getParamTypeHint
     */
    public function testGetTypeHintFetchesCachedParamTypeHintIfAvailable($rc) {
        $method = $rc->getConstructor('Test');
        $param = $rc->getConstructorParameters('Test');
        $typeHint = $rc->getParamTypeHint($method, $param[0]);
        $this->assertEquals('Param', $typeHint);

        return $rc;
    }

    /**
     * @depends testGetTypeHintFetchesCachedParamTypeHintIfAvailable
     * @covers Auryn\ReflectionPool::getParamTypeHint
     */
    public function testGetTypeHintStoresNewReflectionClassIfFound($rc) {
        $method = new ReflectionMethod('TypeHintTester', 'myMethod');
        $params = $method->getParameters();

        $typeHint = $rc->getParamTypeHint($method, $params[0]);
        $this->assertEquals('TypeHint', $typeHint);

        return $rc;
    }

    /**
     * @depends testGetTypeHintStoresNewReflectionClassIfFound
     * @covers Auryn\ReflectionPool::getParamTypeHint
     */
    public function testGetTypeHintReturnsNullIfParamHasNoTypeHint($rc) {
        $method = new ReflectionMethod('TypeHintTester', 'myMethod');
        $params = $method->getParameters();

        $typeHint = $rc->getParamTypeHint($method, $params[1]);
        $this->assertEquals(NULL, $typeHint);

        return $rc;
    }
}

class Param {}

class Test
{
    public function __construct(Param $param) {}
}

class TypeHint {}

class TypeHintTester
{
    public function myMethod(TypeHint $arg, $noHint){}
}







