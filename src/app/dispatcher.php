<?php
/**
 * App Dispatcher
 * 
 * @category    MVCLite
 * @package     App
 * @subpackage  Dispatcher
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * App Dispatcher
 *
 * Local override of the lib dispatcher. Anything custom goes in here 
 *
 * @category    MVCLite
 * @package     App
 * @subpackage  Dispatcher
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class App_Dispatcher
extends Lib_Dispatcher
{
    /**
     * Local implementation of the init method
     *
     * @return App_Dispatcher
     */
    public function init ()
    {   // either the APPLICATION_ENV constant is already defined, or we need to
        $applicationEnv = $this->getApplicationEnv($_SERVER['APPLICATION_ENV']);

        if (! defined('APPLICATION_ENV')) {
            define('APPLICATION_ENV', $applicationEnv);
        }
            
        $config = parse_ini_file(implode(DIRECTORY_SEPARATOR, array(
            ROOT, 'etc', 'application.ini',
        )), true);
        
        App_Registry::getInstance()->setAll(
            $this->parseConfiguration($config[APPLICATION_ENV])
        );

        return $this;
        
    } // END function init
    
} // END class App_Dispatcher
