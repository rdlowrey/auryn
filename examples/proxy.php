<?php

use ProxyManager\Factory\LazyLoadingValueHolderFactory;

require __DIR__ . '/../vendor/autoload.php';

interface Engine
{
	public function turnOn();
}

class V8 implements Engine
{
	public $value = '';

	public function __construct( string $arg )
	{
		print __METHOD__ . PHP_EOL;
	}

	public function turnOn()
	{
		print __METHOD__ . PHP_EOL;
	}
}

class Car
{
	private $engine;

	public function __construct(Engine $engine)
	{
		$this->engine = $engine;

		print __METHOD__ . PHP_EOL;
	}

	public function turnRight()
	{
		print __METHOD__ . PHP_EOL;
	}

	public function turnLeft()
	{
		$this->engine->turnOn();

		print __METHOD__ . PHP_EOL;
		print $this->engine->value . PHP_EOL;
	}
}

$proxy = static function ( string $className, callable $callback ) {
	return (new LazyLoadingValueHolderFactory)->createProxy( $className,
		static function ( &$object, $proxy, $method, $parameters, &$initializer ) use ( $callback ) {
			$object = $callback();
			$initializer = null;
		} );
};

$injector = new Auryn\Injector;
$injector->alias(Engine::class, V8::class);
$injector->proxy(Car::class, $proxy);
$injector->proxy(V8::class, $proxy);
$injector->defineParam( 'arg', 'some text' );
$injector->prepare( V8::class, function ( V8 $v8, \Auryn\Injector $injector ) {
	$v8->value = 42;
} );

print 'Configuration complete.' . PHP_EOL;

$car = $injector->make(Car::class);

print '$car is an instance of Car: ';
var_dump($car instanceof Car);

print 'Note: Constructor of Car has not been called, yet.' . PHP_EOL;

print 'turnRight call the Car constructor.' . PHP_EOL;

$car->turnRight();

print 'turnLeft call the V8 constructor.' . PHP_EOL;

$car->turnLeft();

$car->turnLeft();
