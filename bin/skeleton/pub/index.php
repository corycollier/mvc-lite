<?php
/**
 * the application bootstrapping file.
 *
 * This file acts as the main entry point to the application
 *
 * @category    MvcLite
 * @package     App
 * @subpackage  Dispatch
 * @since       File available since release 1.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

// define the root path
define('ROOT', realpath(implode(DIRECTORY_SEPARATOR, array(
    dirname(__FILE__), '..',
)));

// define the application path
define('APP_PATH', implode(DIRECTORY_SEPARATOR, array(
    ROOT, 'app',
)));

// set the include path to be the library, then the application, then the rest
set_include_path(implode(PATH_SEPARATOR, array(
    ROOT,
    get_include_path(),
)));

// ensure the autoloader is ready
$dispatcher = App_Dispatcher::getInstance();
$dispatcher->init()->bootstrap();
// if this isn't being called from cli, then run it
if ( PHP_SAPI != 'cli' ) $dispatcher->dispatch();
