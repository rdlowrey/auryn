<?php

spl_autoload_register(function($class) {
    if (strpos($class, 'Auryn\\') === 0) {
        $name = substr($class, strlen('Auryn'));
        require __DIR__ . "/../lib" . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    }
});
