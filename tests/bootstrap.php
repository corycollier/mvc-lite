<?php
// @codingStandardsIgnoreStart
$_SERVER['REQUEST_URI'] = '';
define('ROOT', realpath(implode(DIRECTORY_SEPARATOR, [
    dirname(__FILE__), '..',
])));
define('APP_PATH', implode(DIRECTORY_SEPARATOR, [
    ROOT, 'app',
]));
define('CONFIG_PATH', implode(DIRECTORY_SEPARATOR, [
    ROOT, 'etc',
]));
set_include_path(implode(PATH_SEPARATOR, [
    ROOT,
    get_include_path(),
]));

// Require the autoloader - it's really important :)
$loader = require ROOT . '/vendor/autoload.php';
$loader->addPsr4('MvcLite\\View\\', ROOT . '/src/View/');
$loader->addPsr4('MvcLite\\View\\Helper\\', ROOT . '/src/View/Helper/');
$loader->addPsr4('MvcLite\\Filter\\', ROOT . '/src/Filter/');

$loader->addPsr4('App\\', implode(DIRECTORY_SEPARATOR, [APP_PATH, 'Controller']));
// @codingStandardsIgnoreEnd
