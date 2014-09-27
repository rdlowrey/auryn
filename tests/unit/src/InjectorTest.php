<?php

namespace Auryn\Test;

use Auryn\Injector;

class InjectorTest extends \PHPUnit_Framework_TestCase
{
    private $injector;

    public function setUp()
    {
        $this->injector = new Injector();
    }

    public function testMakeInstanceInjectsSimpleConcreteDependency()
    {
        $this->assertEquals(new TestNeedsDep(new TestDependency()),
            $this->injector->make('Auryn\Test\TestNeedsDep')
        );
    }

    public function testMakeInstanceReturnsNewInstanceIfClassHasNoConstructor()
    {
        $this->assertEquals(new TestNoConstructor(), $this->injector->make('Auryn\Test\TestNoConstructor'));
    }

    public function testMakeInstanceReturnsAliasInstanceOnNonConcreteTypehint()
    {
        $this->injector->alias('Auryn\Test\DepInterface', 'Auryn\Test\DepImplementation');
        $this->assertEquals(new DepImplementation(), $this->injector->make('Auryn\Test\DepInterface'));
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NEEDS_DEFINITION
     */
    public function testMakeInstanceThrowsExceptionOnInterfaceWithoutAlias()
    {
        $this->injector->make('Auryn\Test\DepInterface');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NEEDS_DEFINITION
     */
    public function testMakeInstanceThrowsExceptionOnNonConcreteCtorParamWithoutImplementation()
    {
        $this->injector->make('Auryn\Test\RequiresInterface');
    }

    public function testMakeInstanceBuildsNonConcreteCtorParamWithAlias()
    {
        $this->injector->alias('Auryn\Test\DepInterface', 'Auryn\Test\DepImplementation');
        $obj = $this->injector->make('Auryn\Test\RequiresInterface');
        $this->assertInstanceOf('Auryn\Test\RequiresInterface', $obj);
    }

    public function testMakeInstancePassesNullCtorParameterIfNoTypehintOrDefaultCanBeDetermined()
    {
        $nullCtorParamObj = $this->injector->make('Auryn\Test\ProvTestNoDefinitionNullDefaultClass');
        $this->assertEquals(new ProvTestNoDefinitionNullDefaultClass(), $nullCtorParamObj);
        $this->assertEquals(null, $nullCtorParamObj->arg);
    }

    public function testMakeInstanceReturnsSharedInstanceIfAvailable()
    {
        $this->injector->bind('Auryn\Test\RequiresInterface', array(':dep' => 'Auryn\Test\DepImplementation'));
        $this->injector->share('Auryn\Test\RequiresInterface');
        $injected = $this->injector->make('Auryn\Test\RequiresInterface');

        $this->assertEquals('something', $injected->testDep->testProp);
        $injected->testDep->testProp = 'something else';

        $injected2 = $this->injector->make('Auryn\Test\RequiresInterface');
        $this->assertEquals('something else', $injected2->testDep->testProp);
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionOnClassLoadFailure()
    {
        $this->injector->make('ClassThatDoesntExist');
    }

    public function testMakeInstanceUsesCustomDefinitionIfSpecified()
    {
        $this->injector->bind('Auryn\Test\TestNeedsDep', array(':testDep' => 'Auryn\Test\TestDependency'));
        $injected = $this->injector->make('Auryn\Test\TestNeedsDep', array(':testDep' => 'Auryn\Test\TestDependency2'));
        $this->assertEquals('testVal2', $injected->testDep->testProp);
    }

    public function testMakeInstanceCustomDefinitionOverridesExistingDefinitions()
    {
        $this->injector->bind('Auryn\Test\InjectorTestChildClass', array('arg1' => 'First argument', 'arg2' => 'Second argument'));
        $injected = $this->injector->make('Auryn\Test\InjectorTestChildClass', array('arg1' => 'Override'));
        $this->assertEquals('Override', $injected->arg1);
        $this->assertEquals('Second argument', $injected->arg2);
    }

    public function testMakeInstanceStoresShareIfMarkedWithNullInstance()
    {
        $this->injector->share('Auryn\Test\TestDependency');
        $this->injector->make('Auryn\Test\TestDependency');
    }

    public function testMakeInstanceUsesReflectionForUnknownParamsInMultiBuildWithDeps()
    {
        $obj = $this->injector->make('Auryn\Test\TestMultiDepsWithCtor', array(':val1' => 'Auryn\Test\TestDependency'));
        $this->assertInstanceOf('Auryn\Test\TestMultiDepsWithCtor', $obj);

        $obj = $this->injector->make('Auryn\Test\NoTypehintNoDefaultConstructorClass',
            array(':val1' => 'Auryn\Test\TestDependency')
        );
        $this->assertInstanceOf('Auryn\Test\NoTypehintNoDefaultConstructorClass', $obj);
        $this->assertEquals(null, $obj->testParam);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_UNDEFINED_PARAM
     */
    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefault()
    {
        $obj = $this->injector->make('Auryn\Test\InjectorTestCtorParamWithNoTypehintOrDefault');
        $this->assertNull($obj->val);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_UNDEFINED_PARAM
     */
    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefaultThroughAliasedTypehint()
    {
        $this->injector->alias('Auryn\Test\TestNoExplicitDefine', 'Auryn\Test\InjectorTestCtorParamWithNoTypehintOrDefault');
        $this->injector->make('Auryn\Test\InjectorTestCtorParamWithNoTypehintOrDefaultDependent');
    }

    /**
     * @TODO
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionOnUninstantiableTypehintWithoutDefinition()
    {
        $obj = $this->injector->make('Auryn\Test\RequiresInterface');
    }

    public function testTypelessDefineForDependency()
    {
        $thumbnailSize = 128;
        $this->injector->bindParam('thumbnailSize', $thumbnailSize);
        $testClass = $this->injector->make('Auryn\Test\RequiresDependencyWithTypelessParameters');
        $this->assertEquals($thumbnailSize, $testClass->getThumbnailSize(), 'Typeless define was not injected correctly.');
    }

    public function testTypelessDefineForAliasedDependency()
    {
        $this->injector->bindParam('val', 42);
        $this->injector->alias('Auryn\Test\TestNoExplicitDefine', 'Auryn\Test\ProviderTestCtorParamWithNoTypehintOrDefault');
        $obj = $this->injector->make('Auryn\Test\ProviderTestCtorParamWithNoTypehintOrDefaultDependent');
    }

    public function testMakeInstanceInjectsRawParametersDirectly()
    {
        $this->injector->bind('Auryn\Test\InjectorTestRawCtorParams', array(
            'string' => 'string',
            'obj' => new \StdClass(),
            'int' => 42,
            'array' => array(),
            'float' => 9.3,
            'bool' => true,
            'null' => null,
        ));

        $obj = $this->injector->make('Auryn\Test\InjectorTestRawCtorParams');
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
    public function testMakeInstanceThrowsExceptionWhenDelegateDoes()
    {
        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );

        $this->injector->delegate('TestDependency', $callable);

        $callable->expects($this->once())
            ->method('__invoke')
            ->will($this->throwException(new \Auryn\InjectorException()));

        $this->injector->make('TestDependency');
    }

    public function testMakeInstanceHandlesNamespacedClasses()
    {
        $this->injector->make('Auryn\Test\SomeClassName');
    }

    public function testMakeInstanceDelegate()
    {
        $callable = $this->getMock(
            'CallableMock',
            array('__invoke')
        );
        $callable->expects($this->once())
            ->method('__invoke')
            ->will($this->returnValue(new TestDependency()));

        $this->injector->delegate('Auryn\Test\TestDependency', $callable);

        $obj = $this->injector->make('Auryn\Test\TestDependency');

        $this->assertInstanceOf('Auryn\Test\TestDependency', $obj);
    }

    public function testMakeInstanceWithStringDelegate()
    {
        $this->injector->delegate('StdClass', 'Auryn\Test\StringStdClassDelegateMock');
        $obj = $this->injector->make('StdClass');
        $this->assertEquals(42, $obj->test);
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionIfStringDelegateClassHasNoInvokeMethod()
    {
        $this->injector->delegate('StdClass', 'StringDelegateWithNoInvokeMethod');
        $obj = $this->injector->make('StdClass');
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionIfStringDelegateClassInstantiationFails()
    {
        $this->injector->delegate('StdClass', 'SomeClassThatDefinitelyDoesNotExistForReal');
        $obj = $this->injector->make('StdClass');
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithNoDefinition()
    {
        $obj = $this->injector->make('Auryn\Test\RequiresInterface');
    }

    public function testDefineAssignsPassedDefinition()
    {
        $definition = array(':dep' => 'Auryn\Test\DepImplementation');
        $this->injector->bind('Auryn\Test\RequiresInterface', $definition);
        $this->assertInstanceOf('Auryn\Test\RequiresInterface', $this->injector->make('Auryn\Test\RequiresInterface'));
    }

    public function testShareStoresSharedInstanceAndReturnsCurrentInstance()
    {
        $testShare = new \StdClass();
        $testShare->test = 42;

        $this->assertInstanceOf('Auryn\Injector', $this->injector->share($testShare));
        $testShare->test = 'test';
        $this->assertEquals('test', $this->injector->make('stdclass')->test);
    }

    public function testShareMarksClassSharedOnNullObjectParameter()
    {
        $this->assertInstanceOf('Auryn\Injector', $this->injector->share('SomeClass'));
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testShareThrowsExceptionOnInvalidArgument()
    {
        $this->injector->share(42);
    }

    public function testAliasAssignsValueAndReturnsCurrentInstance()
    {
        $this->assertInstanceOf('Auryn\Injector', $this->injector->alias('DepInterface', 'Auryn\Test\DepImplementation'));
    }

    public function provideInvalidDelegates()
    {
        return array(
            array(new \StdClass()),
            array(42),
            array(true),
        );
    }

    /**
     * @dataProvider provideInvalidDelegates
     * @expectedException Auryn\InjectorException
     */
    public function testDelegateThrowsExceptionIfDelegateIsNotCallableOrString($badDelegate)
    {
        $this->injector->delegate('Auryn\Test\TestDependency', $badDelegate);
    }

    public function testDelegateInstantiatesCallableClassString()
    {
        $this->injector->delegate('Auryn\Test\MadeByDelegate', 'Auryn\Test\CallableDelegateClassTest');
        $this->assertInstanceof('Auryn\Test\MadeByDelegate', $this->injector->make('Auryn\Test\MadeByDelegate'));
    }

    public function testDelegateInstantiatesCallableClassArray()
    {
        $this->injector->delegate('Auryn\Test\MadeByDelegate', array('Auryn\Test\CallableDelegateClassTest', '__invoke'));
        $this->assertInstanceof('Auryn\Test\MadeByDelegate', $this->injector->make('Auryn\Test\MadeByDelegate'));
    }

    /**
     * @dataProvider provideExecutionExpectations
     */
    public function testProvisionedInvokables($toInvoke, $definition, $expectedResult)
    {
        $invokable = $this->injector->makeInvokable($toInvoke);
        $args = $this->injector->makeArguments($invokable, $definition);
        $this->assertEquals($expectedResult, call_user_func_array($invokable, $args));
    }

    public function provideExecutionExpectations()
    {
        $return = array();

        // 0 -------------------------------------------------------------------------------------->

        $toInvoke = array('Auryn\Test\ExecuteClassNoDeps', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 1 -------------------------------------------------------------------------------------->

        $toInvoke = array(new ExecuteClassNoDeps(), 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 2 -------------------------------------------------------------------------------------->

        $toInvoke = array('Auryn\Test\ExecuteClassDeps', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 3 -------------------------------------------------------------------------------------->

        $toInvoke = array(new ExecuteClassDeps(new TestDependency()), 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 4 -------------------------------------------------------------------------------------->

        $toInvoke = array('Auryn\Test\ExecuteClassDepsWithMethodDeps', 'execute');
        $args = array('arg' => 9382);
        $expectedResult = 9382;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 5 -------------------------------------------------------------------------------------->

        $toInvoke = array('Auryn\Test\ExecuteClassStaticMethod', 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 6 -------------------------------------------------------------------------------------->

        $toInvoke = array(new ExecuteClassStaticMethod(), 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 7 -------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\ExecuteClassStaticMethod::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 8 -------------------------------------------------------------------------------------->

        $toInvoke = array('Auryn\Test\ExecuteClassRelativeStaticMethod', 'parent::execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 9 -------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\testExecuteFunction';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 10 ------------------------------------------------------------------------------------->

        $toInvoke = function () { return 42; };
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 11 ------------------------------------------------------------------------------------->

        $toInvoke = new ExecuteClassInvokable();
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 12 ------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\ExecuteClassInvokable';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 13 ------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\ExecuteClassNoDeps::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 14 ------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\ExecuteClassDeps::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 15 ------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\ExecuteClassStaticMethod::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 16 ------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\ExecuteClassRelativeStaticMethod::parent::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        $toInvoke = 'Auryn\Test\testExecuteFunctionWithArg';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // x -------------------------------------------------------------------------------------->

        return $return;
    }

    public function testStaticStringInvokableWithArgument()
    {
        $invokable = $this->injector->makeInvokable('Auryn\Test\ClassWithStaticMethodThatTakesArg::doSomething');
        $this->assertEquals(42, $invokable(41));
    }

    public function testInterfaceFactoryDelegation()
    {
        $this->injector->delegate('Auryn\Test\DelegatableInterface', 'Auryn\Test\ImplementsInterfaceFactory');
        $requiresDelegatedInterface = $this->injector->make('Auryn\Test\RequiresDelegatedInterface');
        $requiresDelegatedInterface->foo();
    }

    /**
     * @expectedException Auryn\InjectorException
     */
    public function testMissingAlias()
    {
        $testClass = $this->injector->make('Auryn\Test\TestMissingDependency');
    }

    public function testAliasingConcreteClasses()
    {
        $this->injector->alias('Auryn\Test\ConcreteClass1', 'Auryn\Test\ConcreteClass2');
        $obj = $this->injector->make('Auryn\Test\ConcreteClass1');
        $this->assertInstanceOf('Auryn\Test\ConcreteClass2', $obj);
    }

    public function testSharedByAliasedInterfaceName()
    {
        $this->injector->alias('Auryn\Test\SharedAliasedInterface', 'Auryn\Test\SharedClass');
        $this->injector->share('Auryn\Test\SharedAliasedInterface');
        $class = $this->injector->make('Auryn\Test\SharedAliasedInterface');
        $class2 = $this->injector->make('Auryn\Test\SharedAliasedInterface');
        $this->assertSame($class, $class2);
    }

    public function testNotSharedByAliasedInterfaceName()
    {
        $this->injector->alias('Auryn\Test\SharedAliasedInterface', 'Auryn\Test\SharedClass');
        $this->injector->alias('Auryn\Test\SharedAliasedInterface', 'Auryn\Test\NotSharedClass');
        $this->injector->share('Auryn\Test\SharedClass');
        $class = $this->injector->make('Auryn\Test\SharedAliasedInterface');
        $class2 = $this->injector->make('Auryn\Test\SharedAliasedInterface');

        $this->assertNotSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameReversedOrder()
    {
        $this->injector->share('Auryn\Test\SharedAliasedInterface');
        $this->injector->alias('Auryn\Test\SharedAliasedInterface', 'Auryn\Test\SharedClass');
        $class = $this->injector->make('Auryn\Test\SharedAliasedInterface');
        $class2 = $this->injector->make('Auryn\Test\SharedAliasedInterface');
        $this->assertSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameWithParameter()
    {
        $this->injector->alias('Auryn\Test\SharedAliasedInterface', 'Auryn\Test\SharedClass');
        $this->injector->share('Auryn\Test\SharedAliasedInterface');
        $sharedClass = $this->injector->make('Auryn\Test\SharedAliasedInterface');
        $childClass = $this->injector->make('Auryn\Test\ClassWithAliasAsParameter');
        $this->assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testSharedByAliasedInstance()
    {
        $this->injector->alias('Auryn\Test\SharedAliasedInterface', 'Auryn\Test\SharedClass');
        $sharedClass = $this->injector->make('Auryn\Test\SharedAliasedInterface');
        $this->injector->share($sharedClass);
        $childClass = $this->injector->make('Auryn\Test\ClassWithAliasAsParameter');
        $this->assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testMultipleShareCallsDontOverrideTheOriginalSharedInstance()
    {
        $this->injector->share('StdClass');
        $stdClass1 = $this->injector->make('StdClass');
        $this->injector->share('StdClass');
        $stdClass2 = $this->injector->make('StdClass');
        $this->assertSame($stdClass1, $stdClass2);
    }

    public function testDependencyWhereSharedWithProtectedConstructor()
    {
        $inner = TestDependencyWithProtectedConstructor::create();
        $this->injector->share($inner);

        $outer = $this->injector->make('Auryn\Test\TestNeedsDepWithProtCons');

        $this->assertSame($inner, $outer->dep);
    }

    public function testDependencyWhereShared()
    {
        $this->injector->share('Auryn\Test\ClassInnerB');
        $innerDep = $this->injector->make('Auryn\Test\ClassInnerB');
        $inner = $this->injector->make('Auryn\Test\ClassInnerA');
        $this->assertSame($innerDep, $inner->dep);
        $outer = $this->injector->make('Auryn\Test\ClassOuter');
        $this->assertSame($innerDep, $outer->dep->dep);
    }

    public function testBugWithReflectionPoolIncorrectlyReturningBadInfo()
    {
        $obj = $this->injector->make('Auryn\Test\ClassOuter');
        $this->assertInstanceOf('Auryn\Test\ClassOuter', $obj);
        $this->assertInstanceOf('Auryn\Test\ClassInnerA', $obj->dep);
        $this->assertInstanceOf('Auryn\Test\ClassInnerB', $obj->dep->dep);
    }

    public function provideCyclicDependencies()
    {
        return array(
            'Auryn\Test\RecursiveClassA' => array('Auryn\Test\RecursiveClassA'),
            'Auryn\Test\RecursiveClassB' => array('Auryn\Test\RecursiveClassB'),
            'Auryn\Test\RecursiveClassC' => array('Auryn\Test\RecursiveClassC'),
            'Auryn\Test\RecursiveClass1' => array('Auryn\Test\RecursiveClass1'),
            'Auryn\Test\RecursiveClass2' => array('Auryn\Test\RecursiveClass2'),
            'Auryn\Test\DependsOnCyclic' => array('Auryn\Test\DependsOnCyclic'),
        );
    }

     /**
     * @dataProvider provideCyclicDependencies
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_CYCLIC_DEPENDENCY
     */
    public function testCyclicDependencies($class)
    {
        $this->injector->make($class);
    }

    public function testNonConcreteDependencyWithDefaultValue()
    {
        $class = $this->injector->make('Auryn\Test\NonConcreteDependencyWithDefaultValue');
        $this->assertInstanceOf('Auryn\Test\NonConcreteDependencyWithDefaultValue', $class);
        $this->assertNull($class->interface);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_ALIASED_CANNOT_SHARE
     */
    public function testShareAfterAliasException()
    {
        $testClass = new \StdClass();
        $this->injector->alias('StdClass', 'Auryn\Test\SomeOtherClass');
        $this->injector->share($testClass);
    }

    public function testShareAfterAliasAliasedClassAllowed()
    {
        $testClass = new DepImplementation();
        $this->injector->alias('Auryn\Test\DepInterface', 'Auryn\Test\DepImplementation');
        $this->injector->share($testClass);
        $obj = $this->injector->make('Auryn\Test\DepInterface');
        $this->assertInstanceOf('Auryn\Test\DepImplementation', $obj);
    }

    public function testAliasAfterShareByStringAllowed()
    {
        $this->injector->share('Auryn\Test\DepInterface');
        $this->injector->alias('Auryn\Test\DepInterface', 'Auryn\Test\DepImplementation');
        $obj = $this->injector->make('Auryn\Test\DepInterface');
        $obj2 = $this->injector->make('Auryn\Test\DepInterface');
        $this->assertInstanceOf('Auryn\Test\DepImplementation', $obj);
        $this->assertEquals($obj, $obj2);
    }

    public function testAliasAfterShareBySharingAliasAllowed()
    {
        $this->injector->share('Auryn\Test\DepImplementation');
        $this->injector->alias('Auryn\Test\DepInterface', 'Auryn\Test\DepImplementation');
        $obj = $this->injector->make('Auryn\Test\DepInterface');
        $obj2 = $this->injector->make('Auryn\Test\DepInterface');
        $this->assertInstanceOf('Auryn\Test\DepImplementation', $obj);
        $this->assertEquals($obj, $obj2);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_SHARED_CANNOT_ALIAS
     */
    public function testAliasAfterShareException()
    {
        $testClass = new \StdClass();
        $this->injector->share($testClass);
        $this->injector->alias('StdClass', 'Auryn\Test\SomeOtherClass');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NON_PUBLIC_CONSTRUCTOR
     */
    public function testAppropriateExceptionThrownOnNonPublicConstructor()
    {
        $this->injector->make('Auryn\Test\HasNonPublicConstructor');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NON_PUBLIC_CONSTRUCTOR
     */
    public function testAppropriateExceptionThrownOnNonPublicConstructorWithArgs()
    {
        $this->injector->make('Auryn\Test\HasNonPublicConstructorWithArgs');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_INVOKABLE
     */
    public function testMakeExecutableFailsOnNonExistentFunction()
    {
        $this->injector->makeInvokable('nonExistentFunction');
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_INVOKABLE
     */
    public function testMakeExecutableFailsOnNonExistentMethod()
    {
        $object = new \StdClass();
        $this->injector->makeInvokable(array($object, 'nonExistentFunction'));
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_INVOKABLE
     */
    public function testMakeExecutableFailsOnClassWithoutInvoke()
    {
        $object = new \StdClass();
        $this->injector->makeInvokable($object);
    }

    /**
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_NON_EMPTY_STRING_ALIAS
     */
    public function testBadAlias()
    {
        $this->injector->share('Auryn\Test\DepInterface');
        $this->injector->alias('Auryn\Test\DepInterface', '');
    }

    public function testShareNewAlias()
    {
        $this->injector->share('Auryn\Test\DepImplementation');
        $this->injector->alias('Auryn\Test\DepInterface', 'Auryn\Test\DepImplementation');
    }

    public function testDefineWithBackslashAndMakeWithoutBackslash()
    {
        $this->injector->bind('Auryn\Test\SimpleNoTypehintClass', array('arg' => 'tested'));
        $testClass = $this->injector->make('Auryn\Test\SimpleNoTypehintClass');
        $this->assertEquals('tested', $testClass->testParam);
    }

    public function testShareWithBackslashAndMakeWithoutBackslash()
    {
        $this->injector->share('\StdClass');
        $classA = $this->injector->make('StdClass');
        $classA->tested = false;
        $classB = $this->injector->make('\StdClass');
        $classB->tested = true;

        $this->assertEquals($classA->tested, $classB->tested);
    }

    public function testInstanceMutate()
    {
        $injector = $this->injector;
        $injector->mutate('\StdClass', function ($obj, $injector) {
            $obj->testval = 42;
        });
        $obj = $injector->make('StdClass');

        $this->assertSame(42, $obj->testval);
    }

    public function testInterfaceMutate()
    {
        $injector = $this->injector;
        $injector->mutate('Auryn\Test\SomeInterface', function ($obj, $injector) {
            $obj->testProp = 42;
        });
        $obj = $injector->make('Auryn\Test\PreparesImplementationTest');

        $this->assertSame(42, $obj->testProp);
    }

    /**
     * Test that custom definitions are not passed through to dependencies.
     * Surprising things would happen if this did occur.
     * @expectedException \Auryn\InjectorException
     * @expectedExceptionCode \Auryn\Injector::E_UNDEFINED_PARAM
     */
    public function testCustomDefinitionNotPassedThrough()
    {
        $this->injector->share('Auryn\Test\DependencyWithDefinedParam');
        $this->injector->make('Auryn\Test\RequiresDependencyWithDefinedParam', [':foo' => 5]);
    }
}
