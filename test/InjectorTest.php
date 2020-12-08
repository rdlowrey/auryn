<?php /** @noinspection PhpUnusedLocalVariableInspection */

namespace Auryn\Test;

use Auryn\ConfigException;
use Auryn\InjectionException;
use Auryn\Injector;
use Auryn\InjectorException;
use PHPUnit\Framework\TestCase;

class InjectorTest extends TestCase
{
    public function testMakeInstanceInjectsSimpleConcreteDependency()
    {
        $injector = new Injector;
        self::assertEquals(new TestNeedsDep(new TestDependency),
            $injector->make(TestNeedsDep::class)
        );
    }

    public function testMakeInstanceReturnsNewInstanceIfClassHasNoConstructor()
    {
        $injector = new Injector;
        self::assertEquals(new TestNoConstructor, $injector->make(TestNoConstructor::class));
    }

    public function testMakeInstanceReturnsAliasInstanceOnNonConcreteTypehint()
    {
        $injector = new Injector;
        $injector->alias(DepInterface::class, DepImplementation::class);
        self::assertEquals(new DepImplementation, $injector->make(DepInterface::class));
    }

    public function testMakeInstanceThrowsExceptionOnInterfaceWithoutAlias()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('Injection definition required for interface Auryn\Test\DepInterface');
        $this->expectExceptionCode(Injector::E_NEEDS_DEFINITION);
        $injector = new Injector;
        $injector->make(DepInterface::class);
    }

    public function testMakeInstanceThrowsExceptionOnNonConcreteCtorParamWithoutImplementation()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('Injection definition required for interface Auryn\Test\DepInterface');
        $this->expectExceptionCode(Injector::E_NEEDS_DEFINITION);
        $injector = new Injector;
        $injector->make(RequiresInterface::class);
    }

    public function testMakeInstanceBuildsNonConcreteCtorParamWithAlias()
    {
        $injector = new Injector;
        $injector->alias(DepInterface::class, DepImplementation::class);
        $obj = $injector->make(RequiresInterface::class);
        self::assertInstanceOf(RequiresInterface::class, $obj);
    }

    public function testMakeInstancePassesNullCtorParameterIfNoTypehintOrDefaultCanBeDetermined()
    {
        $injector = new Injector;
        $nullCtorParamObj = $injector->make(ProvTestNoDefinitionNullDefaultClass::class);
        self::assertEquals(new ProvTestNoDefinitionNullDefaultClass, $nullCtorParamObj);
        self::assertNull($nullCtorParamObj->arg);
    }

    public function testMakeInstanceReturnsSharedInstanceIfAvailable()
    {
        $injector = new Injector;
        $injector->define(RequiresInterface::class, array('dep' => DepImplementation::class));
        $injector->share(RequiresInterface::class);
        $injected = $injector->make(RequiresInterface::class);

        self::assertEquals('something', $injected->testDep->testProp);
        $injected->testDep->testProp = 'something else';

        $injected2 = $injector->make(RequiresInterface::class);
        self::assertEquals('something else', $injected2->testDep->testProp);
    }

    public function testMakeInstanceThrowsExceptionOnClassLoadFailure()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessageMatches('/Could not make ClassThatDoesntExist.*does not exist/');
        $injector = new Injector;
        $injector->make('ClassThatDoesntExist');
    }

    public function testMakeInstanceUsesCustomDefinitionIfSpecified()
    {
        $injector = new Injector;
        $injector->define(TestNeedsDep::class, array('testDep'=> TestDependency::class));
        $injected = $injector->make(TestNeedsDep::class, array('testDep'=> TestDependency2::class));
        self::assertEquals('testVal2', $injected->testDep->testProp);
    }

    public function testMakeInstanceCustomDefinitionOverridesExistingDefinitions()
    {
        $injector = new Injector;
        $injector->define(InjectorTestChildClass::class, array(':arg1'=>'First argument', ':arg2'=>'Second argument'));
        $injected = $injector->make(InjectorTestChildClass::class, array(':arg1'=>'Override'));
        self::assertEquals('Override', $injected->arg1);
        self::assertEquals('Second argument', $injected->arg2);
    }

    public function testMakeInstanceStoresShareIfMarkedWithNullInstance()
    {
        $this->expectNotToPerformAssertions();
        $injector = new Injector;
        $injector->share(TestDependency::class);
        $injector->make(TestDependency::class);
    }

    public function testMakeInstanceUsesReflectionForUnknownParamsInMultiBuildWithDeps()
    {
        $injector = new Injector;
        $obj = $injector->make(TestMultiDepsWithCtor::class, array('val1'=> TestDependency::class));
        self::assertInstanceOf(TestMultiDepsWithCtor::class, $obj);

        $obj = $injector->make(
            NoTypehintNoDefaultConstructorClass::class,
            array('val1'=> TestDependency::class)
        );
        self::assertInstanceOf(NoTypehintNoDefaultConstructorClass::class, $obj);
        self::assertNull($obj->testParam);
    }

    /**
     * @requires PHP 5.6
     */
    public function testMakeInstanceUsesReflectionForUnknownParamsInMultiBuildWithDepsAndVariadics()
    {
        if (defined('HHVM_VERSION')) {
            self::markTestSkipped("HHVM doesn't support variadics with type declarations.");
        }

        require_once __DIR__ . "/fixtures_5_6.php";

        $injector = new Injector;
        $obj = $injector->make(
            NoTypehintNoDefaultConstructorVariadicClass::class,
            array('val1'=> TestDependency::class)
        );
        self::assertInstanceOf(NoTypehintNoDefaultConstructorVariadicClass::class, $obj);
        self::assertEquals(array(), $obj->testParam);
    }

    /**
     * @requires PHP 5.6
     */
    public function testMakeInstanceUsesReflectionForUnknownParamsWithDepsAndVariadicsWithTypeHint()
    {
        if (defined('HHVM_VERSION')) {
            self::markTestSkipped("HHVM doesn't support variadics with type declarations.");
        }

        require_once __DIR__ . "/fixtures_5_6.php";

        $injector = new Injector;
        $obj = $injector->make(
            TypehintNoDefaultConstructorVariadicClass::class,
            array('arg'=> TestDependency::class)
        );
        self::assertInstanceOf(TypehintNoDefaultConstructorVariadicClass::class, $obj);
        self::assertIsArray($obj->testParam);
        self::assertInstanceOf(TestDependency::class, $obj->testParam[0]);
    }

    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefault()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('No definition available to provision typeless parameter $val at position 0 in Auryn\Test\InjectorTestCtorParamWithNoTypehintOrDefault::__construct() declared in Auryn\Test\InjectorTestCtorParamWithNoTypehintOrDefault::');
        $this->expectExceptionCode(Injector::E_UNDEFINED_PARAM);
        $injector = new Injector;
        $injector->make(InjectorTestCtorParamWithNoTypehintOrDefault::class);
    }

    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithoutDefinitionOrDefaultThroughAliasedTypehint()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('No definition available to provision typeless parameter $val at position 0 in Auryn\Test\InjectorTestCtorParamWithNoTypehintOrDefault::__construct() declared in Auryn\Test\InjectorTestCtorParamWithNoTypehintOrDefault::');
        $this->expectExceptionCode(Injector::E_UNDEFINED_PARAM);
        $injector = new Injector;
        $injector->alias(TestNoExplicitDefine::class,
                         InjectorTestCtorParamWithNoTypehintOrDefault::class
        );
        $injector->make(InjectorTestCtorParamWithNoTypehintOrDefaultDependent::class);
    }

    public function testMakeInstanceThrowsExceptionOnUninstantiableTypehintWithoutDefinition()
    {
        $this->expectException(InjectorException::class);
        $this->expectExceptionMessage('Injection definition required for interface Auryn\Test\DepInterface');
        $injector = new Injector;
        $injector->make(RequiresInterface::class);
    }

    public function testTypelessDefineForDependency()
    {
        $thumbnailSize = 128;
        $injector = new Injector;
        $injector->defineParam('thumbnailSize', $thumbnailSize);
        $testClass = $injector->make(RequiresDependencyWithTypelessParameters::class);
        self::assertEquals($thumbnailSize, $testClass->getThumbnailSize(), 'Typeless define was not injected correctly.');
    }

    public function testTypelessDefineForAliasedDependency()
    {
        $this->expectNotToPerformAssertions();
        $injector = new Injector;
        $injector->defineParam('val', 42);

        $injector->alias(
            TestNoExplicitDefine::class,
            ProviderTestCtorParamWithNoTypehintOrDefault::class
        );
        $injector->make(ProviderTestCtorParamWithNoTypehintOrDefaultDependent::class);
    }

    public function testMakeInstanceInjectsRawParametersDirectly()
    {
        $injector = new Injector;
        $injector->define(
            InjectorTestRawCtorParams::class, array(
            ':string' => 'string',
            ':obj' => new \StdClass,
            ':int' => 42,
            ':array' => array(),
            ':float' => 9.3,
            ':bool' => true,
            ':null' => null,
        ));

        $obj = $injector->make(InjectorTestRawCtorParams::class);
        self::assertIsString($obj->string);
        self::assertInstanceOf('StdClass', $obj->obj);
        self::assertIsInt($obj->int);
        self::assertIsArray($obj->array);
        self::assertIsFloat($obj->float);
        self::assertIsBool($obj->bool);
        self::assertNull($obj->null);
    }

    public function testMakeInstanceThrowsExceptionWhenDelegateDoes()
    {
        $this->expectException(\Exception::class);
        $injector= new Injector;

        $callable = $this->createMock(CallableMock::class);

        $injector->delegate('TestDependency', $callable);

        $callable->expects(self::once())
            ->method('__invoke')
            ->will(self::throwException(new \Exception()));

        $injector->make('TestDependency');
    }

    public function testMakeInstanceHandlesNamespacedClasses()
    {
        $this->expectNotToPerformAssertions();
        $injector = new Injector;
        $injector->make(SomeClassName::class);
    }

    public function testMakeInstanceDelegate()
    {
        $injector= new Injector;

        $callable = $this->createMock(CallableMock::class);
        $callable->expects(self::once())
            ->method('__invoke')
            ->willReturn(new TestDependency());

        $injector->delegate(TestDependency::class, $callable);

        $obj = $injector->make(TestDependency::class);

        self::assertInstanceOf(TestDependency::class, $obj);
    }

    public function testMakeInstanceWithStringDelegate()
    {
        $injector= new Injector;
        $injector->delegate('StdClass', StringStdClassDelegateMock::class);
        $obj = $injector->make('StdClass');
        self::assertEquals(42, $obj->test);
    }

    public function testMakeInstanceThrowsExceptionIfStringDelegateClassHasNoInvokeMethod()
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage("Auryn\Injector::delegate expects a valid callable or executable class::method string at Argument 2 but received 'StringDelegateWithNoInvokeMethod'");
        $injector= new Injector;
        $injector->delegate('StdClass', 'StringDelegateWithNoInvokeMethod');
    }

    public function testMakeInstanceThrowsExceptionIfStringDelegateClassInstantiationFails()
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage("Auryn\Injector::delegate expects a valid callable or executable class::method string at Argument 2 but received 'SomeClassThatDefinitelyDoesNotExistForReal'");
        $injector= new Injector;
        $injector->delegate('StdClass', 'SomeClassThatDefinitelyDoesNotExistForReal');
    }

    public function testMakeInstanceThrowsExceptionOnUntypehintedParameterWithNoDefinition()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('Injection definition required for interface Auryn\Test\DepInterface');
        $injector = new Injector;
        $injector->make(RequiresInterface::class);
    }

    public function testDefineAssignsPassedDefinition()
    {
        $injector = new Injector;
        $definition = array('dep' => DepImplementation::class);
        $injector->define(RequiresInterface::class, $definition);
        self::assertInstanceOf(RequiresInterface::class, $injector->make(RequiresInterface::class));
    }

    public function testShareStoresSharedInstanceAndReturnsCurrentInstance()
    {
        $injector = new Injector;
        $testShare = new \StdClass;
        $testShare->test = 42;

        self::assertInstanceOf(Injector::class, $injector->share($testShare));
        $testShare->test = 'test';
        self::assertEquals('test', $injector->make('stdclass')->test);
    }

    public function testShareMarksClassSharedOnNullObjectParameter()
    {
        $injector = new Injector;
        self::assertInstanceOf(Injector::class, $injector->share('SomeClass'));
    }

    public function testShareThrowsExceptionOnInvalidArgument()
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage('Auryn\Injector::share() requires a string class name or object instance at Argument 1; integer specified');
        $injector = new Injector;
        $injector->share(42);
    }

    public function testAliasAssignsValueAndReturnsCurrentInstance()
    {
        $injector = new Injector;
        self::assertInstanceOf(
            Injector::class, $injector->alias('DepInterface',
                                              DepImplementation::class
        ));
    }

    public function provideInvalidDelegates()
    {
        return array(
            array(new \StdClass),
            array(42),
            array(true)
        );
    }

    /**
     * @dataProvider provideInvalidDelegates
     */
    public function testDelegateThrowsExceptionIfDelegateIsNotCallableOrString($badDelegate)
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage('Auryn\Injector::delegate expects a valid callable or executable class::method string at Argument 2');
        $injector = new Injector;
        $injector->delegate(TestDependency::class, $badDelegate);
    }

    public function testDelegateInstantiatesCallableClassString()
    {
        $injector = new Injector;
        $injector->delegate(MadeByDelegate::class, CallableDelegateClassTest::class);
        self::assertInstanceof(MadeByDelegate::class, $injector->make(MadeByDelegate::class));
    }

    public function testDelegateInstantiatesCallableClassArray()
    {
        $injector = new Injector;
        $injector->delegate(MadeByDelegate::class, array(CallableDelegateClassTest::class, '__invoke'));
        self::assertInstanceof(MadeByDelegate::class, $injector->make(MadeByDelegate::class));
    }

    public function testUnknownDelegationFunction()
    {
        $injector = new Injector;
        try {
            $injector->delegate(DelegatableInterface::class, 'FunctionWhichDoesNotExist');
            self::fail("Delegation was supposed to fail.");
        } catch (InjectorException $ie) {
            self::assertStringContainsString('FunctionWhichDoesNotExist', $ie->getMessage());
            self::assertEquals(Injector::E_DELEGATE_ARGUMENT, $ie->getCode());
        }
    }

    public function testUnknownDelegationMethod()
    {
        $injector = new Injector;
        try {
            $injector->delegate(DelegatableInterface::class, array('stdClass', 'methodWhichDoesNotExist'));
            self::fail("Delegation was supposed to fail.");
        } catch (InjectorException $ie) {
            self::assertStringContainsString('stdClass', $ie->getMessage());
            self::assertStringContainsString('methodWhichDoesNotExist', $ie->getMessage());
            self::assertEquals(Injector::E_DELEGATE_ARGUMENT, $ie->getCode());
        }
    }

    /**
     * @dataProvider provideExecutionExpectations
     */
    public function testProvisionedInvokables($toInvoke, $definition, $expectedResult)
    {
        $injector = new Injector;
        self::assertEquals($expectedResult, $injector->execute($toInvoke, $definition));
    }

    public function provideExecutionExpectations()
    {
        $return = array();

        // 0 -------------------------------------------------------------------------------------->

        $toInvoke = array(ExecuteClassNoDeps::class, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 1 -------------------------------------------------------------------------------------->

        $toInvoke = array(new ExecuteClassNoDeps, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 2 -------------------------------------------------------------------------------------->

        $toInvoke = array(ExecuteClassDeps::class, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 3 -------------------------------------------------------------------------------------->

        $toInvoke = array(new ExecuteClassDeps(new TestDependency), 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 4 -------------------------------------------------------------------------------------->

        $toInvoke = array(ExecuteClassDepsWithMethodDeps::class, 'execute');
        $args = array(':arg' => 9382);
        $expectedResult = 9382;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 5 -------------------------------------------------------------------------------------->

        $toInvoke = array(ExecuteClassStaticMethod::class, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 6 -------------------------------------------------------------------------------------->

        $toInvoke = array(new ExecuteClassStaticMethod, 'execute');
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 7 -------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\ExecuteClassStaticMethod::execute';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 8 -------------------------------------------------------------------------------------->

        $toInvoke = array(ExecuteClassRelativeStaticMethod::class, 'parent::execute');
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

        $toInvoke = new ExecuteClassInvokable;
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 12 ------------------------------------------------------------------------------------->

        $toInvoke = ExecuteClassInvokable::class;
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

        // 17 ------------------------------------------------------------------------------------->

        $toInvoke = 'Auryn\Test\testExecuteFunctionWithArg';
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);

        // 18 ------------------------------------------------------------------------------------->

        $toInvoke = function () {
            return 42;
        };
        $args = array();
        $expectedResult = 42;
        $return[] = array($toInvoke, $args, $expectedResult);


        if (PHP_VERSION_ID > 50400) {
            // 19 ------------------------------------------------------------------------------------->

            $object = new ReturnsCallable('new value');
            $args = array();
            $toInvoke = $object->getCallable();
            $expectedResult = 'new value';
            $return[] = array($toInvoke, $args, $expectedResult);
        }
        // x -------------------------------------------------------------------------------------->

        return $return;
    }

    public function testStaticStringInvokableWithArgument()
    {
        $injector = new Injector;
        $invokable = $injector->buildExecutable('Auryn\Test\ClassWithStaticMethodThatTakesArg::doSomething');
        self::assertEquals(42, $invokable(41));
    }

    public function testInterfaceFactoryDelegation()
    {
        $this->expectNotToPerformAssertions();
        $injector = new Injector;
        $injector->delegate(DelegatableInterface::class, ImplementsInterfaceFactory::class);
        $requiresDelegatedInterface = $injector->make(RequiresDelegatedInterface::class);
        $requiresDelegatedInterface->foo();
    }

    public function testMissingAlias()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessageMatches('/.*TypoInTypehint"? does not exist$/');
        $injector = new Injector;
        $testClass = $injector->make(TestMissingDependency::class);
    }

    public function testAliasingConcreteClasses()
    {
        $injector = new Injector;
        $injector->alias(ConcreteClass1::class, ConcreteClass2::class);
        $obj = $injector->make(ConcreteClass1::class);
        self::assertInstanceOf(ConcreteClass2::class, $obj);
    }

    public function testSharedByAliasedInterfaceName()
    {
        $injector = new Injector;
        $injector->alias(SharedAliasedInterface::class, SharedClass::class);
        $injector->share(SharedAliasedInterface::class);
        $class = $injector->make(SharedAliasedInterface::class);
        $class2 = $injector->make(SharedAliasedInterface::class);
        self::assertSame($class, $class2);
    }

    public function testNotSharedByAliasedInterfaceName()
    {
        $injector = new Injector;
        $injector->alias(SharedAliasedInterface::class, SharedClass::class);
        $injector->alias(SharedAliasedInterface::class, NotSharedClass::class);
        $injector->share(SharedClass::class);
        $class = $injector->make(SharedAliasedInterface::class);
        $class2 = $injector->make(SharedAliasedInterface::class);

        self::assertNotSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameReversedOrder()
    {
        $injector = new Injector;
        $injector->share(SharedAliasedInterface::class);
        $injector->alias(SharedAliasedInterface::class, SharedClass::class);
        $class = $injector->make(SharedAliasedInterface::class);
        $class2 = $injector->make(SharedAliasedInterface::class);
        self::assertSame($class, $class2);
    }

    public function testSharedByAliasedInterfaceNameWithParameter()
    {
        $injector = new Injector;
        $injector->alias(SharedAliasedInterface::class, SharedClass::class);
        $injector->share(SharedAliasedInterface::class);
        $sharedClass = $injector->make(SharedAliasedInterface::class);
        $childClass = $injector->make(ClassWithAliasAsParameter::class);
        self::assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testSharedByAliasedInstance()
    {
        $injector = new Injector;
        $injector->alias(SharedAliasedInterface::class, SharedClass::class);
        $sharedClass = $injector->make(SharedAliasedInterface::class);
        $injector->share($sharedClass);
        $childClass = $injector->make(ClassWithAliasAsParameter::class);
        self::assertSame($sharedClass, $childClass->sharedClass);
    }

    public function testMultipleShareCallsDontOverrideTheOriginalSharedInstance()
    {
        $injector = new Injector;
        $injector->share('StdClass');
        $stdClass1 = $injector->make('StdClass');
        $injector->share('StdClass');
        $stdClass2 = $injector->make('StdClass');
        self::assertSame($stdClass1, $stdClass2);
    }

    public function testDependencyWhereSharedWithProtectedConstructor()
    {
        $injector = new Injector;

        $inner = TestDependencyWithProtectedConstructor::create();
        $injector->share($inner);

        $outer = $injector->make(TestNeedsDepWithProtCons::class);

        self::assertSame($inner, $outer->dep);
    }

    public function testDependencyWhereShared()
    {
        $injector = new Injector;
        $injector->share(ClassInnerB::class);
        $innerDep = $injector->make(ClassInnerB::class);
        $inner = $injector->make(ClassInnerA::class);
        self::assertSame($innerDep, $inner->dep);
        $outer = $injector->make(ClassOuter::class);
        self::assertSame($innerDep, $outer->dep->dep);
    }

    public function testBugWithReflectionPoolIncorrectlyReturningBadInfo()
    {
        $injector = new Injector;
        $obj = $injector->make(ClassOuter::class);
        self::assertInstanceOf(ClassOuter::class, $obj);
        self::assertInstanceOf(ClassInnerA::class, $obj->dep);
        self::assertInstanceOf(ClassInnerB::class, $obj->dep->dep);
    }

    public function provideCyclicDependencies()
    {
        return array(
            RecursiveClassA::class => array(RecursiveClassA::class),
            RecursiveClassB::class => array(RecursiveClassB::class),
            RecursiveClassC::class => array(RecursiveClassC::class),
            RecursiveClass1::class => array(RecursiveClass1::class),
            RecursiveClass2::class => array(RecursiveClass2::class),
            DependsOnCyclic::class => array(DependsOnCyclic::class),
        );
    }

     /**
     * @dataProvider provideCyclicDependencies
     */
    public function testCyclicDependencies($class)
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionCode(Injector::E_CYCLIC_DEPENDENCY);
        $injector = new Injector;
        $injector->make($class);
    }

    public function testNonConcreteDependencyWithDefault()
    {
        $injector = new Injector;
        $class = $injector->make(NonConcreteDependencyWithDefaultValue::class);
        self::assertInstanceOf(NonConcreteDependencyWithDefaultValue::class, $class);
        self::assertNull($class->interface);
    }

    public function testNonConcreteDependencyWithDefaultValueThroughAlias()
    {
        $injector = new Injector;
        $injector->alias(
            DelegatableInterface::class,
            ImplementsInterface::class
        );
        $class = $injector->make(NonConcreteDependencyWithDefaultValue::class);
        self::assertInstanceOf(NonConcreteDependencyWithDefaultValue::class, $class);
        self::assertInstanceOf(ImplementsInterface::class, $class->interface);
    }

    public function testNonConcreteDependencyWithDefaultValueThroughDelegation()
    {
        $injector = new Injector;
        $injector->delegate(DelegatableInterface::class, ImplementsInterfaceFactory::class);
        $class = $injector->make(NonConcreteDependencyWithDefaultValue::class);
        self::assertInstanceOf(NonConcreteDependencyWithDefaultValue::class, $class);
        self::assertInstanceOf(ImplementsInterface::class, $class->interface);
    }

    public function testDependencyWithDefaultValueThroughShare()
    {
        $injector = new Injector;
        //Instance is not shared, null default is used for dependency
        $instance = $injector->make(ConcreteDependencyWithDefaultValue::class);
        self::assertNull($instance->dependency);

        //Instance is explicitly shared, $instance is used for dependency
        $instance = new \StdClass();
        $injector->share($instance);
        $instance = $injector->make(ConcreteDependencyWithDefaultValue::class);
        self::assertInstanceOf('StdClass', $instance->dependency);
    }

    public function testShareAfterAliasException()
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionCode(Injector::E_ALIASED_CANNOT_SHARE);
        $this->expectExceptionMessage('Cannot share class stdclass because it is currently aliased to Auryn\Test\SomeOtherClass');
        $injector = new Injector();
        $testClass = new \StdClass();
        $injector->alias('StdClass', 'Auryn\Test\SomeOtherClass');
        $injector->share($testClass);
    }

    public function testShareAfterAliasAliasedClassAllowed()
    {
        $injector = new Injector();
        $testClass = new DepImplementation();
        $injector->alias(DepInterface::class, DepImplementation::class);
        $injector->share($testClass);
        $obj = $injector->make(DepInterface::class);
        self::assertInstanceOf(DepImplementation::class, $obj);
    }

    public function testAliasAfterShareByStringAllowed()
    {
        $injector = new Injector();
        $injector->share(DepInterface::class);
        $injector->alias(DepInterface::class, DepImplementation::class);
        $obj = $injector->make(DepInterface::class);
        $obj2 = $injector->make(DepInterface::class);
        self::assertInstanceOf(DepImplementation::class, $obj);
        self::assertEquals($obj, $obj2);
    }

    public function testAliasAfterShareBySharingAliasAllowed()
    {
        $injector = new Injector();
        $injector->share(DepImplementation::class);
        $injector->alias(DepInterface::class, DepImplementation::class);
        $obj = $injector->make(DepInterface::class);
        $obj2 = $injector->make(DepInterface::class);
        self::assertInstanceOf(DepImplementation::class, $obj);
        self::assertEquals($obj, $obj2);
    }

    public function testAliasAfterShareException()
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage('Cannot alias class stdclass to Auryn\Test\SomeOtherClass because it is currently shared');
        $this->expectExceptionCode(Injector::E_SHARED_CANNOT_ALIAS);
        $injector = new Injector();
        $testClass = new \StdClass();
        $injector->share($testClass);
        $injector->alias('StdClass', 'Auryn\Test\SomeOtherClass');
    }

    public function testAppropriateExceptionThrownOnNonPublicConstructor()
    {
        $this->expectExceptionCode(Injector::E_NON_PUBLIC_CONSTRUCTOR);
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('Cannot instantiate protected/private constructor in class Auryn\Test\HasNonPublicConstructor');
        $injector = new Injector();
        $injector->make(HasNonPublicConstructor::class);
    }

    public function testAppropriateExceptionThrownOnNonPublicConstructorWithArgs()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('Cannot instantiate protected/private constructor in class Auryn\Test\HasNonPublicConstructorWithArgs');
        $this->expectExceptionCode(Injector::E_NON_PUBLIC_CONSTRUCTOR);
        $injector = new Injector();
        $injector->make(HasNonPublicConstructorWithArgs::class);
    }

    public function testMakeExecutableFailsOnNonExistentFunction()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionCode(Injector::E_INVOKABLE);
        $this->expectExceptionMessage('nonExistentFunction');
        $injector = new Injector();
        $injector->buildExecutable('nonExistentFunction');
    }

    public function testMakeExecutableFailsOnNonExistentInstanceMethod()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionCode(Injector::E_INVOKABLE);
        $this->expectExceptionMessage("[object(stdClass), 'nonExistentMethod']");
        $injector = new Injector();
        $object = new \StdClass();
        $injector->buildExecutable(array($object, 'nonExistentMethod'));
    }

    public function testMakeExecutableFailsOnNonExistentStaticMethod()
    {
        $injector = new Injector();
        $this->expectException(InjectionException::class);
        $this->expectExceptionCode(Injector::E_INVOKABLE);
        $this->expectExceptionMessage("StdClass::nonExistentMethod");
        $injector->buildExecutable(array('StdClass', 'nonExistentMethod'));
    }

    public function testMakeExecutableFailsOnClassWithoutInvoke()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('Invalid invokable: callable or provisional string required');
        $this->expectExceptionCode(Injector::E_INVOKABLE);
        $injector = new Injector();
        $object = new \StdClass();
        $injector->buildExecutable($object);
    }

    public function testBadAlias()
    {
        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage('Invalid alias: non-empty string required at arguments 1 and 2');
        $this->expectExceptionCode(Injector::E_NON_EMPTY_STRING_ALIAS);
        $injector = new Injector();
        $injector->share(DepInterface::class);
        $injector->alias(DepInterface::class, '');
    }

    public function testShareNewAlias()
    {
        $this->expectNotToPerformAssertions();
        $injector = new Injector();
        $injector->share(DepImplementation::class);
        $injector->alias(DepInterface::class, DepImplementation::class);
    }

    public function testDefineWithBackslashAndMakeWithoutBackslash()
    {
        $injector = new Injector();
        $injector->define(SimpleNoTypehintClass::class, array(':arg' => 'tested'));
        $testClass = $injector->make(SimpleNoTypehintClass::class);
        self::assertEquals('tested', $testClass->testParam);
    }

    public function testShareWithBackslashAndMakeWithoutBackslash()
    {
        $injector = new Injector();
        $injector->share('\StdClass');
        $classA = $injector->make('StdClass');
        $classA->tested = false;
        $classB = $injector->make('\StdClass');
        $classB->tested = true;

        self::assertEquals($classA->tested, $classB->tested);
    }

    public function testInstanceMutate()
    {
        $injector = new Injector();
        $injector->prepare('\StdClass', function ($obj, $injector) {
            $obj->testval = 42;
        });
        $obj = $injector->make('StdClass');

        self::assertSame(42, $obj->testval);
    }

    public function testInterfaceMutate()
    {
        $injector = new Injector();
        $injector->prepare(
            SomeInterface::class, function ($obj, $injector) {
            $obj->testProp = 42;
        });
        $obj = $injector->make(PreparesImplementationTest::class);

        self::assertSame(42, $obj->testProp);
    }



    /**
     * Test that custom definitions are not passed through to dependencies.
     * Surprising things would happen if this did occur.
     */
    public function testCustomDefinitionNotPassedThrough()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('No definition available to provision typeless parameter $foo at position 0 in Auryn\Test\DependencyWithDefinedParam::__construct() declared in Auryn\Test\DependencyWithDefinedParam::');
        $this->expectExceptionCode(Injector::E_UNDEFINED_PARAM);

        $injector = new Injector();
        $injector->share(DependencyWithDefinedParam::class);
        $injector->make(RequiresDependencyWithDefinedParam::class, array(':foo' => 5));
    }

    public function testDelegationFunction()
    {
        $injector = new Injector();
        $injector->delegate(TestDelegationSimple::class, 'Auryn\Test\createTestDelegationSimple');
        $obj = $injector->make(TestDelegationSimple::class);
        self::assertInstanceOf(TestDelegationSimple::class, $obj);
        self::assertTrue($obj->delegateCalled);
    }

    public function testDelegationDependency()
    {
        $injector = new Injector();
        $injector->delegate(
            TestDelegationDependency::class,
            'Auryn\Test\createTestDelegationDependency'
        );
        $obj = $injector->make(TestDelegationDependency::class);
        self::assertInstanceOf(TestDelegationDependency::class, $obj);
        self::assertTrue($obj->delegateCalled);
    }

    public function testExecutableAliasing()
    {
        $injector = new Injector();
        $injector->alias(BaseExecutableClass::class, ExtendsExecutableClass::class);
        $result = $injector->execute(array(BaseExecutableClass::class, 'foo'));
        self::assertEquals('This is the ExtendsExecutableClass', $result);
    }

    public function testExecutableAliasingStatic()
    {
        $injector = new Injector();
        $injector->alias(BaseExecutableClass::class, ExtendsExecutableClass::class);
        $result = $injector->execute(array(BaseExecutableClass::class, 'bar'));
        self::assertEquals('This is the ExtendsExecutableClass', $result);
    }

    /**
     * Test coverage for delegate closures that are defined outside
     * of a class.ph
     */
    public function testDelegateClosure()
    {
        $this->expectNotToPerformAssertions();
        $delegateClosure = getDelegateClosureInGlobalScope();
        $injector = new Injector();
        $injector->delegate(DelegateClosureInGlobalScope::class, $delegateClosure);
        $injector->make(DelegateClosureInGlobalScope::class);
    }

    public function testCloningWithServiceLocator()
    {
        $this->expectNotToPerformAssertions();
        $injector = new Injector();
        $injector->share($injector);
        $instance = $injector->make(CloneTest::class);
        $newInjector = $instance->injector;
        $newInstance = $newInjector->make(CloneTest::class);
    }

    public function testAbstractExecute()
    {
        $injector = new Injector();

        $fn = function () {
            return new ConcreteExexcuteTest();
        };

        $injector->delegate(AbstractExecuteTest::class, $fn);
        $result = $injector->execute(array(AbstractExecuteTest::class, 'process'));

        self::assertEquals('Concrete', $result);
    }

    public function testDebugMake()
    {
        $injector = new Injector();
        try {
            $injector->make(DependencyChainTest::class);
        } catch (InjectionException $ie) {
            $chain = $ie->getDependencyChain();
            self::assertCount(2, $chain);

            self::assertEquals('auryn\test\dependencychaintest', $chain[0]);
            self::assertEquals('auryn\test\depinterface', $chain[1]);
        }
    }

    public function testInspectShares()
    {
        $injector = new Injector();
        $injector->share(SomeClassName::class);

        $inspection = $injector->inspect(SomeClassName::class, Injector::I_SHARES);
        self::assertArrayHasKey('auryn\test\someclassname', $inspection[Injector::I_SHARES]);
    }

    public function testInspectAll()
    {
        $injector = new Injector();

        // Injector::I_BINDINGS
        $injector->define(DependencyWithDefinedParam::class, array(':arg' => 42));

        // Injector::I_DELEGATES
        $injector->delegate(MadeByDelegate::class, CallableDelegateClassTest::class);

        // Injector::I_PREPARES
        $injector->prepare(MadeByDelegate::class, function ($c) {});

        // Injector::I_ALIASES
        $injector->alias('i', Injector::class);

        // Injector::I_SHARES
        $injector->share(Injector::class);

        $all = $injector->inspect();
        $some = $injector->inspect(MadeByDelegate::class);

        self::assertCount(5, array_filter($all));
        self::assertCount(2, array_filter($some));
    }

    public function testDelegationDoesntMakeObject()
    {
        /** @TODO update code to check for non-object */
        if (PHP_VERSION_ID >= 80000) {
            $this->expectException(\TypeError::class);
        } else {
            $this->expectException(InjectionException::class);
            $this->expectExceptionMessage("Making auryn\\test\someclassname did not result in an object, instead result is of type 'NULL'");
            $this->expectExceptionCode(Injector::E_MAKING_FAILED);
        }

        $delegate = function () {
            return null;
        };
        $injector = new Injector();
        $injector->delegate(SomeClassName::class, $delegate);
        $injector->make(SomeClassName::class);
    }

    public function testDelegationDoesntMakeObjectMakesString()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage("Making auryn\\test\someclassname did not result in an object, instead result is of type 'string'");
        $this->expectExceptionCode(Injector::E_MAKING_FAILED);
        $delegate = function () {
            return 'ThisIsNotAClass';
        };
        $injector = new Injector();
        $injector->delegate(SomeClassName::class, $delegate);
        $injector->make(SomeClassName::class);
    }

    public function testPrepareInvalidCallable()
    {
        $injector = new Injector;
        $invalidCallable = 'This_does_not_exist';
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage($invalidCallable);
        $injector->prepare("StdClass", $invalidCallable);
    }

    public function testPrepareCallableReplacesObjectWithReturnValueOfSameInterfaceType()
    {
        $injector = new Injector;
        $expected = new SomeImplementation; // <-- implements SomeInterface
        $injector->prepare(
            SomeInterface::class, function ($impl) use ($expected) {
            return $expected;
        });
        $actual = $injector->make(SomeImplementation::class);
        self::assertSame($expected, $actual);
    }

    public function testPrepareCallableReplacesObjectWithReturnValueOfSameClassType()
    {
        $injector = new Injector;
        $expected = new SomeImplementation; // <-- implements SomeInterface
        $injector->prepare(
            SomeImplementation::class, function ($impl) use ($expected) {
            return $expected;
        });
        $actual = $injector->make(SomeImplementation::class);
        self::assertSame($expected, $actual);
    }

    public function testChildWithoutConstructorWorks() {

        $injector = new Injector;
        try {
            $injector->define(ParentWithConstructor::class, array(':foo' => 'parent'));
            $injector->define(ChildWithoutConstructor::class, array(':foo' => 'child'));

            $injector->share(ParentWithConstructor::class);
            $injector->share(ChildWithoutConstructor::class);

            $child = $injector->make(ChildWithoutConstructor::class);
            self::assertEquals('child', $child->foo);

            $parent = $injector->make(ParentWithConstructor::class);
            self::assertEquals('parent', $parent->foo);
        }
        catch (InjectionException $ie) {
            echo $ie->getMessage();
            self::fail("Auryn failed to locate the ");
        }
    }

    public function testChildWithoutConstructorMissingParam()
    {
        $this->expectException(InjectionException::class);
        $this->expectExceptionMessage('No definition available to provision typeless parameter $foo at position 0 in Auryn\Test\ChildWithoutConstructor::__construct() declared in Auryn\Test\ParentWithConstructor');
        $this->expectExceptionCode(Injector::E_UNDEFINED_PARAM);

        $injector = new Injector;
        $injector->define(ParentWithConstructor::class, array(':foo' => 'parent'));
        $injector->make(ChildWithoutConstructor::class);
    }

    public function testInstanceClosureDelegates()
    {
        $injector = new Injector;
        $injector->delegate(
            DelegatingInstanceA::class, function (DelegateA $d) {
            return new DelegatingInstanceA($d);
        });
        $injector->delegate(
            DelegatingInstanceB::class, function (DelegateB $d) {
            return new DelegatingInstanceB($d);
        });

        $a = $injector->make(DelegatingInstanceA::class);
        $b = $injector->make(DelegatingInstanceB::class);

        self::assertInstanceOf(DelegateA::class, $a->a);
        self::assertInstanceOf(DelegateB::class, $b->b);
    }

    public function testThatExceptionInConstructorDoesntCauseCyclicDependencyException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Exception in constructor');

        $injector = new Injector;
        $injector->make(ThrowsExceptionInConstructor::class);
    }
}
