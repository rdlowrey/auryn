<?php

use \Auryn\ProviderBuilder;

class ProviderBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Auryn\ProviderBuilder
     */
    private $builder;

    protected function setUp()
    {
        $this->builder = new ProviderBuilder;
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     * @expectedException InvalidArgumentException
     */
    public function testFromArrayThrowsExceptionIfInvalidKeyFound() {
        $this->builder->fromArray($this->getMock('\Auryn\Provider'), array('InvalidKey' => 'value'));
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     */
    public function testFromArrayWithAliasSpecifiedCallsAliasMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('alias'));
        $provider->expects($this->once())
            ->method('alias')
            ->with(
                $this->equalTo('SomeInterface'),
                $this->equalTo('SomeImplementationClass')
            );

        $this->builder->fromArray($provider, array(
            'aliases' => array(
                'SomeInterface' => 'SomeImplementationClass'
            )
        ));
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     */
    public function testFromArrayWithDefinitionSpecifiedCallsDefineMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('define'));
        $provider->expects($this->once())
            ->method('define')
            ->with(
                $this->equalTo('SomeImplementationClass'),
                $this->equalTo(array(':arg1' => 'SomeString'))
            );

        $this->builder->fromArray($provider, array(
            'definitions' => array(
                'SomeImplementationClass' => array(
                    ':arg1' => 'SomeString'
                )
            )
        ));
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     */
    public function testFromArrayWithSharedDependencySpecifiedCallsShareMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('share'));
        $provider->expects($this->once())
            ->method('share')
            ->with($this->equalTo('MyUniversalClass'));

        $this->builder->fromArray($provider, array(
            'shares' => array('MyUniversalClass')
        ));
    }

    /**
     * @covers \Auryn\ProviderBuilder::fromArray
     */
    public function testFromArrayWithDelegateSpecifiedCallsDelegateMethodOnProvider() {
        $provider = $this->getMock('\Auryn\Provider', array('delegate'));
        $provider->expects($this->once())
            ->method('delegate')
            ->with(
                $this->equalTo('SomeImplementationClass'),
                $this->equalTo('SomeCallable')
            );

        $this->builder->fromArray($provider, array(
            'delegates' => array(
                'SomeImplementationClass' => 'SomeCallable'
            )
        ));
    }
}
