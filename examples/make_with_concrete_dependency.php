<?php

use Auryn\Injector;

require __DIR__ . "/../vendor/autoload.php";

$injector = new Injector;

class A {
    public $std;

    public function __construct(stdClass $std) {
        $this->std = $std;
    }
}

$stdClass = new stdClass;
$stdClass->foo = "foobar";

$a = $injector->make(A::class, [
    ":std" => $stdClass,
]);

print $a->std->foo . PHP_EOL;