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
// @codingStandardsIgnoreEnd
