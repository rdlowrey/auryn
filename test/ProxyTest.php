<?php

declare (strict_types=1);

namespace Auryn\test;

use Auryn\Injector;
use Auryn\Proxy;
use Auryn\ProxyInterface;
use Auryn\Reflector;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use ProxyManager\Factory\AccessInterceptorScopeLocalizerFactory;
use ProxyManager\Factory\LazyLoadingGhostFactory;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Factory\NullObjectFactory;
use ProxyManager\Factory\RemoteObjectFactory;
use ProxyManager\Proxy\VirtualProxyInterface;

class ProxyTest extends TestCase
{
	public function testProxy() {
		$proxy = new Proxy();
		$this->assertInstanceOf( ProxyInterface::class, $proxy, '' );
	}

	public function testCreateProxy() {
		$proxy_manager = $this->prophesize( LazyLoadingValueHolderFactory::class );
		$proxy_manager_return_type = $this->prophesize(VirtualProxyInterface::class);

		$proxy_manager
			->createProxy( Argument::exact( TestDependency::class), Argument::type('callable') )
			->will(function ($args) use ($proxy_manager_return_type) {
				// Make sure values passed to the real ProxyManager are correct.
				Assert::assertEquals( TestDependency::class, $args[0], '');
				Assert::assertTrue(is_callable($args[1]));
				return $proxy_manager_return_type;
			});

		$proxy = new Proxy( $proxy_manager->reveal() );
		$proxy->createProxy(
			TestDependency::class,
			function () {
				// We don't need to do logic here
			}
		);
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

	public function testGhostProxy() {

//    	$adapter = $this->prophesize( \ProxyManager\Factory\RemoteObject\AdapterInterface::class );
//    	$adapter
//			->call( Argument::type('string'), Argument::type('string'), Argument::type('array') )
//			->will(function ( $args ) {
//				var_dump( $args[2][0] );
//				$args[2][0] = 42;
//		});
//
//		$injector = new Injector( new \Auryn\CachingReflector(), new RemoteObjectFactory($adapter->reveal()) );
//		$injector = new Injector( new \Auryn\CachingReflector(), new LazyLoadingGhostFactory() );
//		$injector = new Injector( new \Auryn\CachingReflector(), new NullObjectFactory() );
//		$injector = new Injector( new \Auryn\CachingReflector(), new AccessInterceptorScopeLocalizerFactory() );
//		$injector->proxy( PreparesImplementationTest::class );
//		$class = $injector->make( PreparesImplementationTest::class );
//		var_dump( $class );
//
//		$class->testProp = 42;
//
//		var_dump( $class->testProp );
    }
}
