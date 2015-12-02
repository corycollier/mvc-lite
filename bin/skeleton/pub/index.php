<?php
/**
 * Application bootstrapping file.
 *
 * This file acts as the main entry point to the application
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  App
 * @since       File available since release 1.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

// Define the path contants.
define('ROOT', realpath(implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..'])));
define('APP_PATH', implode(DIRECTORY_SEPARATOR, [ROOT, 'app']));
define('CONFIG_PATH', implode(DIRECTORY_SEPARATOR, [ROOT, 'etc']));

// Set the include path.
set_include_path(implode(PATH_SEPARATOR, [ROOT, get_include_path()]));

// Setup the autoloader.
$loader = require implode(DIRECTORY_SEPARATOR, [ROOT, '..', 'vendor', 'autoload.php']);
$loader->addPsr4('App\\', APP_PATH);
$loader->addPsr4('App\\', implode(DIRECTORY_SEPARATOR, [APP_PATH, 'Controller']));

// Dispatch
$dispatcher = \MvcLite\Dispatcher::getInstance();
$dispatcher->init($loader);
// if this isn't being called from cli, then run it
if ( PHP_SAPI != 'cli' ) $dispatcher->dispatch();
