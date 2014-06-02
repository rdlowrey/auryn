<?php

use Auryn\Provider,
    Auryn\ReflectionPool;

class ProviderTest extends PHPUnit_Framework_TestCase {

    public function testMakeInjectsSimpleConcreteDependency() {
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(new TestNeedsDep(new TestDependency),
            $provider->make('TestNeedsDep')
        );
    }

    public function testMakeReturnsNewInstanceIfClassHasNoConstructor() {
        $provider = new Provider(new ReflectionPool);
        $this->assertEquals(new TestNoConstructor, $provider->make('TestNoConstructor'));
    }

    public function testMakeReturnsAliasInstanceOnNonConcreteTypehint() {
        $provider = new Provider(new ReflectionPool);
        $provider->alias('DepInterface', 'DepImplementation');
        $this->assertEquals(new DepImplementation, $provider->make('DepInterface'));
    }

    /**
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_NEEDS_DEFINITION
     */
    public function testMakeThrowsExceptionOnInterfaceWithoutAlias() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('DepInterface');
    }

    /**
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_NEEDS_DEFINITION
     */
    public function testMakeThrowsExceptionOnNonConcreteCtorParamWithoutImplementation() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('RequiresInterface');
    }

    public function testMakeBuildsNonConcreteCtorParamWithAlias() {
        $provider = new Provider(new ReflectionPool);
        $provider->alias('DepInterface', 'DepImplementation');
        $obj = $provider->make('RequiresInterface');
        $this->assertInstanceOf('RequiresInterface', $obj);
    }

    public function testMakePassesNullCtorParameterIfNoTypehintOrDefaultCanBeDetermined() {
        $provider = new Provider(new ReflectionPool);
        $nullCtorParamObj = $provider->make('ProvTestNoDefinitionNullDefaultClass');
        $this->assertEquals(new ProvTestNoDefinitionNullDefaultClass, $nullCtorParamObj);
        $this->assertEquals(NULL, $nullCtorParamObj->arg);
    }

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
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnClassLoadFailure() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('ClassThatDoesntExist');
    }

    public function testMakeUsesInstanceDefinitionParamIfSpecified() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('TestMultiDepsNeeded', array('TestDependency', new TestDependency2));
    }

    public function testMakeUsesCustomDefinitionIfSpecified() {
        $provider = new Provider(new ReflectionPool);
        $provider->define('TestNeedsDep', array('testDep'=>'TestDependency'));
        $injected = $provider->make('TestNeedsDep', array('testDep'=>'TestDependency2'));
        $this->assertEquals('testVal2', $injected->testDep->testProp);
    }

    public function testMakeCustomDefinitionOverridesExistingDefinitions() {
        $provider = new Provider(new ReflectionPool);
        $provider->define('ProviderTestChildClass', array(':arg1'=>'First argument', ':arg2'=>'Second argument'));
        $injected = $provider->make('ProviderTestChildClass', array(':arg1'=>'Override'));
        $this->assertEquals('Override', $injected->arg1);
        $this->assertEquals('Second argument', $injected->arg2);
    }

    public function testMakeStoresShareIfMarkedWithNullInstance() {
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $provider->make('TestDependency');
    }

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
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_UNDEFINED_PARAM
     */
    public function testMakeThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefault() {
        $provider  = new Provider(new ReflectionPool);
        $obj = $provider->make('ProviderTestCtorParamWithNoTypehintOrDefault');
        $this->assertNull($obj->val);
    }

    /**
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_UNDEFINED_PARAM
     */
    public function testMakeThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefaultThroughAliasedTypehint() {
        $provider  = new Provider(new ReflectionPool);
        $provider->alias('TestNoExplicitDefine', 'ProviderTestCtorParamWithNoTypehintOrDefault');
        $provider->make('ProviderTestCtorParamWithNoTypehintOrDefaultDependent');
    }

    /**
     * @TODO
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnUninstantiableTypehintWithoutDefinition() {
        $provider  = new Provider(new ReflectionPool);
        $obj = $provider->make('RequiresInterface');
    }

    public function testMakeInjectsRawParametersDirectlyWhenDefinedWithParameterNamePrefix() {
        $provider = new Provider(new ReflectionPool);
        $provider->define('ProviderTestRawCtorParams', array(
            ':string' => 'string',
            ':obj' => new StdClass,
            ':int' => 42,
            ':array' => array(),
            ':float' => 9.3,
            ':bool' => true,
            ':null' => null,
        ));

        $obj = $provider->make('ProviderTestRawCtorParams');
        $this->assertInternalType('string', $obj->string);
        $this->assertInstanceOf('StdClass', $obj->obj);
        $this->assertInternalType('int', $obj->int);
        $this->assertInternalType('array', $obj->array);
        $this->assertInternalType('float', $obj->float);
        $this->assertInternalType('bool', $obj->bool);
        $this->assertNull($obj->null);
    }

    /**
     * @TODO
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
     * @TODO
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

        $obj = $provider->make('TestDependency');

        $this->assertInstanceOf('TestDependency', $obj);
    }

    public function testMakeHandlesNamespacedClasses() {
        $provider = new Provider(new ReflectionPool);
        $provider->make('SomeNamespace\\SomeClassName');
    }

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

    public function testMakeDelegateWithArgs() {
        $provider= new Provider(new ReflectionPool);

        $callable = $this->getMock(
            'CallableMockWithArgs',
            array('__invoke')
        );
        $callable->expects($this->once())
            ->method('__invoke')
            ->with(1, 2)
            ->will($this->returnValue(new TestDependency()));

        $provider->delegate('TestDependency', $callable, array(':arg1' => 1, ':arg2' => 2));

        $obj = $provider->make('TestDependency');

        $this->assertInstanceOf('TestDependency', $obj);
    }

    public function testMakeWithStringDelegate() {
        $provider= new Provider(new ReflectionPool);
        $provider->delegate('StdClass', 'StringStdClassDelegateMock');
        $obj = $provider->make('StdClass');
        $this->assertEquals(42, $obj->test);
    }

    /**
     * @expectedException Auryn\BadArgumentException
     */
    public function testMakeThrowsExceptionIfStringDelegateClassHasNoInvokeMethod() {
        $provider= new Provider(new ReflectionPool);
        $provider->delegate('StdClass', 'StringDelegateWithNoInvokeMethod');
        $obj = $provider->make('StdClass');
    }

    /**
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
     * @expectedException Auryn\BadArgumentException
     */
    public function testDefineThrowsExceptionOnRawParamDefinitionMissingRawParameterPrefix($def) {
        $provider = new Provider(new ReflectionPool);
        $provider->define('TestClass', $def);
    }

    /**
     * @expectedException Auryn\InjectionException
     */
    public function testMakeThrowsExceptionOnUntypehintedParameterWithNoDefinition() {

        $provider = new Provider(new ReflectionPool);
        $obj = $provider->make('RequiresInterface');
    }

    public function testMakeInheritsParentClassDefinitionsForInstantiation()
    {
        $provider = new Provider(new ReflectionPool);
        $provider->define('ProviderTestParentClass', array(':arg1' => 'First argument'));

        $provider->define('ProviderTestChildClass', array(':arg2' => 'Second argument'));
        $obj = $provider->make('ProviderTestChildClass');
        $this->assertEquals('First argument', $obj->arg1);
        $this->assertEquals('Second argument', $obj->arg2);
    }

    public function testDefineAssignsPassedDefinition() {
        $provider = new Provider(new ReflectionPool);
        $definition = array('dep' => 'DepImplementation');
        $provider->define('RequiresInterface', $definition);
        $this->assertInstanceOf('RequiresInterface', $provider->make('RequiresInterface'));
    }

    public function testRefreshShareClearsSharedInstanceAndReturnsCurrentInstance() {
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $obj = $provider->make('TestDependency');
        $obj->testProp = 42;

        $this->assertInstanceOf('Auryn\Provider', $provider->refresh('TestDependency'));
        $refreshedObj = $provider->make('TestDependency');
        $this->assertEquals('testVal', $refreshedObj->testProp);
    }

    public function testUnshareRemovesSharingAndReturnsCurrentInstance() {
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $this->assertInstanceOf('Auryn\Provider', $provider->unshare('TestDependency'));
    }

    public function testShareStoresSharedInstanceAndReturnsCurrentInstance() {
        $provider = new Provider(new ReflectionPool);
        $testShare = new StdClass;
        $testShare->test = 42;

        $this->assertInstanceOf('Auryn\Provider', $provider->share($testShare));
        $testShare->test = 'test';
        $this->assertEquals('test', $provider->make('stdclass')->test);
    }

    public function testShareMarksClassSharedOnNullObjectParameter() {
        $provider = new Provider(new ReflectionPool);
        $this->assertInstanceOf('Auryn\Provider', $provider->share('SomeClass'));
    }

    /**
     * @expectedException Auryn\BadArgumentException
     */
    public function testShareThrowsExceptionOnInvalidArgument() {
        $provider = new Provider(new ReflectionPool);
        $provider->share(42);
    }

    public function testAliasAssignsValueAndReturnsCurrentInstance() {
        $provider = new Provider(new ReflectionPool);
        $this->assertInstanceOf('Auryn\Provider', $provider->alias('DepInterface', 'DepImplementation'));
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

        // 13 ------------------------------------------------------------------------------------->

        $toInvoke = 'ExecuteClassNoDeps::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 14 ------------------------------------------------------------------------------------->

        $toInvoke = 'ExecuteClassDeps::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 15 ------------------------------------------------------------------------------------->

        $toInvoke = 'ExecuteClassStaticMethod::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 16 ------------------------------------------------------------------------------------->

        $toInvoke = 'ExecuteClassRelativeStaticMethod::parent::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);


        $toInvoke = 'testExecuteFunctionWithArg';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // x -------------------------------------------------------------------------------------->

        return $return;
    }

    public function testStaticStringExecutableWithArgument() {
        $provider = new Auryn\Provider;
        $exe = $provider->buildExecutable('ClassWithStaticMethodThatTakesArg::doSomething');
        $this->assertEquals(42, $exe(41));

    }

    public function testInterfaceFactoryDelegation() {
        $injector = new Auryn\Provider(new Auryn\ReflectionPool);
        $injector->delegate('DelegatableInterface', 'ImplementsInterfaceFactory');
        $requiresDelegatedInterface = $injector->make('RequiresDelegatedInterface');
        $requiresDelegatedInterface->foo();
    }

    /**
     * @expectedException Auryn\InjectionException
     */
    public function testMissingAlias() {
        $injector = new Auryn\Provider(new Auryn\ReflectionPool);
        $testClass = $injector->make('TestMissingDependency');
    }

    public function testAliasingConcreteClasses(){
        $provider = new Auryn\Provider();
        $provider->alias('ConcreteClass1', 'ConcreteClass2');
        $obj = $provider->make('ConcreteClass1');
        $this->assertInstanceOf('ConcreteClass2', $obj);
    }

    public function testSharedByAliasedInterfaceName() {
        $provider = new Auryn\Provider();
        $provider->alias('SharedAliasedInterface', 'SharedClass');
        $provider->share('SharedAliasedInterface');
        $class = $provider->make('SharedAliasedInterface');
        $class2 = $provider->make('SharedAliasedInterface');
        $this->assertSame($class, $class2);
    }

    public function testNotSharedByAliasedInterfaceName() {
        $provider = new Auryn\Provider();
        $provider->alias('SharedAliasedInterface', 'SharedClass');
        $provider->alias('SharedAliasedInterface', 'NotSharedClass');
        $provider->share('SharedClass');
        $class = $provider->make('SharedAliasedInterface');
        $class2 = $provider->make('SharedAliasedInterface');

        $this->assertNotSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameReversedOrder() {
        $provider = new Auryn\Provider();
        $provider->share('SharedAliasedInterface');
        $provider->alias('SharedAliasedInterface', 'SharedClass');
        $class = $provider->make('SharedAliasedInterface');
        $class2 = $provider->make('SharedAliasedInterface');
        $this->assertSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameWithParameter() {
        $provider = new Auryn\Provider();
        $provider->alias('SharedAliasedInterface', 'SharedClass');
        $provider->share('SharedAliasedInterface');
        $sharedClass = $provider->make('SharedAliasedInterface');
        $childClass = $provider->make('ClassWithAliasAsParameter');
        $this->assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testSharedByAliasedInstance() {
        $provider = new Auryn\Provider();
        $provider->alias('SharedAliasedInterface', 'SharedClass');
        $sharedClass = $provider->make('SharedAliasedInterface');
        $provider->share($sharedClass);
        $childClass = $provider->make('ClassWithAliasAsParameter');
        $this->assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testMultipleShareCallsDontOverrideTheOriginalSharedInstance() {
        $provider = new Auryn\Provider();
        $provider->share('StdClass');
        $stdClass1 = $provider->make('StdClass');
        $provider->share('StdClass');
        $stdClass2 = $provider->make('StdClass');
        $this->assertSame($stdClass1, $stdClass2);
    }

    /**
     * @dataProvider provideInaccessibleExecutables
     */
    public function testGetExecutableMakesMethodsAccessible($toInvoke, $expectedResult) {
        $provider = new Auryn\Provider();
        $executable = $provider->buildExecutable($toInvoke, $setAccessible = TRUE);
        $this->assertSame($expectedResult, $executable());
    }

    public function testDependencyWhereSharedWithProtectedConstructor() {
        $provider = new Auryn\Provider();

        $inner = TestDependencyWithProtectedConstructor::create();
        $provider->share($inner);

        $outer = $provider->make('TestNeedsDepWithProtCons');

        $this->assertSame($inner, $outer->dep);
    }

    public function testDependencyWhereShared() {
        $provider = new Auryn\Provider();
        $provider->share('ClassInnerB');
        $innerDep = $provider->make('ClassInnerB');
        $inner = $provider->make('ClassInnerA');
        $this->assertSame($innerDep, $inner->dep);
        $outer = $provider->make('ClassOuter');
        $this->assertSame($innerDep, $outer->dep->dep);
    }

    public function provideInaccessibleExecutables() {
        $return = array();

        // 0 -------------------------------------------------------------------------------------->

        $toInvoke = array('InaccessibleExecutableClassMethod', 'doSomethingPrivate');
        $expectedResult = 42;
        $return[] = array($toInvoke, $expectedResult);

        // 1 -------------------------------------------------------------------------------------->

        $toInvoke = 'InaccessibleExecutableClassMethod::doSomethingPrivate';
        $expectedResult = 42;
        $return[] = array($toInvoke, $expectedResult);

        // 2 -------------------------------------------------------------------------------------->

        $toInvoke = 'InaccessibleStaticExecutableClassMethod::doSomethingPrivate';
        $expectedResult = 42;
        $return[] = array($toInvoke, $expectedResult);

        // 3 -------------------------------------------------------------------------------------->

        $toInvoke = array('InaccessibleExecutableClassMethod', 'doSomethingProtected');
        $expectedResult = 42;
        $return[] = array($toInvoke, $expectedResult);

        // 4 -------------------------------------------------------------------------------------->

        $toInvoke = 'InaccessibleExecutableClassMethod::doSomethingProtected';
        $expectedResult = 42;
        $return[] = array($toInvoke, $expectedResult);

        // 5 -------------------------------------------------------------------------------------->

        $toInvoke = 'InaccessibleStaticExecutableClassMethod::doSomethingProtected';
        $expectedResult = 42;
        $return[] = array($toInvoke, $expectedResult);

        // x -------------------------------------------------------------------------------------->

        return $return;
    }

    public function testUnshareRemovesClassFromObjectParameter() {
        $provider = new Auryn\Provider();
        $sharedObj = new \StdClass;
        $provider->share($sharedObj);

        $this->assertSame($sharedObj, $provider->make('StdClass'));
        $provider->unshare($sharedObj);

        $this->assertNotSame($sharedObj, $provider->make('StdClass'));
    }

    public function testBugWithReflectionPoolIncorrectlyReturningBadInfo() {
        $provider = new Provider;
        $obj = $provider->make('ClassOuter');
        $this->assertInstanceOf('ClassOuter', $obj);
        $this->assertInstanceOf('ClassInnerA', $obj->dep);
        $this->assertInstanceOf('ClassInnerB', $obj->dep->dep);
    }

    public function provideCyclicDependencies() {
        return array(
            'RecursiveClassA' => array('RecursiveClassA'),
            'RecursiveClassB' => array('RecursiveClassB'),
            'RecursiveClassC' => array('RecursiveClassC'),
            'RecursiveClass1' => array('RecursiveClass1'),
            'RecursiveClass2' => array('RecursiveClass2'),
            'DependsOnCyclic' => array('DependsOnCyclic'),
        );
    }

     /**
     * @dataProvider provideCyclicDependencies
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_CYCLIC_DEPENDENCY
     */
    public function testCyclicDependencies($class) {
        $provider = new Provider;
        $provider->make($class);
    }

    public function testNonConcreteDependencyWithDefaultValue() {
        $provider = new Provider;
        $class = $provider->make('NonConcreteDependencyWithDefaultValue');
        $this->assertInstanceOf('NonConcreteDependencyWithDefaultValue', $class);
        $this->assertNull($class->interface);
    }

    /**
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_ALIASED_CANNOT_SHARE
     */
    public function testShareAfterAliasException() {
        $provider = new Provider();
        $testClass = new StdClass();
        $provider->alias('StdClass', 'SomeOtherClass');
        $provider->share($testClass);
    }

    public function testShareAfterAliasAliasedClassAllowed() {
        $provider = new Provider();
        $testClass = new DepImplementation();
        $provider->alias('DepInterface', 'DepImplementation');
        $provider->share($testClass);
        $obj = $provider->make('DepInterface');
        $this->assertInstanceOf('DepImplementation', $obj);
    }

    public function testAliasAfterShareByStringAllowed() {
        $provider = new Provider();
        $provider->share('DepInterface');
        $provider->alias('DepInterface', 'DepImplementation');
        $obj = $provider->make('DepInterface');
        $obj2 = $provider->make('DepInterface');
        $this->assertInstanceOf('DepImplementation', $obj);
        $this->assertEquals($obj, $obj2);
    }

    public function testAliasAfterShareBySharingAliasAllowed() {
        $provider = new Provider();
        $provider->share('DepImplementation');
        $provider->alias('DepInterface', 'DepImplementation');
        $obj = $provider->make('DepInterface');
        $obj2 = $provider->make('DepInterface');
        $this->assertInstanceOf('DepImplementation', $obj);
        $this->assertEquals($obj, $obj2);
    }

    /**
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_SHARED_CANNOT_ALIAS
     */
    public function testAliasAfterShareException() {
        $provider = new Provider();
        $testClass = new StdClass();
        $provider->share($testClass);
        $provider->alias('StdClass', 'SomeOtherClass');
    }

    public function testTypelessDefineForDependency() {
        $thumbnailSize = 128;
        $provider = new Provider();
        $provider->defineParam('thumbnailSize', $thumbnailSize);
        $testClass = $provider->make('RequiresDependencyWithTypelessParameters');
        $this->assertEquals($thumbnailSize, $testClass->getThumbnailSize(), 'Typeless define was not injected correctly.');
    }

    public function testTypelessDefineForAliasedDependency() {
        $provider = new Provider();
        $provider->defineParam('val', 42);

        $provider->alias('TestNoExplicitDefine', 'ProviderTestCtorParamWithNoTypehintOrDefault');
        $obj = $provider->make('ProviderTestCtorParamWithNoTypehintOrDefaultDependent');
    }

    /**
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_NON_PUBLIC_CONSTRUCTOR
     */
    public function testAppropriateExceptionThrownOnNonPublicConstructor() {
        $provider = new Provider();
        $provider->make('HasNonPublicConstructor');
    }

    /**
     * @expectedException \Auryn\InjectionException
     * @expectedExceptionCode \Auryn\Provider::E_NON_PUBLIC_CONSTRUCTOR
     */
    public function testAppropriateExceptionThrownOnNonPublicConstructorWithArgs() {
        $provider = new Provider();
        $provider->make('HasNonPublicConstructorWithArgs');
    }

    /**
     * @expectedException \Auryn\BadArgumentException
     * @expectedExceptionCode \Auryn\Provider::E_CALLABLE
     */
    public function testNonExistentFunction() {
        $provider = new Provider();
        $provider->execute('nonExistentFunction');
    }

    /**
     * @expectedException \Auryn\BadArgumentException
     * @expectedExceptionCode \Auryn\Provider::E_CALLABLE
     */
    public function testNonExistentMethod() {
        $provider = new Provider();
        $object = new StdClass();
        $provider->execute(array($object, 'nonExistentFunction'));
    }

    /**
     * @expectedException \Auryn\BadArgumentException
     * @expectedExceptionCode \Auryn\Provider::E_CALLABLE
     */
    public function testClassWithoutInvoke() {
        $provider = new Provider();
        $object = new StdClass();
        $provider->execute($object);
    }

    public function testRefreshShare() {
        $provider = new Provider(new ReflectionPool);
        $provider->share('TestDependency');
        $object1 = $provider->make('TestDependency');
        $provider->refresh($object1);
        $object2 = $provider->make('TestDependency');

        $this->assertTrue(($object1 !== $object2), "Same instances, new object was not created.");
    }

    /**
     * @expectedException \Auryn\BadArgumentException
     * @expectedExceptionCode \Auryn\Provider::E_NON_EMPTY_STRING_ALIAS
     */
    public function testBadAlias() {
        $provider = new Provider();
        $provider->share('DepInterface');
        $provider->alias('DepInterface', '');
    }

    public function testShareNewAlias() {
        $provider = new Provider();
        $provider->share('DepImplementation');
        $provider->alias('DepInterface', 'DepImplementation');
    }

    public function testDefineWithBackslashAndMakeWithoutBackslash(){
        $provider = new Provider();
        $provider->define('\SimpleNoTypehintClass', array(':arg' => 'tested'));
        $testClass = $provider->make('SimpleNoTypehintClass');
        $this->assertEquals('tested', $testClass->testParam);
    }

    public function testShareWithBackslashAndMakeWithoutBackslash(){
        $provider = new Provider();
        $provider->share('\StdClass');
        $classA = $provider->make('StdClass');
        $classA->tested = false;
        $classB = $provider->make('\StdClass');
        $classB->tested = true;

        $this->assertEquals($classA->tested, $classB->tested);
    }

    public function testInstancePrepare() {
        $provider = new Provider();
        $provider->prepare('\StdClass', function($obj, Provider $injector) {
            $obj->testval = 42;
        });
        $obj = $provider->make('StdClass');

        $this->assertSame(42, $obj->testval);
    }

    public function testInterfacePrepare() {
        $provider = new Provider();
        $provider->prepare('SomeInterface', function($obj, Provider $injector) {
            $obj->testProp = 42;
        });
        $obj = $provider->make('PreparesImplementationTest');

        $this->assertSame(42, $obj->testProp);
    }
}
