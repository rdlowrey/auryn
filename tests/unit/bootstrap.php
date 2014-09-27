<?php

dl('auryn.so');
define('START_TIME', microtime(true));
define('ROOT_PATH', dirname(dirname(__FILE__)));
error_reporting(E_ALL);

// Include debug functions
require_once 'debug.php';

if (file_exists(\ROOT_PATH . '/../vendor/autoload.php')) {
    require_once \ROOT_PATH . '/../vendor/autoload.php';
}

if (file_exists(\ROOT_PATH . '/autoload.php')) {
    require_once \ROOT_PATH . '/autoload.php';
}
