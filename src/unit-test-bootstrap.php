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

require __DIR__ . '/../test/fixture/ProviderTestClasses.php';
require __DIR__ . '/../test/fixture/NamespacedClass.php';
