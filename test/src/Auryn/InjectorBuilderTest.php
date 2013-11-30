<?php

use \Auryn\InjectorBuilder;

class InjectorBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Auryn\InjectorBuilder
     */
    private $builder;

    protected function setUp() {
        $this->builder = new InjectorBuilder;
    }

    public function testFromArrayThrowsExceptionIfInvalidKeyFound() {
        $invalidKey = 'InvalidKey';
        $this->setExpectedException(
            'Auryn\\BuilderException',
            sprintf(InjectorBuilder::E_INVALID_CONFIG_OPTION, $invalidKey),
            InjectorBuilder::E_INVALID_CONFIG_OPTION
        );
        $this->builder->fromArray(array($invalidKey => 'value'), $this->getMock('\Auryn\Provider'));
    }

    public function testFromArrayWithAliasSpecifiedCallsAliasMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('alias'));
        $provider->expects($this->once())
            ->method('alias')
            ->with(
                $this->equalTo('SomeInterface'),
                $this->equalTo('SomeImplementationClass')
            );

        $this->builder->fromArray(array('aliases' => array(
            'SomeInterface' => 'SomeImplementationClass'
        )), $provider);
    }

    /**
     * @dataProvider provideBadAliases
     * @expectedException \Auryn\BuilderException
     * @expectedExeptionCode \Auryn\InjectorBuilder::E_INVALID_ALIAS
     */
    public function testFromArrayThrowsExceptionOnBadAlias($badAlias1, $badAlias2) {
        $configArray = array('aliases' => array($badAlias1, $badAlias2));
        $this->builder->fromArray($configArray);
    }

    public function provideBadAliases() {
        return array(
            array(TRUE, 'ValidAlias'),
            array('ValidClass', FALSE),
            array('', 'ValidAlias'),
            array('ValidAlias', ''),
            array('ValidAlias', new StdClass)
        );
    }

    public function testFromArrayWithDefinitionSpecifiedCallsDefineMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('define'));
        $provider->expects($this->once())
            ->method('define')
            ->with(
                $this->equalTo('SomeImplementationClass'),
                $this->equalTo(array(':arg1' => 'SomeString'))
            );

        $this->builder->fromArray(array('definitions' => array(
                'SomeImplementationClass' => array(
                    ':arg1' => 'SomeString'
                )
            )
        ), $provider);
    }

    /**
     * @expectedException \Auryn\BuilderException
     * @expectedExeptionCode \Auryn\InjectorBuilder::E_INVALID_DEFINE
     */
    public function testFromArrayThrowsExceptionOnBadDefinition() {
        $configArray = array('definitions' => array(
            'SomeImplementationClass' => array(
                'thisShouldHaveRawScalarPrefixButDoesnt' => new StdClass
        )));
        $this->builder->fromArray($configArray);
    }

    public function testFromArrayWithSharedDependencySpecifiedCallsShareMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('share'));
        $provider->expects($this->once())
            ->method('share')
            ->with($this->equalTo('MyUniversalClass'));

        $this->builder->fromArray(array(
            'shares' => array('MyUniversalClass')
        ), $provider);
    }

    /**
     * @dataProvider provideBadShares
     * @expectedException \Auryn\BuilderException
     * @expectedExeptionCode \Auryn\InjectorBuilder::E_INVALID_SHARE
     */
    public function testFromArrayThrowsExceptionOnBadShare($badShare) {
        $configArray = array('shares' => array($badShare));
        $this->builder->fromArray($configArray);
    }

    public function provideBadShares() {
        return array(
            array(TRUE),
            array(FALSE),
            array(42)
        );
    }

    public function testFromArrayWithDelegateSpecifiedCallsDelegateMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('delegate'));
        $provider->expects($this->once())
            ->method('delegate')
            ->with(
                $this->equalTo('SomeImplementationClass'),
                $this->equalTo('SomeCallable')
            );

        $this->builder->fromArray(array('delegates' => array(
            'SomeImplementationClass' => 'SomeCallable'
        )), $provider);
    }

    /**
     * @dataProvider provideBadDelegates
     * @expectedException \Auryn\BuilderException
     * @expectedExeptionCode \Auryn\InjectorBuilder::E_INVALID_DELEGATE
     */
    public function testFromArrayThrowsExceptionOnBadDelegate($badDelegate) {
        $configArray = array('delegates' => array(
            'ClassName' => $badDelegate
        ));
        $this->builder->fromArray($configArray);
    }

    public function provideBadDelegates() {
        return array(
            array(
                new StdClass // not callable
            ),
            array(
                'ClassWithoutMagicInvoke' // not a class with __invoke
            ),
            array(
                array('ClassWithoutMagicInvoke', '__invoke') // two item array that looks callable but isn't
            )
        );
    }

    public function testFromFilePopulatesProviderFromPhpConfig() {
        $file = FIXTURE_DIR . '/valid_config.php';
        $provider = $this->builder->fromFile($file);
        $this->assertInstanceOf('\Auryn\Provider', $provider);
    }

    /**
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnreadablePhpFile() {
        $badFile = '/this_file_definitely_doesnt_exist.php';
        $this->builder->fromFile($badFile);
    }

    /**
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnknownFileType() {
        $badFile = '/we/cant/determine/the/type/because/theres/no/extension/present';
        $this->builder->fromFile($badFile);
    }

    /**
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnMissingPhpConfigArray() {
        $badFile = FIXTURE_DIR . '/config_missing_expected_array.php';
        $this->builder->fromFile($badFile);
    }

    public function testFromFilePopulatesProviderFromJsonConfig() {
        $file = FIXTURE_DIR . '/valid_config.json';
        $provider = $this->builder->fromFile($file);
        $this->assertInstanceOf('\Auryn\Provider', $provider);
    }

    /**
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnreadableJsonFile() {
        $badFile = '/this_file_definitely_doesnt_exist.json';
        $this->builder->fromFile($badFile);
    }

    /**
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnparsableJsonFile() {
        $badFile = FIXTURE_DIR . '/config_with_unparsable.json';
        $this->builder->fromFile($badFile);
    }

}
