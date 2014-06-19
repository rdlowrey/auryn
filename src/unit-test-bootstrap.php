<?php

/**
 * Differs from primary autoloader by routing classes suffixed with "Test"
 * to the "test/" directory instead of "lib/" ...
 */
spl_autoload_register(function($class) {
    if (strpos($class, 'Auryn\\Test\\') === 0) {
        $name = substr($class, strlen('Auryn\\Test'));
        require __DIR__ . '/../test' . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    } elseif (strpos($class, 'Auryn\\') === 0) {
        $name = substr($class, strlen('Auryn'));
        require __DIR__ . '/../lib' . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    }
});

define('FIXTURE_DIR', __DIR__ . '/../test/fixture');

require __DIR__ . '/../test/fixture/StandardInjectorTestClasses.php';
require __DIR__ . '/../test/fixture/NamespacedClass.php';
