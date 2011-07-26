<?php

require '../lib/loader.class.inc';

defined('ROOT')
    or define('ROOT', realpath(implode(DIRECTORY_SEPARATOR, array(
        dirname(__FILE__), '..',
    ))))
;

defined('APP_PATH')
    or define('APP_PATH', implode(DIRECTORY_SEPARATOR, array(
        ROOT, 'app',    
    )))
;

defined('LIB_PATH')
    or define('LIB_PATH', implode(DIRECTORY_SEPARATOR, array(
        ROOT, 'lib',    
    )))
;

set_include_path(implode(PATH_SEPARATOR, array(
    LIB_PATH,
    APP_PATH,
    get_include_path(),
)));

$loader = Loader::getInstance();

$request = Request::getInstance();
$request->setParams(Request::buildFromString($_GET['q']));

$dispatcher = Dispatcher::getInstance();
$dispatcher->setRequest($request);
$dispatcher->dispatch();

