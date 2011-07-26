<?php
/**
 * the application bootstrapping file. 
 * 
 * This file acts as the main entry point to the application
 * 
 * @file dispatch.php
 * @package App
 * @subpackage Dispatch
 * @category MVCLite
 */

// require the autoloader
require '../lib/loader.php';

// define the root path
defined('ROOT')
    or define('ROOT', realpath(implode(DIRECTORY_SEPARATOR, array(
        dirname(__FILE__), '..',
    ))))
;
// define the application path
defined('APP_PATH')
    or define('APP_PATH', implode(DIRECTORY_SEPARATOR, array(
        ROOT, 'app',    
    )))
;
// define the library path
defined('LIB_PATH')
    or define('LIB_PATH', implode(DIRECTORY_SEPARATOR, array(
        ROOT, 'lib',    
    )))
;
// set the include path to be the library, then the application, then the rest
set_include_path(implode(PATH_SEPARATOR, array(
    ROOT,
    get_include_path(),
)));

// ensure the autoloader is ready
$loader = Lib_Loader::getInstance();

// setup the request
$request = Lib_Request::getInstance();
$request->setParams(Lib_Request::buildFromString(@$_GET['q']));

// if this isn't being called from cli, then run it
if ( PHP_SAPI != 'cli' ) Lib_Dispatcher::getInstance()->dispatch();

