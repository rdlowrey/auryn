<?php

spl_autoload_register(function($class) {
    if (0 === strpos($class, 'Auryn\\')) {
        $normalizedClass = str_replace('\\', '/', $class);
        require __DIR__ . "/src/{$normalizedClass}.php";
    }
});