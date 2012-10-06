<?php

use Auryn\Provider,
    Auryn\ReflectionPool;

class ProviderTest extends PHPUnit_Framework_TestCase {

    /**
     * @covers Auryn\Provider::__construct
     */
    public function testBeginsEmpty() {
        $provider = new Provider(new ReflectionPool);
        $this->assertInstanceOf('Auryn\\Provider', $provider);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakeInjectsSimpleConcreteDependency() {
    
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(new TestNeedsDep(new TestDependency),
            $provider->make('TestNeedsDep')
        );
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::buildWithoutConstructorParams
     */
    public function testMakeReturnsNewInstanceIfClassHasNoConstructor() {
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(new TestNoConstructor, $provider->make('TestNoConstructor'));
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     */
    public function testMakeReturnsNonConcreteImplementationIfIsImplemented() {
        $provider = new Provider(new ReflectionPool);
        $provider->implement('DepInterface', 'DepImplementation');
        $this->assertEquals(new DepImplementation, $provider->make('DepInterface'));
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnNonConcreteParameterWithoutImplementation() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('DepInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnInvalidImplementationTypeMismatch() {
        $provider = new Provider(new ReflectionPool);
        $provider->implement('DepInterface', 'StdClass');
        $provider->make('DepInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     * @covers Auryn\Provider::buildAbstractTypehintParam
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnNonConcreteCtorParamWithoutImplementation() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('RequiresInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     * @covers Auryn\Provider::buildAbstractTypehintParam
     */
    public function testMakeBuildsNonConcreteCtorParamWithImplementation() {
        $provider = new Provider(new ReflectionPool);
        $provider->implement('DepInterface', 'DepImplementation');
        $obj = $provider->make('RequiresInterface');
        $this->assertInstanceOf('RequiresInterface', $obj);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     * @covers Auryn\Provider::buildAbstractTypehintParam
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnNonConcreteCtorParamWithBadImplementation() {
        $provider = new Provider(new ReflectionPool);
        $provider->implement('DepInterface', 'StdClass');
        $provider->make('RequiresInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakePassesNullCtorParameterIrNoTypehintOrDefaultCanBeDetermined() {
        $provider = new Provider(new ReflectionPool);
        $nullCtorParamObj = $provider->make('ProvTestNoDefinitionNullDefaultClass');
        $this->assertEquals(new ProvTestNoDefinitionNullDefaultClass, $nullCtorParamObj);
        $this->assertEquals(NULL, $nullCtorParamObj->arg);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakeReturnsSharedInstanceIfAvailable() {
        $provider = new Provider(new ReflectionPool);
        $provider->define('RequiresInterface', array('dep' => 'DepImplementation'));
        $provider->share('RequiresInterface');
        $injected = $provider->make('RequiresInterface');
        
        $this->assertEquals('something', $injected->testDep->testProp);
        $injected->testDep->testProp = 'something else';
        
        $injected2 = $provider->make('RequiresInterface');
        $this->assertEquals('something else', $injected2->testDep->testProp);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::isInstantiable
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnClassLoadFailure() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('ClassThatDoesntExist');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakeUsesInstanceDefinitionParamIfSpecified() {
    
        $provider = new Provider(new ReflectionPool);
        $provider->make('TestMultiDepsNeeded', array('TestDependency', new TestDependency2));
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakeUsesCustomDefinitionIfSpecified() {
    
        $provider = new Provider(new ReflectionPool);
        $provider->define('TestNeedsDep', array('testDep'=>'TestDependency'));
        $injected = $provider->make('TestNeedsDep', array('testDep'=>'TestDependency2'));
        $this->assertEquals('testVal2', $injected->testDep->testProp);
    }
    
    /**
     * @covers Auryn\Provider::make
     */
    public function testMakeStoresShareIfMarkedWithNullInstance() {
    
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $provider->make('TestDependency');
        $this->assertTrue($provider->isShared('TestDependency'));
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakeUsesReflectionForUnknownParamsInMultiBuildWithDeps() {
    
        $provider  = new Provider(new ReflectionPool);
        $obj = $provider->make('TestMultiDepsWithCtor', array('val1'=>'TestDependency'));
        $this->assertInstanceOf('TestMultiDepsWithCtor', $obj);
        
        $obj = $provider->make('NoTypehintNoDefaultConstructorClass',
            array('val1'=>'TestDependency')
        );
        $this->assertInstanceOf('NoTypehintNoDefaultConstructorClass', $obj);
        $this->assertEquals(NULL, $obj->testParam);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     */
    public function testMakeInjectsNullOnUntypehintedParameterWithoutDefinitionOrDefault() {
        $provider  = new Provider(new ReflectionPool);
        $obj = $provider->make('ProviderTestCtorParamWithNoTypehintOrDefault');
        $this->assertNull($obj->val);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnUninstantiableTypehintWithoutDefinition() {
        $provider  = new Provider(new ReflectionPool);
        $obj = $provider->make('RequiresInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::validateInjectionDefinition
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildNewInstanceArgs
     */
    public function testMakeInjectsRawParametersDirectlyWhenDefinedWithParameterNamePrefix() {
    
        $provider = new Provider(new ReflectionPool);
        $provider->define('ProviderTestRawCtorParams', array(
            ':string' => 'string',
            ':obj' => new StdClass,
            ':int' => 42,
            ':array' => array(),
            ':float' => 9.3,
            ':bool' => true,
        ));
        
        $obj = $provider->make('ProviderTestRawCtorParams');
        $this->assertInternalType('string', $obj->string);
        $this->assertInstanceOf('StdClass', $obj->obj);
        $this->assertInternalType('int', $obj->int);
        $this->assertInternalType('array', $obj->array);
        $this->assertInternalType('float', $obj->float);
        $this->assertInternalType('bool', $obj->bool);
    }

    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::doDelegation
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionWhenDelegateDoes() {
        $provider= new Provider(new ReflectionPool);

        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );

        $provider->delegate('TestDependency', $callable);

        $callable->expects($this->once())
            ->method('__invoke')
            ->with('TestDependency')
            ->will($this->throwException(new Auryn\InjectionException()));

        $provider->make('TestDependency');
    }
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::doDelegation
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionWhenDelegateFailsToCreateObject() {
        $provider= new Provider(new ReflectionPool);

        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );

        $provider->delegate('TestDependency', $callable);

        $callable->expects($this->once())
            ->method('__invoke')
            ->with('TestDependency')
            ->will($this->returnValue(new Auryn\InjectionException()));

        $provider->make('TestDependency');

        $this->assertInstanceOf('TestDependency', $obj);
    }

    /**
     * @covers Auryn\Provider::delegate
     * @covers Auryn\Provider::doDelegation
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::isDelegated
     */
    public function testMakeDelegate() {
        $provider= new Provider(new ReflectionPool);

        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );
        $callable->expects($this->once())
            ->method('__invoke')
            ->with('TestDependency')
            ->will($this->returnValue(new TestDependency()));

        $provider->delegate('TestDependency', $callable);

        $obj = $provider->make('TestDependency');

        $this->assertInstanceOf('TestDependency', $obj);
    }
    
    /**
     * @covers Auryn\Provider::doDelegation
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::isDelegated
     */
    public function testMakeWithStringDelegate() {
        $provider= new Provider(new ReflectionPool);
        $provider->delegate('StdClass', 'StringStdClassDelegateMock');
        $obj = $provider->make('StdClass');
        $this->assertEquals(42, $obj->test);
    }
    
    /**
     * @covers Auryn\Provider::doDelegation
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::isDelegated
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionIfStringDelegateClassHasNoInvokeMethod() {
        $provider= new Provider(new ReflectionPool);
        $provider->delegate('StdClass', 'StringDelegateWithNoInvokeMethod');
        $obj = $provider->make('StdClass');
    }
    
    /**
     * @covers Auryn\Provider::doDelegation
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::isDelegated
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionIfStringDelegateClassInstantiationFails() {
        $provider= new Provider(new ReflectionPool);
        $provider->delegate('StdClass', 'SomeClassThatDefinitelyDoesNotExistForReal');
        $obj = $provider->make('StdClass');
    }
    
    public function provideInvalidRawDefinitions() {
        return array(
            array(array('obj' => new StdClass)),
            array(array('int' => 42)),
            array(array('array' => array())),
            array(array('float' => 9.3)),
            array(array('bool' => true)),
        );
    }
    
    /**
     * @dataProvider provideInvalidRawDefinitions
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::validateInjectionDefinition
     * @expectedException Auryn\InjectionException
     */
    public function testDefineThrowsExceptionOnRawParamDefinitionMissingRawParameterPrefix($def) {
        $provider = new Provider(new ReflectionPool);
        $provider->define('TestClass', $def);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance    
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnUntypehintedParameterWithNoDefinition() {
    
        $provider = new Provider(new ReflectionPool);
        $obj = $provider->make('RequiresInterface');
    }
    
    /**
     * @covers Auryn\Provider::define
     */
    public function testDefineAssignsPassedDefinition() {
        
        $provider = new Provider(new ReflectionPool);
        $definition = array('dep' => 'DepImplementation');
        $provider->define('RequiresInterface', $definition);
        $this->assertInstanceOf('RequiresInterface', $provider->make('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::defineAll
     * @expectedException InvalidArgumentException
     */
    public function testDefineAllThrowsExceptionOnInvalidIterable() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->defineAll(1);
    }
    
    /**
     * @covers Auryn\Provider::clearAllDefinitions
     */
    public function testClearAllDefinitionsRemovesDefinitions() {
        
        $provider = new Provider(new ReflectionPool);
        $this->assertFalse($provider->isDefined('RequiresInterface'));
        $provider->define('RequiresInterface', array('dep' => 'DepImplementation'));
        $this->assertTrue($provider->isDefined('RequiresInterface'));
        $provider->clearAllDefinitions();
        $this->assertFalse($provider->isDefined('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::defineAll
     */
    public function testDefineAllAssignsPassedDefinitionsAndReturnsAddedCount() {
        
        $provider = new Provider(new ReflectionPool);
        $depList = array();
        $depList['RequiresInterface'] = array('dep' => 'DepImplementation');
        
        $this->assertEquals(1, $provider->defineAll($depList));
        $this->assertInstanceOf('RequiresInterface', $provider->make('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::clearDefinition
     */
    public function testClearDefinitionRemovesDefinitionAndReturnsNull() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->define('RequiresInterface', array('dep' => 'DepImplementation'));
        $this->assertTrue($provider->isDefined('RequiresInterface'));
        $this->assertEquals(null, $provider->clearDefinition('RequiresInterface'));
        $this->assertFalse($provider->isDefined('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::clearAllDefinitions
     */
    public function testClearAllDefinitionsRemovesDefinitionAndReturnsNull() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->define('RequiresInterface', array('dep' => 'DepImplementation'));
        $this->assertTrue($provider->isDefined('RequiresInterface'));
        
        $return = $provider->clearAllDefinitions();
        $this->assertEquals(null, $provider->clearAllDefinitions());
        $this->assertFalse($provider->isDefined('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::refreshShare
     */
    public function testRefreshShareClearsSharedInstanceAndReturnsNull() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $obj = $provider->make('TestDependency');
        $this->assertTrue($provider->isShared('TestDependency'));
        $obj->testProp = 42;
        
        $this->assertEquals(null, $provider->refreshShare('TestDependency'));
        $this->assertTrue($provider->isShared('TestDependency'));
        $refreshedObj = $provider->make('TestDependency');
        $this->assertEquals('testVal', $refreshedObj->testProp);
    }
    
    /**
     * @covers Auryn\Provider::isShared
     */
    public function testIsSharedReturnsBooleanStatus() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $this->assertTrue($provider->isShared('TestDependency'));
        $provider->unshare('TestDependency');
        $this->assertFalse($provider->isShared('TestDependency'));
    }
    
    /**
     * @covers Auryn\Provider::unshare
     */
    public function testUnshareRemovesSharingAndReturnsNull() { 
    
        $provider = new Provider(new ReflectionPool);
        $this->assertFalse($provider->isShared('TestDependency'));
        $provider->share('TestDependency');
        $this->assertTrue($provider->isShared('TestDependency'));
        $this->assertEquals(null, $provider->unshare('TestDependency'));
        $this->assertFalse($provider->isShared('TestDependency'));
    }
    
    /**
     * @covers Auryn\Provider::isDefined
     */
    public function testIsDefinedReturnsDefinitionStatus() {
    
        $provider = new Provider(new ReflectionPool);
        $this->assertFalse($provider->isDefined('RequiresInterface'));
        $provider->define('RequiresInterface', array('dep' => 'DepImplementation'));
        
        $this->assertTrue($provider->isDefined('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::share
     */
    public function testShareStoresSharedInstanceAndReturnsNull() {
        $provider = new Provider(new ReflectionPool);
        $testShare = new StdClass;
        $testShare->test = 42;
        
        $this->assertEquals(null, $provider->share($testShare));
        $testShare->test = 'test';
        $this->assertEquals('test', $provider->make('stdclass')->test);
    }
    
    /**
     * @covers Auryn\Provider::shareAll
     */
    public function testShareAllStoresSpecifiedValuesAndReturnsNull() {
        $reflPool = $this->getMock('Auryn\\ReflectionPool');
        $provider = $this->getMock('Auryn\\Provider', array('share'), array($reflPool));
        $provider->expects($this->exactly(3))
                 ->method('share');
        
        $toShare = array('Class1', 'Class2', new StdClass);
        $this->assertNull($provider->shareAll($toShare));
    }
    
    /**
     * @covers Auryn\Provider::shareAll
     * @expectedException InvalidArgumentException
     */
    public function testShareAllThrowsExceptionOnInvalidParameter() {
        $reflPool = $this->getMock('Auryn\\ReflectionPool');
        $provider = $this->getMock('Auryn\\Provider', array('share'), array($reflPool));
        
        $toShare = 'not an array or traversable';
        $provider->shareAll($toShare);
    }
    
    /**
     * @covers Auryn\Provider::share
     */
    public function testShareMarksClassSharedOnNullObjectParameter() {
        
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(null, $provider->share('Atreyu\\Events\\Mediator'));
        $this->assertTrue($provider->isShared('Atreyu\Events\Mediator'));
    }
    
    /**
     * @covers Auryn\Provider::share
     * @expectedException InvalidArgumentException
     */
    public function testShareThrowsExceptionOnInvalidArgument() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->share(42);
    }
    
    /**
     * @covers Auryn\Provider::implement
     * @covers Auryn\Provider::isImplemented
     */
    public function testImplementAssignsValueAndReturnsNull() {
        
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(null, $provider->implement('DepInterface', 'DepImplementation'));
        $this->assertTrue($provider->isImplemented('DepInterface'));
    }
    
    /**
     * @covers Auryn\Provider::implementAll
     * @expectedException InvalidArgumentException
     */
    public function testImplementAllThrowsExceptionOnNonIterableParameter() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->implementAll('not iterable');
    }
    
    /**
     * @covers Auryn\Provider::implementAll
     */
    public function testImplementAllAssignsPassedImplementationsAndReturnsAddedCount() {
        
        $provider = new Provider(new ReflectionPool);
        $implementations = array(
            'DepInterface' => 'DepImplementation',
            'AnotherInterface' => 'AnotherImplementation'
        );
        
        $this->assertEquals(2, $provider->implementAll($implementations));
        $this->assertInstanceOf('RequiresInterface', $provider->make('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::clearAllImplementations
     */
    public function testClearAllImplementationsRemovesImplementations() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->implement('DepInterface', 'DepImplementation');
        $this->assertTrue($provider->isImplemented('DepInterface'));
        $provider->clearAllImplementations();
        $this->assertFalse($provider->isImplemented('DepInterface'));
    }
    
    /**
     * @covers Auryn\Provider::clearImplementation
     * @covers Auryn\Provider::isImplemented
     */
    public function testClearImplementationRemovesAssignedTypeAndReturnsNull() {
        
        $provider = new Provider(new ReflectionPool);
        $provider->implement('DepInterface', 'DepImplementation');
        $this->assertTrue($provider->isImplemented('DepInterface'));
        $this->assertEquals(null, $provider->clearImplementation('DepInterface'));
        $this->assertFalse($provider->isImplemented('DepInterface'));
    }

    public function provideInvalidDelegates() {
        return array(
            array(new StdClass),
            array(42),
            array(true)
        );
    }
    
    /**
     * @dataProvider provideInvalidDelegates
     * @covers Auryn\Provider::delegate
     * @covers Auryn\Provider::make
     * @expectedException BadFunctionCallException
     */
    public function testDelegateThrowsExceptionIfDelegateIsNotCallableOrString($badDelegate) {
        $provider= new Provider(new ReflectionPool);
        $provider->delegate('TestDependency', $badDelegate);
    }
}

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