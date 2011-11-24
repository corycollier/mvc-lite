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
     */
    public function init ( )
    {   // either the APPLICATION_ENV constant is already defined, or we need to
        defined ('APPLICATION_ENV')
            or define ('APPLICATION_ENV', $_SERVER['APPLICATION_ENV']);
            
        $config = parse_ini_file(implode(DIRECTORY_SEPARATOR, array(
            ROOT, 'etc', 'application.ini',
        )), true);
        
        $config = $config[APPLICATION_ENV];
        
        $results = array();

        // iterate through the parsed INI file
        foreach ($config as $key => $values) {
            $parts = explode('.', $key);
            if (! array_key_exists($parts[0], $results)) {
                $results[$parts[0]] = array();
            }
            
            $results[$parts[0]][$parts[1]] = $values;
        }
        
        // itereate through the built results, setting their values to registry
        foreach ($results as $setting => $values) {
            App_Registry::getInstance()->set($setting, $values);
        }
        
        $database = Lib_Database::getInstance();
        
    } // END function init
    
} // END class App_Dispatcher
