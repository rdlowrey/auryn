<?php
declare (strict_types=1);

namespace Auryn\test;

use Auryn\CachingReflector;
use Auryn\Injector;
use Auryn\Proxy;
use Auryn\ProxyInterface;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\LazyLoadingInterface;
use ProxyManager\Proxy\VirtualProxyInterface;

/**
 * Class ProxyTest
 * @package Auryn\test
 */
class ProxyTest extends TestCase
{
	protected function setUp(  )
	{
	}

	protected function tearDown()
	{
	}

	// Integration Tests

    public function testInstanceReturnedFromProxy()
    {
        $injector = new Injector();

		$injector->proxy(
			TestDependency::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			}
		);

        $class = $injector->make(TestDependency::class);

        $this->assertInstanceOf( TestDependency::class, $class, '');
        $this->assertInstanceOf( LazyLoadingInterface::class, $class, '');
        $this->assertEquals('testVal', $class->testProp, '');
    }

    public function testMakeInstanceInjectsSimpleConcreteDependencyProxy()
    {
        $injector = new Injector();
        $injector->proxy(
        	TestDependency::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			});
        $need_dep = $injector->make( TestNeedsDep::class);

        $this->assertInstanceOf( TestNeedsDep::class, $need_dep, '');
    }

    public function testShareInstanceProxy()
    {
        $injector = new Injector();
        $injector->proxy(
        	TestDependency::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			});
        $injector->share( TestDependency::class);
        $class = $injector->make( TestDependency::class);
        $class2 = $injector->make( TestDependency::class);

        $this->assertEquals($class, $class2, '');
    }

    public function testProxyMakeInstanceReturnsAliasInstanceOnNonConcreteTypehint()
    {
        $injector = new Injector();
        $injector->alias( DepInterface::class, DepImplementation::class);
        $injector->proxy(
        	DepInterface::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			});
        $object = $injector->make( DepInterface::class);

        $this->assertInstanceOf( DepInterface::class, $object, '');
        $this->assertInstanceOf( DepImplementation::class, $object, '');
        $this->assertInstanceOf( LazyLoadingInterface::class, $object, '');
    }

    public function testProxyDefinition()
    {
        $injector = new Injector();
        $injector->proxy(
        	NoTypehintNoDefaultConstructorClass::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			});
        $injector->define(
			NoTypehintNoDefaultConstructorClass::class,
            [
            	':arg'	=> 42
			]
		);

        $obj = $injector->make( NoTypehintNoDefaultConstructorClass::class);

        $this->assertEquals(42, $obj->testParam);
    }

    public function testProxyInjectionDefinition()
    {
        $injector = new Injector();
        $injector->proxy(
        	NoTypehintNoDefaultConstructorClass::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			});

        $obj = $injector->make( NoTypehintNoDefaultConstructorClass::class, [
			':arg'	=> 42
		]);

        $this->assertEquals(42, $obj->testParam);
    }

    public function testProxyParamDefinition()
    {
        $injector = new Injector();
        $injector->proxy(
        	NoTypehintNoDefaultConstructorClass::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			});

        $injector->defineParam('arg', 42);

        $obj = $injector->make( NoTypehintNoDefaultConstructorClass::class);

        $this->assertEquals(42, $obj->testParam);
    }

    public function testProxyPrepare()
    {
        $injector = new Injector();
        $injector->proxy(
        	PreparesImplementationTest::class,
			static function ( string $className, callable $callback ) {
				return (new LazyLoadingValueHolderFactory)->createProxy( $className,
					static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
						$object = $callback();
						$initializer = null;
					} );
			});

        $injector->prepare(
            PreparesImplementationTest::class,
            function (PreparesImplementationTest $obj, $injector) {
                $obj->testProp = 42;
            });

        $obj = $injector->make( PreparesImplementationTest::class);

        $this->assertSame(42, $obj->testProp);
    }

    public function testProxyAssertDelegateOverrideProxy()
    {
        $injector = new Injector();
        $injector->proxy(PreparesImplementationTest::class, function (){});
        $injector->delegate(
            PreparesImplementationTest::class,
            function () {
                return new PreparesImplementationTest();
            });

        $object = $injector->make( PreparesImplementationTest::class);

        $this->assertInstanceOf(PreparesImplementationTest::class, $object, '');
		$this->assertNotInstanceOf( LazyLoadingInterface::class, $object, '');
    }
}
