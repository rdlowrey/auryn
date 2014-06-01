<?php

/**
 * Differs from primary autoloader by routing classes suffixed with "Test"
 * to the "test/" directory instead of "lib/" ...
 */
spl_autoload_register(function($class) {
    if (strpos($class, 'Auryn\\') === 0) {
        $dir = strcasecmp(substr($class, -4), 'Test') ? 'lib' : 'test';
        $name = substr($class, strlen('Auryn'));
        require __DIR__ . '/../' . $dir . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    }
});

define('FIXTURE_DIR', __DIR__ . '/../test/fixture');

require __DIR__ . '/../test/fixture/PluginTestClasses.php';
require __DIR__ . '/../test/fixture/ProviderTestClasses.php';
require __DIR__ . '/../test/fixture/NamespacedClass.php';



//This test doesn't error when called within a class which means
//that it can't be included in the correct place for PHPUnit. 
function testMissingFunctionParamDefine() {
    $provider = new \Auryn\Provider();
    
    $function = function ($param) {
        return 4;
    };
    
    try {
        $provider->execute($function);
    }
    catch(Auryn\InjectionException $ie) {
       if ($ie->getCode() == \Auryn\AurynInjector::E_UNDEFINED_PARAM) {
           //This is the expected behaviour, so the test has passed.
           //The exception message will be similar to:
           //
           //No definition available while attempting to provision typeless 
           //non-concrete parameter for `function {closure} file 
           ///home/github/Auryn/src/unit-test-bootstrap.php line 28
           return;
       }

       throw $ie; 
    }
}

testMissingFunctionParamDefine();