<?php

$_SERVER['REQUEST_URI'] = '';

// define the root path
define('ROOT', realpath(implode(DIRECTORY_SEPARATOR, [
    dirname(__FILE__), '..',
])));

// define the application path
define('APP_PATH', implode(DIRECTORY_SEPARATOR, [
    ROOT, 'app',
]));

// define the configuration path
define('CONFIG_PATH', implode(DIRECTORY_SEPARATOR, [
    ROOT, 'etc',
]));

// set the include path to be the library, then the application, then the rest
set_include_path(implode(PATH_SEPARATOR, [
    ROOT,
    get_include_path(),
]));

// Require the autoloader - it's really important :)
$loader = require ROOT . '/vendor/autoload.php';

// ensure the autoloader is ready
// $dispatcher = MvcLite\Dispatcher::getInstance();
// $dispatcher->init();
// // if this isn't being called from cli, then run it
// if ( PHP_SAPI != 'cli' ) $dispatcher->dispatch();
