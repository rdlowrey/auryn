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
     * @covers Auryn\Provider::buildWithoutConstructorParams
     */
    public function testMakeReturnsNewInstanceIfClassHasNoConstructor() {
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(new TestNoConstructor, $provider->make('TestNoConstructor'));
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     */
    public function testMakeReturnsAliasInstanceOnNonConcreteTypehint() {
        $provider = new Provider(new ReflectionPool);
        $provider->alias('DepInterface', 'DepImplementation');
        $this->assertEquals(new DepImplementation, $provider->make('DepInterface'));
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnNonConcreteParameterWithoutAlias() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('DepInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnInvalidAliasTypeMismatch() {
        $provider = new Provider(new ReflectionPool);
        $provider->alias('DepInterface', 'StdClass');
        $provider->make('DepInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
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
     * @covers Auryn\Provider::buildArgumentFromTypeHint
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     * @covers Auryn\Provider::buildAbstractTypehintParam
     */
    public function testMakeBuildsNonConcreteCtorParamWithAlias() {
        $provider = new Provider(new ReflectionPool);
        $provider->alias('DepInterface', 'DepImplementation');
        $obj = $provider->make('RequiresInterface');
        $this->assertInstanceOf('RequiresInterface', $obj);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildArgumentFromTypeHint
     * @covers Auryn\Provider::buildWithoutConstructorParams
     * @covers Auryn\Provider::buildImplementation
     * @covers Auryn\Provider::buildAbstractTypehintParam
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnNonConcreteCtorParamWithBadAlias() {
        $provider = new Provider(new ReflectionPool);
        $provider->alias('DepInterface', 'StdClass');
        $provider->make('RequiresInterface');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildArgumentFromTypeHint
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakePassesNullCtorParameterIfNoTypehintOrDefaultCanBeDetermined() {
        $provider = new Provider(new ReflectionPool);
        $nullCtorParamObj = $provider->make('ProvTestNoDefinitionNullDefaultClass');
        $this->assertEquals(new ProvTestNoDefinitionNullDefaultClass, $nullCtorParamObj);
        $this->assertEquals(NULL, $nullCtorParamObj->arg);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
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
     * @covers Auryn\Provider::isInstantiable
     * @covers Auryn\Provider::selectParentDefinitions
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnClassLoadFailure() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('ClassThatDoesntExist');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakeUsesInstanceDefinitionParamIfSpecified() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('TestMultiDepsNeeded', array('TestDependency', new TestDependency2));
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::selectDefinition
     * @covers Auryn\Provider::getDefinition
     * @covers Auryn\Provider::buildArgumentFromTypeHint
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
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::selectDefinition
     * @covers Auryn\Provider::getDefinition
     * @covers Auryn\Provider::buildArgumentFromTypeHint
     * @covers Auryn\Provider::isInstantiable
     */
    public function testMakeCustomDefinitionOverridesExistingDefinitions() {
        $provider = new Provider(new ReflectionPool);
        $provider->define('ProviderTestChildClass', array(':arg1'=>'First argument', ':arg2'=>'Second argument'));
        $injected = $provider->make('ProviderTestChildClass', array(':arg1'=>'Override'));
        $this->assertEquals('Override', $injected->arg1);
        $this->assertEquals('Second argument', $injected->arg2);
    }
    
    /**
     * @covers Auryn\Provider::make
     */
    public function testMakeStoresShareIfMarkedWithNullInstance() {
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $provider->make('TestDependency');
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
     * @covers Auryn\Provider::buildArgumentFromTypeHint
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
     * @covers Auryn\Provider::buildArgumentFromTypeHint
     */
    public function testMakeInjectsNullOnUntypehintedParameterWithoutDefinitionOrDefault() {
        $provider  = new Provider(new ReflectionPool);
        $obj = $provider->make('ProviderTestCtorParamWithNoTypehintOrDefault');
        $this->assertNull($obj->val);
    }
    
    /**
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::getInjectedInstance
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
            ->will($this->returnValue(new Auryn\InjectionException()));

        $provider->make('TestDependency');

        $this->assertInstanceOf('TestDependency', $obj);
    }

    /**
     * @covers Auryn\Provider::make
     */
    public function testMakeHandlesNamespacedClasses() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('SomeNamespace\\SomeClassName');
    }

    /**
     * @covers Auryn\Provider::delegate
     * @covers Auryn\Provider::doDelegation
     * @covers Auryn\Provider::make
     */
    public function testMakeDelegate() {
        $provider= new Provider(new ReflectionPool);

        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );
        $callable->expects($this->once())
            ->method('__invoke')
            ->will($this->returnValue(new TestDependency()));

        $provider->delegate('TestDependency', $callable);

        $obj = $provider->make('TestDependency');

        $this->assertInstanceOf('TestDependency', $obj);
    }
    
    /**
     * @covers Auryn\Provider::doDelegation
     * @covers Auryn\Provider::make
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
     * @expectedException Auryn\BadArgumentException
     */
    public function testMakeThrowsExceptionIfStringDelegateClassHasNoInvokeMethod() {
        $provider= new Provider(new ReflectionPool);
        $provider->delegate('StdClass', 'StringDelegateWithNoInvokeMethod');
        $obj = $provider->make('StdClass');
    }
    
    /**
     * @covers Auryn\Provider::doDelegation
     * @covers Auryn\Provider::make
     * @expectedException Auryn\BadArgumentException
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
     * @expectedException Auryn\BadArgumentException
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
     * @covers Auryn\Provider::make
     * @covers Auryn\Provider::selectParentDefinitions
     * @covers Auryn\Provider::getDefinition
     */
    public function testMakeInheritsParentClassDefinitionsForInstantiation()
    {
        $provider = new Provider(new ReflectionPool);
        $provider->define('ProviderTestParentClass', array(':arg1' => 'First argument'));

        $provider->define('ProviderTestChildClass', array(':arg2' => 'Second argument'));
        $obj = $provider->make('ProviderTestChildClass');
        $this->assertEquals('First argument', $obj->arg1);
        $this->assertEquals('Second argument', $obj->arg2);
    }
    
    /**
     * @covers Auryn\Provider::define
     * @covers Auryn\Provider::selectDefinition
     * @covers Auryn\Provider::getDefinition
     */
    public function testDefineAssignsPassedDefinition() {
        $provider = new Provider(new ReflectionPool);
        $definition = array('dep' => 'DepImplementation');
        $provider->define('RequiresInterface', $definition);
        $this->assertInstanceOf('RequiresInterface', $provider->make('RequiresInterface'));
    }
    
    /**
     * @covers Auryn\Provider::refresh
     */
    public function testRefreshShareClearsSharedInstanceAndReturnsNull() {
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $obj = $provider->make('TestDependency');
        $obj->testProp = 42;
        
        $this->assertEquals(null, $provider->refresh('TestDependency'));
        $refreshedObj = $provider->make('TestDependency');
        $this->assertEquals('testVal', $refreshedObj->testProp);
    }
    
    /**
     * @covers Auryn\Provider::unshare
     */
    public function testUnshareRemovesSharingAndReturnsNull() { 
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $this->assertEquals(null, $provider->unshare('TestDependency'));
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
     * @covers Auryn\Provider::share
     */
    public function testShareMarksClassSharedOnNullObjectParameter() {
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(null, $provider->share('Atreyu\\Events\\Mediator'));
    }
    
    /**
     * @covers Auryn\Provider::share
     * @expectedException Auryn\BadArgumentException
     */
    public function testShareThrowsExceptionOnInvalidArgument() {
        $provider = new Provider(new ReflectionPool);
        $provider->share(42);
    }
    
    /**
     * @covers Auryn\Provider::alias
     */
    public function testAliasAssignsValueAndReturnsNull() {
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(null, $provider->alias('DepInterface', 'DepImplementation'));
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
     * @expectedException Auryn\BadArgumentException
     */
    public function testDelegateThrowsExceptionIfDelegateIsNotCallableOrString($badDelegate) {
        $provider = new Provider(new ReflectionPool);
        $provider->delegate('TestDependency', $badDelegate);
    }
    
    public function testDelegateInstantiatesCallableClassString() {
        $provider = new Provider;
        $provider->delegate('MadeByDelegate', 'CallableDelegateClassTest');
        $this->assertInstanceof('MadeByDelegate', $provider->make('MadeByDelegate'));
    }
    
    public function testDelegateInstantiatesCallableClassArray() {
        $provider = new Provider;
        $provider->delegate('MadeByDelegate', array('CallableDelegateClassTest', '__invoke'));
        $this->assertInstanceof('MadeByDelegate', $provider->make('MadeByDelegate'));
    }
    
    /**
     * @dataProvider provideExecutionExpectations
     * @covers Auryn\Provider::execute
     * @covers Auryn\Provider::generateExecutableReflection
     * @covers Auryn\Provider::generateStaticReflectionMethod
     * @covers Auryn\Provider::generateInvocationArgs
     * @covers Auryn\Provider::isDefined
     * @covers Auryn\Provider::isShared
     */
    public function testExecutions($callable, $definition, $expectedResult) {
        $provider = new Provider;
        $this->assertEquals($expectedResult, $provider->execute($callable, $definition));
    }
    
    public function provideExecutionExpectations() {
        $return = array();
        
        // 0 -------------------------------------------------------------------------------------->
        
        $toInvoke = array('ExecuteClassNoDeps', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 1 -------------------------------------------------------------------------------------->
        
        $toInvoke = array(new ExecuteClassNoDeps, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 2 -------------------------------------------------------------------------------------->
        
        $toInvoke = array('ExecuteClassDeps', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 3 -------------------------------------------------------------------------------------->
        
        $toInvoke = array(new ExecuteClassDeps(new TestDependency), 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 4 -------------------------------------------------------------------------------------->
        
        $toInvoke = array('ExecuteClassDepsWithMethodDeps', 'execute');
        $args = array(':arg' => 9382);
        $expectedResult = 9382;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 5 -------------------------------------------------------------------------------------->
        
        $toInvoke = array('ExecuteClassStaticMethod', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 6 -------------------------------------------------------------------------------------->
        
        $toInvoke = array(new ExecuteClassStaticMethod, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 7 -------------------------------------------------------------------------------------->
        
        $toInvoke = 'ExecuteClassStaticMethod::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 8 -------------------------------------------------------------------------------------->
        
        $toInvoke = array('ExecuteClassRelativeStaticMethod', 'parent::execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 9 -------------------------------------------------------------------------------------->
        
        $toInvoke = 'testExecuteFunction';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 10 ------------------------------------------------------------------------------------->
        
        $toInvoke = function() { return 42; };
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 11 ------------------------------------------------------------------------------------->
        
        $toInvoke = new ExecuteClassInvokable;
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // 12 ------------------------------------------------------------------------------------->
        
        $toInvoke = 'ExecuteClassInvokable';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);
        
        // x -------------------------------------------------------------------------------------->
        
        return $return;
    }
    
}

