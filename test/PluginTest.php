<?php


use Auryn\AurynInjector;


class PluginTest extends PHPUnit_Framework_TestCase {


    function testCustomPlugin() {
        $user = new User();
        $providerPlugin = new TestProviderPlugin($user);
        $provider = new AurynInjector($providerPlugin);
        $object = $provider->make('AuthenticationStatus');
        $this->assertInstanceOf('AuthenticatedStatus', $object, "Failed to make correct object");
    }



    public function testClassConstructorChainDefine1() {

        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);

        $widget1Name = 'parent1';
        $widget2Name = 'parent2';

        $providerPlugin->define('WidgetWithParams', array(':name' => $widget1Name), array('UsesWidgetWithParams1'));
        $providerPlugin->define('WidgetWithParams', array(':name' => $widget2Name), array('UsesWidgetWithParams2'));

        $usesWidgetWithParams1 = $provider->make('UsesWidgetWithParams1');
        $usesWidgetWithParams2 = $provider->make('UsesWidgetWithParams2');

        $this->assertEquals($widget1Name, $usesWidgetWithParams1->widget->name);
        $this->assertEquals($widget2Name, $usesWidgetWithParams2->widget->name);
    }


    public function testUnableToFindDefine() {
        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);

        $this->setExpectedException(
            'Auryn\\InjectionException',
            sprintf(\Auryn\AurynInjector::$errorMessages[
            \Auryn\AurynInjector::E_UNDEFINED_PARAM], 'WidgetWithParams', 'name'),
            \Auryn\AurynInjector::E_UNDEFINED_PARAM
        );

        $providerPlugin->define('WidgetWithParams', array(':name' => 'parent1'), array('UsesWidgetWithParams1'));
        $provider->make('UsesWidgetWithParams2');
    }

    public function testClassConstructorChainSharingNotFound() {
        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);
        $warningLogger = new LoggerTest('warn');

        $providerPlugin->define('LoggerTest', array(':logLevel' => 'info'));
        $providerPlugin->shareObject($warningLogger, array('RequiresLogger1'));

        //The logger shared above doesn't match the new chainClassConstructors, so a new
        //instance will be made.
        $provider->make('RequiresLogger2');
    }

    public function testClassConstructorChainDefine2() {
        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);

        $widget1Name = 'parent1';
        $widget2Name = 'parent2';

        $providerPlugin->define('WidgetWithParams', array(':name' => 'parent1'), array('UsesWidgetWithParamsOnceRemoved1'));
        $providerPlugin->define('WidgetWithParams', array(':name' => 'parent2'), array('UsesWidgetWithParamsOnceRemoved2'));

        $usesWidgetWithParamsOnceRemoved1 = $provider->make('UsesWidgetWithParamsOnceRemoved1');
        $usesWidgetWithParamsOnceRemoved2 = $provider->make('UsesWidgetWithParamsOnceRemoved2');

        $this->assertEquals($widget1Name, $usesWidgetWithParamsOnceRemoved1->usesWidget->widget->name);
        $this->assertEquals($widget2Name, $usesWidgetWithParamsOnceRemoved2->usesWidget->widget->name);
    }

    public function testClassConstructorChainMostSpecific() {
        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);


        $genericName = 'generic';
        $specificName = 'specific';

        $providerPlugin->define('WidgetWithParams', array(':name' => $genericName));
        $providerPlugin->define('WidgetWithParams', array(':name' => $specificName), array('UsesWidgetWithParamsOnceRemoved1'));

        $usesWidgetWithParamsOnceRemoved1 = $provider->make('UsesWidgetWithParamsOnceRemoved1');
        $usesWidgetWithParams1 = $provider->make('UsesWidgetWithParams1');

        $this->assertEquals($genericName, $usesWidgetWithParams1->widget->name);
        $this->assertEquals($specificName, $usesWidgetWithParamsOnceRemoved1->usesWidget->widget->name);
    }

    public function testClassConstructorChainSharing0() {

        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);
        $warningLogger = new LoggerTest('warn');
        $providerPlugin->shareObject($warningLogger, array('RequiresLogger1'));
        $requiresLogger1 = $provider->make('RequiresLogger1');
        $requiresLogger2 = $provider->make('RequiresLogger1');

        $this->assertSame($requiresLogger1->logger, $requiresLogger2->logger);
    }


    public function testClassConstructorChainSharing1() {

        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);

        $warningLogger = new LoggerTest('warn');
        $infoLogger = new LoggerTest('info');

        $providerPlugin->shareObject($warningLogger, array('RequiresLogger1'));
        $providerPlugin->shareObject($infoLogger, array('RequiresLogger2'));

        $requiresLogger1 = $provider->make('RequiresLogger1');
        $requiresLogger2 = $provider->make('RequiresLogger2');

        $this->assertEquals('warn', $requiresLogger1->requiresLoggerDependency1->logger->getLogLevel());
        $this->assertEquals('info', $requiresLogger2->requiresLoggerDependency2->logger->getLogLevel());
    }


    public function testClassConstructorChainSharing2() {

        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);

        $warningLogger = new LoggerTest('warn');
        $infoLogger = new LoggerTest('info');

        $providerPlugin->shareObject($warningLogger); //Used by all classes
        //$provider->share($infoLogger, array('RequiresLogger2')); //used by RequiresLogger2 and it's constructor dependencies.

        $requiresLogger1 = $provider->make('RequiresLogger1');
        //$requiresLogger2 = $provider->make('RequiresLogger2');

        $this->assertEquals('warn', $requiresLogger1->requiresLoggerDependency1->logger->getLogLevel());
        //$this->assertEquals('info', $requiresLogger2->requiresLoggerDependency2->logger->getLogLevel());
    }


    public function testClassConstructorChainSharing3() {

        $providerPlugin = new \Auryn\Plugin\ClassConstructorChainProviderPlugin();
        $provider = new AurynInjector($providerPlugin);

        $warningLogger = new LoggerTest('warn');
        $infoLogger = new LoggerTest('info');

        $providerPlugin->shareObject($warningLogger); //Used by all classes
        $providerPlugin->shareObject($infoLogger, array('RequiresLogger2')); //used by RequiresLogger2 and it's constructor dependencies.

        $requiresLogger1 = $provider->make('RequiresLogger1');
        $requiresLogger2 = $provider->make('RequiresLogger2');

        $this->assertEquals('warn', $requiresLogger1->requiresLoggerDependency1->logger->getLogLevel());
        $this->assertEquals('info', $requiresLogger2->requiresLoggerDependency2->logger->getLogLevel());
    }
}


