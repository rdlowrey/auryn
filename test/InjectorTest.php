<?php

namespace Auryn\Test;

use Auryn\Injector;

class InjectorTest extends \PHPUnit_Framework_TestCase {

    public function testMakeInstanceInjectsSimpleConcreteDependency() {
        $injector = new Injector;
        $this->assertEquals(new \TestNeedsDep(new \TestDependency),
            $injector->makeInstance('TestNeedsDep')
        );
    }

    public function testMakeInstanceReturnsNewInstanceIfClassHasNoConstructor() {
        $injector = new Injector;
        $this->assertEquals(new \TestNoConstructor, $injector->makeInstance('TestNoConstructor'));
    }

    public function testMakeInstanceReturnsAliasInstanceOnNonConcreteTypehint() {
        $injector = new Injector;
        $injector->alias('DepInterface', 'DepImplementation');
        $this->assertEquals(new \DepImplementation, $injector->makeInstance('DepInterface'));
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NEEDS_DEFINITION
     */
    public function testMakeInstanceThrowsExceptionOnInterfaceWithoutAlias() {
        $injector = new Injector;
        $injector->makeInstance('DepInterface');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NEEDS_DEFINITION
     */
    public function testMakeInstanceThrowsExceptionOnNonConcreteCtorParamWithoutImplementation() {
        $injector = new Injector;
        $injector->makeInstance('RequiresInterface');
    }

    public function testMakeInstanceBuildsNonConcreteCtorParamWithAlias() {
        $injector = new Injector;
        $injector->alias('DepInterface', 'DepImplementation');
        $obj = $injector->makeInstance('RequiresInterface');
        $this->assertInstanceOf('RequiresInterface', $obj);
    }

    public function testMakeInstancePassesNullCtorParameterIfNoTypehintOrDefaultCanBeDetermined() {
        $injector = new Injector;
        $nullCtorParamObj = $injector->makeInstance('ProvTestNoDefinitionNullDefaultClass');
        $this->assertEquals(new \ProvTestNoDefinitionNullDefaultClass, $nullCtorParamObj);
        $this->assertEquals(NULL, $nullCtorParamObj->arg);
    }

    public function testMakeInstanceReturnsSharedInstanceIfAvailable() {
        $injector = new Injector;
        $injector->bind('RequiresInterface', array(':dep' => 'DepImplementation'));
        $injector->share('RequiresInterface');
        $injected = $injector->makeInstance('RequiresInterface');

        $this->assertEquals('something', $injected->testDep->testProp);
        $injected->testDep->testProp = 'something else';

        $injected2 = $injector->makeInstance('RequiresInterface');
        $this->assertEquals('something else', $injected2->testDep->testProp);
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionOnClassLoadFailure() {
        $injector = new Injector;
        $injector->makeInstance('ClassThatDoesntExist');
    }

    public function testMakeInstanceUsesCustomDefinitionIfSpecified() {
        $injector = new Injector;
        $injector->bind('TestNeedsDep', array(':testDep'=>'TestDependency'));
        $injected = $injector->makeInstance('TestNeedsDep', array(':testDep'=>'TestDependency2'));
        $this->assertEquals('testVal2', $injected->testDep->testProp);
    }

    public function testMakeInstanceCustomDefinitionOverridesExistingDefinitions() {
        $injector = new Injector;
        $injector->bind('InjectorTestChildClass', array('arg1'=>'First argument', 'arg2'=>'Second argument'));
        $injected = $injector->makeInstance('InjectorTestChildClass', array('arg1'=>'Override'));
        $this->assertEquals('Override', $injected->arg1);
        $this->assertEquals('Second argument', $injected->arg2);
    }

    public function testMakeInstanceStoresShareIfMarkedWithNullInstance() {
        $injector = new Injector;
        $injector->share('TestDependency');
        $injector->makeInstance('TestDependency');
    }

    public function testMakeInstanceUsesReflectionForUnknownParamsInMultiBuildWithDeps() {
        $injector = new Injector;
        $obj = $injector->makeInstance('TestMultiDepsWithCtor', array(':val1'=>'TestDependency'));
        $this->assertInstanceOf('TestMultiDepsWithCtor', $obj);

        $obj = $injector->makeInstance('NoTypehintNoDefaultConstructorClass',
            array(':val1'=>'TestDependency')
        );
        $this->assertInstanceOf('NoTypehintNoDefaultConstructorClass', $obj);
        $this->assertEquals(NULL, $obj->testParam);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_UNDEFINED_PARAM
     */
    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefault() {
        $injector = new Injector;
        $obj = $injector->makeInstance('InjectorTestCtorParamWithNoTypehintOrDefault');
        $this->assertNull($obj->val);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_UNDEFINED_PARAM
     */
    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefaultThroughAliasedTypehint() {
        $injector = new Injector;
        $injector->alias('TestNoExplicitDefine', 'InjectorTestCtorParamWithNoTypehintOrDefault');
        $injector->makeInstance('InjectorTestCtorParamWithNoTypehintOrDefaultDependent');
    }

    /**
     * @TODO
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionOnUninstantiableTypehintWithoutDefinition() {
        $injector = new Injector;
        $obj = $injector->makeInstance('RequiresInterface');
    }

    public function testMakeInstanceInjectsRawParametersDirectly() {
        $injector = new Injector;
        $injector->bind('InjectorTestRawCtorParams', array(
            'string' => 'string',
            'obj' => new \StdClass,
            'int' => 42,
            'array' => array(),
            'float' => 9.3,
            'bool' => true,
            'null' => null,
        ));

        $obj = $injector->makeInstance('InjectorTestRawCtorParams');
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
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionWhenDelegateDoes() {
        $injector= new Injector;

        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );

        $injector->delegate('TestDependency', $callable);

        $callable->expects($this->once())
            ->method('__invoke')
            ->will($this->throwException(new \Auryn\InjectorException()));

        $injector->makeInstance('TestDependency');
    }

    public function testMakeInstanceHandlesNamespacedClasses() {
        $injector = new Injector;
        $injector->makeInstance('SomeNamespace\\SomeClassName');
    }

    public function testMakeInstanceDelegate() {
        $injector= new Injector;

        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );
        $callable->expects($this->once())
            ->method('__invoke')
            ->will($this->returnValue(new \TestDependency()));

        $injector->delegate('TestDependency', $callable);

        $obj = $injector->makeInstance('TestDependency');

        $this->assertInstanceOf('TestDependency', $obj);
    }

    public function testMakeInstanceWithStringDelegate() {
        $injector= new Injector;
        $injector->delegate('StdClass', 'StringStdClassDelegateMock');
        $obj = $injector->makeInstance('StdClass');
        $this->assertEquals(42, $obj->test);
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionIfStringDelegateClassHasNoInvokeMethod() {
        $injector= new Injector;
        $injector->delegate('StdClass', 'StringDelegateWithNoInvokeMethod');
        $obj = $injector->makeInstance('StdClass');
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionIfStringDelegateClassInstantiationFails() {
        $injector= new Injector;
        $injector->delegate('StdClass', 'SomeClassThatDefinitelyDoesNotExistForReal');
        $obj = $injector->makeInstance('StdClass');
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithNoDefinition() {

        $injector = new Injector;
        $obj = $injector->makeInstance('RequiresInterface');
    }

    public function testDefineAssignsPassedDefinition() {
        $injector = new Injector;
        $definition = array(':dep' => 'DepImplementation');
        $injector->bind('RequiresInterface', $definition);
        $this->assertInstanceOf('RequiresInterface', $injector->makeInstance('RequiresInterface'));
    }

    public function testShareStoresSharedInstanceAndReturnsCurrentInstance() {
        $injector = new Injector;
        $testShare = new \StdClass;
        $testShare->test = 42;

        $this->assertInstanceOf('Auryn\Injector', $injector->share($testShare));
        $testShare->test = 'test';
        $this->assertEquals('test', $injector->makeInstance('stdclass')->test);
    }

    public function testShareMarksClassSharedOnNullObjectParameter() {
        $injector = new Injector;
        $this->assertInstanceOf('Auryn\Injector', $injector->share('SomeClass'));
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testShareThrowsExceptionOnInvalidArgument() {
        $injector = new Injector;
        $injector->share(42);
    }

    public function testAliasAssignsValueAndReturnsCurrentInstance() {
        $injector = new Injector;
        $this->assertInstanceOf('Auryn\Injector', $injector->alias('DepInterface', 'DepImplementation'));
    }

    public function provideInvalidDelegates() {
        return array(
            array(new \StdClass),
            array(42),
            array(true)
        );
    }

    /**
     * @dataProvider provideInvalidDelegates
     * @expectedException Auryn\InjectorException
     */
    public function testDelegateThrowsExceptionIfDelegateIsNotCallableOrString($badDelegate) {
        $injector = new Injector;
        $injector->delegate('TestDependency', $badDelegate);
    }

    public function testDelegateInstantiatesCallableClassString() {
        $injector = new Injector;
        $injector->delegate('MadeByDelegate', 'CallableDelegateClassTest');
        $this->assertInstanceof('MadeByDelegate', $injector->makeInstance('MadeByDelegate'));
    }

    public function testDelegateInstantiatesCallableClassArray() {
        $injector = new Injector;
        $injector->delegate('MadeByDelegate', array('CallableDelegateClassTest', '__invoke'));
        $this->assertInstanceof('MadeByDelegate', $injector->makeInstance('MadeByDelegate'));
    }

    /**
     * @dataProvider provideExecutionExpectations
     */
    public function testProvisionedInvokables($toInvoke, $definition, $expectedResult) {
        $injector = new Injector;
        $invokable = $injector->makeInvokable($toInvoke);
        $args = $injector->makeArguments($invokable, $definition);
        $this->assertEquals($expectedResult, call_user_func_array($invokable, $args));
    }

    public function provideExecutionExpectations() {
        $return = array();

        // 0 -------------------------------------------------------------------------------------->

        $toInvoke = array('ExecuteClassNoDeps', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 1 -------------------------------------------------------------------------------------->

        $toInvoke = array(new \ExecuteClassNoDeps, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 2 -------------------------------------------------------------------------------------->

        $toInvoke = array('ExecuteClassDeps', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 3 -------------------------------------------------------------------------------------->

        $toInvoke = array(new \ExecuteClassDeps(new \TestDependency), 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 4 -------------------------------------------------------------------------------------->

        $toInvoke = array('ExecuteClassDepsWithMethodDeps', 'execute');
        $args = array('arg' => 9382);
        $expectedResult = 9382;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 5 -------------------------------------------------------------------------------------->

        $toInvoke = array('ExecuteClassStaticMethod', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 6 -------------------------------------------------------------------------------------->

        $toInvoke = array(new \ExecuteClassStaticMethod, 'execute');
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

        $toInvoke = new \ExecuteClassInvokable;
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

    public function testStaticStringInvokableWithArgument() {
        $injector = new \Auryn\Injector;
        $invokable = $injector->makeInvokable('ClassWithStaticMethodThatTakesArg::doSomething');
        $this->assertEquals(42, $invokable(41));

    }

    public function testInterfaceFactoryDelegation() {
        $injector = new Injector;
        $injector->delegate('DelegatableInterface', 'ImplementsInterfaceFactory');
        $requiresDelegatedInterface = $injector->makeInstance('RequiresDelegatedInterface');
        $requiresDelegatedInterface->foo();
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMissingAlias() {
        $injector = new Injector;
        $testClass = $injector->makeInstance('TestMissingDependency');
    }

    public function testAliasingConcreteClasses(){
        $injector = new Injector;
        $injector->alias('ConcreteClass1', 'ConcreteClass2');
        $obj = $injector->makeInstance('ConcreteClass1');
        $this->assertInstanceOf('ConcreteClass2', $obj);
    }

    public function testSharedByAliasedInterfaceName() {
        $injector = new Injector;
        $injector->alias('SharedAliasedInterface', 'SharedClass');
        $injector->share('SharedAliasedInterface');
        $class = $injector->makeInstance('SharedAliasedInterface');
        $class2 = $injector->makeInstance('SharedAliasedInterface');
        $this->assertSame($class, $class2);
    }

    public function testNotSharedByAliasedInterfaceName() {
        $injector = new Injector;
        $injector->alias('SharedAliasedInterface', 'SharedClass');
        $injector->alias('SharedAliasedInterface', 'NotSharedClass');
        $injector->share('SharedClass');
        $class = $injector->makeInstance('SharedAliasedInterface');
        $class2 = $injector->makeInstance('SharedAliasedInterface');

        $this->assertNotSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameReversedOrder() {
        $injector = new Injector;
        $injector->share('SharedAliasedInterface');
        $injector->alias('SharedAliasedInterface', 'SharedClass');
        $class = $injector->makeInstance('SharedAliasedInterface');
        $class2 = $injector->makeInstance('SharedAliasedInterface');
        $this->assertSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameWithParameter() {
        $injector = new Injector;
        $injector->alias('SharedAliasedInterface', 'SharedClass');
        $injector->share('SharedAliasedInterface');
        $sharedClass = $injector->makeInstance('SharedAliasedInterface');
        $childClass = $injector->makeInstance('ClassWithAliasAsParameter');
        $this->assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testSharedByAliasedInstance() {
        $injector = new Injector;
        $injector->alias('SharedAliasedInterface', 'SharedClass');
        $sharedClass = $injector->makeInstance('SharedAliasedInterface');
        $injector->share($sharedClass);
        $childClass = $injector->makeInstance('ClassWithAliasAsParameter');
        $this->assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testMultipleShareCallsDontOverrideTheOriginalSharedInstance() {
        $injector = new Injector;
        $injector->share('StdClass');
        $stdClass1 = $injector->makeInstance('StdClass');
        $injector->share('StdClass');
        $stdClass2 = $injector->makeInstance('StdClass');
        $this->assertSame($stdClass1, $stdClass2);
    }

    public function testDependencyWhereSharedWithProtectedConstructor() {
        $injector = new Injector;

        $inner = \TestDependencyWithProtectedConstructor::create();
        $injector->share($inner);

        $outer = $injector->makeInstance('TestNeedsDepWithProtCons');

        $this->assertSame($inner, $outer->dep);
    }

    public function testDependencyWhereShared() {
        $injector = new Injector;
        $injector->share('ClassInnerB');
        $innerDep = $injector->makeInstance('ClassInnerB');
        $inner = $injector->makeInstance('ClassInnerA');
        $this->assertSame($innerDep, $inner->dep);
        $outer = $injector->makeInstance('ClassOuter');
        $this->assertSame($innerDep, $outer->dep->dep);
    }

    public function testBugWithReflectionPoolIncorrectlyReturningBadInfo() {
        $injector = new Injector;
        $obj = $injector->makeInstance('ClassOuter');
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
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_CYCLIC_DEPENDENCY
     */
    public function testCyclicDependencies($class) {
        //$this->markTestSkipped('Cyclic dependency check not yet implemented');
        $injector = new Injector;
        $injector->makeInstance($class);
    }

    public function testNonConcreteDependencyWithDefaultValue() {
        $injector = new Injector;
        $class = $injector->makeInstance('NonConcreteDependencyWithDefaultValue');
        $this->assertInstanceOf('NonConcreteDependencyWithDefaultValue', $class);
        $this->assertNull($class->interface);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_ALIASED_CANNOT_SHARE
     */
    public function testShareAfterAliasException() {
        $injector = new Injector();
        $testClass = new \StdClass();
        $injector->alias('StdClass', 'SomeOtherClass');
        $injector->share($testClass);
    }

    public function testShareAfterAliasAliasedClassAllowed() {
        $injector = new Injector();
        $testClass = new \DepImplementation();
        $injector->alias('DepInterface', 'DepImplementation');
        $injector->share($testClass);
        $obj = $injector->makeInstance('DepInterface');
        $this->assertInstanceOf('DepImplementation', $obj);
    }

    public function testAliasAfterShareByStringAllowed() {
        $injector = new Injector();
        $injector->share('DepInterface');
        $injector->alias('DepInterface', 'DepImplementation');
        $obj = $injector->makeInstance('DepInterface');
        $obj2 = $injector->makeInstance('DepInterface');
        $this->assertInstanceOf('DepImplementation', $obj);
        $this->assertEquals($obj, $obj2);
    }

    public function testAliasAfterShareBySharingAliasAllowed() {
        $injector = new Injector();
        $injector->share('DepImplementation');
        $injector->alias('DepInterface', 'DepImplementation');
        $obj = $injector->makeInstance('DepInterface');
        $obj2 = $injector->makeInstance('DepInterface');
        $this->assertInstanceOf('DepImplementation', $obj);
        $this->assertEquals($obj, $obj2);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_SHARED_CANNOT_ALIAS
     */
    public function testAliasAfterShareException() {
        $injector = new Injector();
        $testClass = new \StdClass();
        $injector->share($testClass);
        $injector->alias('StdClass', 'SomeOtherClass');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NON_PUBLIC_CONSTRUCTOR
     */
    public function testAppropriateExceptionThrownOnNonPublicConstructor() {
        $injector = new Injector();
        $injector->makeInstance('HasNonPublicConstructor');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NON_PUBLIC_CONSTRUCTOR
     */
    public function testAppropriateExceptionThrownOnNonPublicConstructorWithArgs() {
        $injector = new Injector();
        $injector->makeInstance('HasNonPublicConstructorWithArgs');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_INVOKABLE
     */
    public function testMakeExecutableFailsOnNonExistentFunction() {
        $injector = new Injector();
        $injector->makeInvokable('nonExistentFunction');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_INVOKABLE
     */
    public function testMakeExecutableFailsOnNonExistentMethod() {
        $injector = new Injector();
        $object = new \StdClass();
        $injector->makeInvokable(array($object, 'nonExistentFunction'));
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_INVOKABLE
     */
    public function testMakeExecutableFailsOnClassWithoutInvoke() {
        $injector = new Injector();
        $object = new \StdClass();
        $injector->makeInvokable($object);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NON_EMPTY_STRING_ALIAS
     */
    public function testBadAlias() {
        $injector = new Injector();
        $injector->share('DepInterface');
        $injector->alias('DepInterface', '');
    }

    public function testShareNewAlias() {
        $injector = new Injector();
        $injector->share('DepImplementation');
        $injector->alias('DepInterface', 'DepImplementation');
    }

    public function testDefineWithBackslashAndMakeWithoutBackslash(){
        $injector = new Injector();
        $injector->bind('\SimpleNoTypehintClass', array('arg' => 'tested'));
        $testClass = $injector->makeInstance('SimpleNoTypehintClass');
        $this->assertEquals('tested', $testClass->testParam);
    }

    public function testShareWithBackslashAndMakeWithoutBackslash(){
        $injector = new Injector();
        $injector->share('\StdClass');
        $classA = $injector->makeInstance('StdClass');
        $classA->tested = false;
        $classB = $injector->makeInstance('\StdClass');
        $classB->tested = true;

        $this->assertEquals($classA->tested, $classB->tested);
    }

    public function testInstanceMutate() {
        $injector = new Injector();
        $injector->mutate('\StdClass', function($obj, $injector) {
            $obj->testval = 42;
        });
        $obj = $injector->makeInstance('StdClass');

        $this->assertSame(42, $obj->testval);
    }

    public function testInterfaceMutate() {
        $injector = new Injector();
        $injector->mutate('SomeInterface', function($obj, $injector) {
            $obj->testProp = 42;
        });
        $obj = $injector->makeInstance('PreparesImplementationTest');

        $this->assertSame(42, $obj->testProp);
    }



    /**
     * Test that custom definitions are not passed through to dependencies.
     * Surprising things would happen if this did occur.
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_UNDEFINED_PARAM
     */
    public function testCustomDefinitionNotPassedThrough() {
        $injector = new Injector();
        $injector->share('DependencyWithDefinedParam');
        $injector->makeInstance('RequiresDependencyWithDefinedParam', [':foo' => 5]);
    }
}
