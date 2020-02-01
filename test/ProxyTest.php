<?php

declare (strict_types=1);

namespace Auryn\test;

use Auryn\Injector;
use PHPUnit\Framework\TestCase;

class ProxyTest extends TestCase
{
    /**
     * @expectedException \Auryn\ConfigException
     */
    public function testThrownExceptionIfPassedWrongParameterToProxyMethod()
    {
        $injector = new Injector();
        $injector->proxy(1);
    }

    public function testInstanceProxy()
    {
        $injector = new Injector();
        $injector->proxy('Auryn\Test\TestDependency');
        $class = $injector->make('Auryn\Test\TestDependency');

        $this->assertInstanceOf('Auryn\Test\TestDependency', $class, '');
        $this->assertInstanceOf('ProxyManager\Proxy\LazyLoadingInterface', $class, '');
        $this->assertEquals('testVal', $class->testProp, '');
    }

    public function testMakeInstanceInjectsSimpleConcreteDependencyProxy()
    {
        $injector = new Injector();
        $injector->proxy('Auryn\Test\TestDependency');
        $need_dep = $injector->make('Auryn\Test\TestNeedsDep');

        $this->assertInstanceOf('Auryn\Test\TestNeedsDep', $need_dep, '');
    }

    public function testShareInstanceProxy()
    {
        $injector = new Injector();
        $injector->proxy('Auryn\Test\TestDependency');
        $injector->share('Auryn\Test\TestDependency');
        $class = $injector->make('Auryn\Test\TestDependency');
        $class2 = $injector->make('Auryn\Test\TestDependency');

        $this->assertEquals($class, $class2, '');
    }

    public function testProxyMakeInstanceReturnsAliasInstanceOnNonConcreteTypehint()
    {
        $injector = new Injector();
        $injector->alias('Auryn\Test\DepInterface', 'Auryn\Test\DepImplementation');
        $injector->proxy('Auryn\Test\DepInterface');
        $object = $injector->make('Auryn\Test\DepInterface');

        $this->assertInstanceOf('Auryn\Test\DepInterface', $object, '');
        $this->assertInstanceOf('Auryn\Test\DepImplementation', $object, '');
        $this->assertInstanceOf('ProxyManager\Proxy\LazyLoadingInterface', $object, '');
    }

    public function testProxyPrepare()
    {
        $injector = new Injector();
        $injector->proxy('Auryn\Test\PreparesImplementationTest');
        $injector->prepare(
            'Auryn\Test\PreparesImplementationTest',
            function (PreparesImplementationTest $obj, $injector) {
                $obj->testProp = 42;
            });
        $obj = $injector->make('Auryn\Test\PreparesImplementationTest');

        $this->assertSame(42, $obj->testProp);
    }
}
