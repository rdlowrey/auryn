<?php

use ProxyManager\Factory\LazyLoadingValueHolderFactory;

require __DIR__ . '/../vendor/autoload.php';

interface Engine
{
    public function turnOn();
}

class V8 implements Engine
{
    public function __construct()
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

    public function turnLeft()
    {
        $this->engine->turnOn();

        print __METHOD__ . PHP_EOL;
    }
}

$proxy = static function (string $className) {
    return static function (callable $ctor) use ($className) {
        return (new LazyLoadingValueHolderFactory)->createProxy($className,
            static function (&$object, $proxy, $method, $parameters, &$initializer) use ($ctor) {
                $object = $ctor();
                $initializer = null;
            });
    };
};

$injector = new Auryn\Injector;
$injector->alias(Engine::class, V8::class);
$injector->proxy(Car::class, $proxy(Car::class));
$injector->proxy(V8::class, $proxy(V8::class));

print 'Configuration complete.' . PHP_EOL;

$car = $injector->make(Car::class);

print '$car is an instance of Car: ';
var_dump($car instanceof Car);

print 'Note: Constructor of Car has not been called, yet.' . PHP_EOL;

$car->turnLeft();
$car->turnLeft();
