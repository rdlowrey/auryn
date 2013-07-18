<?php

class ConcreteClass1 {}

class ConcreteClass2 {}

class ClassWithoutMagicInvoke {}

class TestNoConstructor {}

class TestDependency {
    public $testProp = 'testVal';
}

class TestDependency2 extends TestDependency {
    public $testProp = 'testVal2';
}

class SpecdTestDependency extends TestDependency {
    public $testProp = 'testVal';
}

class TestNeedsDep {
    public function __construct(TestDependency $testDep) {
        $this->testDep = $testDep;
    }
}

class TestClassWithNoCtorTypehints {
    public function __construct($val = 42) {
        $this->test = $val;
    }
}

class TestMultiDepsNeeded {
    public function __construct(TestDependency $val1, TestDependency2 $val2) {
        $this->testDep = $val1;
        $this->testDep = $val2;
    }
}


class TestMultiDepsWithCtor {
    public function __construct(TestDependency $val1, TestNeedsDep $val2) {
        $this->testDep = $val1;
        $this->testDep = $val2;
    }
}

class NoTypehintNullDefaultConstructorClass {
    public $testParam = 1;
    public function __construct(TestDependency $val1, $arg=42) {
        $this->testParam = $arg;
    }
}

class NoTypehintNoDefaultConstructorClass {
    public $testParam = 1;
    public function __construct(TestDependency $val1, $arg = NULL) {
        $this->testParam = $arg;
    }
}

interface DepInterface {}
interface SomeInterface {}
class SomeImplementation implements SomeInterface {}

class DepImplementation implements DepInterface {
    public $testProp = 'something';
}

class RequiresInterface {
    public $dep;
    public function __construct(DepInterface $dep) {
        $this->testDep = $dep;
    }
}

class ProvTestNoDefinitionNullDefaultClass {
    public function __construct($arg = NULL) {
        $this->arg = $arg;
    }
}

class ProviderTestCtorParamWithNoTypehintOrDefault {
    public $val = 42;
    public function __construct($val) {
        $this->val = $val;
    }
}

class ProviderTestRawCtorParams {
    public $string;
    public $obj;
    public $int;
    public $array;
    public $float;
    public $bool;
    
    public function __construct($string, $obj, $int, $array, $float, $bool) {
        $this->string = $string;
        $this->obj = $obj;
        $this->int = $int;
        $this->array = $array;
        $this->float = $float;
        $this->bool = $bool;
    }
}

class ProviderTestParentClass
{
    public function __construct($arg1) {
        $this->arg1 = $arg1;
    }
}

class ProviderTestChildClass extends ProviderTestParentClass
{
    public function __construct($arg1, $arg2) {
        parent::__construct($arg1);
        $this->arg2 = $arg2;
    }

}

class CallableMock {
    function __invoke() {

    }
}

class StringStdClassDelegateMock {
    function __invoke() {
        return $this->make();
    }
    private function make() {
        $obj = new StdClass;
        $obj->test = 42;
        return $obj;
    }
}

class StringDelegateWithNoInvokeMethod {}

class ExecuteClassNoDeps {
    function execute() {
        return 42;
    }
}

class ExecuteClassDeps {
    function __construct(TestDependency $testDep) {}
    function execute() {
        return 42;
    }
}

class ExecuteClassDepsWithMethodDeps {
    function __construct(TestDependency $testDep) {}
    function execute(TestDependency $dep, $arg = NULL) {
        return isset($arg) ? $arg : 42;
    }
}

class ExecuteClassStaticMethod {
    static function execute() {
        return 42;
    }
}

class ExecuteClassRelativeStaticMethod extends ExecuteClassStaticMethod {
    static function execute() {
        return 'this should NEVER be seen since we are testing against parent::execute()';
    }
}

class ExecuteClassInvokable {
    function __invoke() {
        return 42;
    }
}

function testExecuteFunction() {
    return 42;
}

class MadeByDelegate {}

class CallableDelegateClassTest {
    function __invoke() {
        return new MadeByDelegate;
    }
}

interface DelegatableInterface {
    function foo();
}

class ImplementsInterface implements DelegatableInterface{
    function foo(){
    }
}

class ImplementsInterfaceFactory{
    public function __invoke() {
        return new ImplementsInterface();
    }
}

class RequiresDelegatedInterface {
    private $interface;

    public function __construct(DelegatableInterface $interface) {
        $this->interface = $interface;
    }
    public function foo() {
        $this->interface->foo();
    }
}

class TestMissingDependency {
 
    function __construct(TypoInTypehint $class) {        
    }
}
