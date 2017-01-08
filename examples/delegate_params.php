<?php

require __DIR__ . "/../vendor/autoload.php";

class A {
    private $a;
    private $b;

    public function __construct(stdClass $a, stdClass $b) {
        $this->a = $a;
        $this->b = $b;
    }

    public function print() {
        print $this->a->foo;
        print $this->b->foo;
        print PHP_EOL;
    }
}

$injector = new Auryn\Injector;

$injector->define(A::class, [
    "+a" => function () {
        $std = new stdClass;
        $std->foo = "foo";
        return $std;
    },
    "+b" => function () {
        $std = new stdClass;
        $std->foo = "bar";
        return $std;
    },
]);

$a = $injector->make(A::class);
$a->print();
