<?php

use \Auryn\ProviderBuilder;

class ProviderBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Auryn\ProviderBuilder
     */
    private $builder;

    protected function setUp() {
        $this->builder = new ProviderBuilder;
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     * @expectedException \Auryn\BuilderException
     */
    public function testFromArrayThrowsExceptionIfInvalidKeyFound() {
        $this->builder->fromArray(array('InvalidKey' => 'value'), $this->getMock('\Auryn\Provider'));
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addAliases
     */
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
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addAliases
     * @expectedException \Auryn\BuilderException
     * @dataProvider provideBadAliases
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

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addDefinitions
     */
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
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addDefinitions
     * @expectedException \Auryn\BuilderException
     */
    public function testFromArrayThrowsExceptionOnBadDefinition() {
        $configArray = array('definitions' => array(
            'SomeImplementationClass' => array(
                'thisShouldHaveRawScalarPrefixButDoesnt' => new StdClass
        )));
        $this->builder->fromArray($configArray);
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addShares
     */
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
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addShares
     * @expectedException \Auryn\BuilderException
     * @dataProvider provideBadShares
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

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addDelegates
     */
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
     * @covers \Auryn\ProviderBuilder::fromArray
     * @covers \Auryn\ProviderBuilder::addDelegates
     * @expectedException \Auryn\BuilderException
     * @dataProvider provideBadDelegates
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
    
    /**
     * @covers \Auryn\ProviderBuilder::fromFile
     * @covers \Auryn\ProviderBuilder::loadFromPhpFile
     */
    public function testFromFilePopulatesProviderFromPhpConfig() {
        $file = FIXTURE_DIR . '/valid_config.php';
        $provider = $this->builder->fromFile($file);
        $this->assertInstanceOf('\Auryn\Provider', $provider);
    }
    
    /**
     * @covers \Auryn\ProviderBuilder::loadFromPhpFile
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnreadablePhpFile() {
        $badFile = '/this_file_definitely_doesnt_exist.php';
        $this->builder->fromFile($badFile);
    }
    
    /**
     * @covers \Auryn\ProviderBuilder::fromFile
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnknownFileType() {
        $badFile = '/we/cant/determine/the/type/because/theres/no/extension/present';
        $this->builder->fromFile($badFile);
    }
    
    /**
     * @covers \Auryn\ProviderBuilder::loadFromPhpFile
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnMissingPhpConfigArray() {
        $badFile = FIXTURE_DIR . '/config_missing_expected_array.php';
        $this->builder->fromFile($badFile);
    }
    
    /**
     * @covers \Auryn\ProviderBuilder::fromFile
     * @covers \Auryn\ProviderBuilder::loadFromJsonFile
     */
    public function testFromFilePopulatesProviderFromJsonConfig() {
        $file = FIXTURE_DIR . '/valid_config.json';
        $provider = $this->builder->fromFile($file);
        $this->assertInstanceOf('\Auryn\Provider', $provider);
    }
    
    /**
     * @covers \Auryn\ProviderBuilder::loadFromJsonFile
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnreadableJsonFile() {
        $badFile = '/this_file_definitely_doesnt_exist.json';
        $this->builder->fromFile($badFile);
    }
    
    /**
     * @covers \Auryn\ProviderBuilder::loadFromJsonFile
     * @expectedException Auryn\BuilderException
     */
    public function testFromFileThrowsOnUnparsableJsonFile() {
        $badFile = FIXTURE_DIR . '/config_with_unparsable.json';
        $this->builder->fromFile($badFile);
    }
    
}
