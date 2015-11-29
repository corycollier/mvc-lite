<?php

$_SERVER['REQUEST_URI'] = '';



// define the root path
define('ROOT', realpath(implode(DIRECTORY_SEPARATOR, array(
    dirname(__FILE__), '..',
))));

// define the application path
define('APP_PATH', implode(DIRECTORY_SEPARATOR, array(
    ROOT, 'app',
)));

// set the include path to be the library, then the application, then the rest
set_include_path(implode(PATH_SEPARATOR, array(
    ROOT,
    get_include_path(),
)));

// Require the autoloader - it's really important :)
require ROOT . '/vendor/autoload.php';

// ensure the autoloader is ready
// $dispatcher = MvcLite\Dispatcher::getInstance();
// $dispatcher->init();
// // if this isn't being called from cli, then run it
// if ( PHP_SAPI != 'cli' ) $dispatcher->dispatch();
