<?php
/**
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Loader
 * @since       File available since release 1.0.1
 */
/**
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Loader
 * @since       Class available since release 1.0.1
 */

class Lib_Loader
{
    /**
     * list of registered resources
     * 
     * @var array
     */
    private $_resources = array();
    
    /**
     * property to maintain the single instance of this class
     * 
     * @var Lib_Loader
     */
    private static $_instance;
    
    /**
     * Privatizing the constructor to enforce the singleton pattern
     */
    private function __construct ( )
    {   // register this class's autload method as the spl autoloader
        spl_autoload_register(array($this, 'autoload'));
        
    } // END function __construct
    
    /**
     * Method to get the single instance of this class (singleton)
     * 
     * @return Lib_Loader
     */
    public static function getInstance ( )
    {   // if the instance property isn't set, set it
        if (! self::$_instance) {
            self::$_instance = new Lib_Loader;
        }
        
        return self::$_instance;
        
    } // END function getInstance
    
    /**
     * Method to try to load a class
     * 
     * @param string $class the name of the class to load
     */
    public function autoload ($class)
    {   // if the class is already recognized, return self
        if (@$this->_resources[$class]) {
            return $this;    
        }
        
        // iterate through the include paths, looking for the file        
        $includePaths = explode(PATH_SEPARATOR, get_include_path());
        foreach ($includePaths as $includePath) {
            $file = realpath(implode(DIRECTORY_SEPARATOR, array(
                $includePath,
                $this->getFilenameFromClassname($class),
            )));
            
            // if we've found the file, set it to the property, require it, quit
            if ($file) {
                $this->_resources[$class] = true;
                require $file;
                return $this;
            }
        }
        
        // hopefully we're not here. throw an exception if we are
        throw new Lib_Exception(
            "{$class} not found in include path"
        );
        
    } // END function autoload
    
    /**
     * Creates a relative filepath for a provided classname
     * 
     * @param string $class
     * @return string the relative pathname for including the class
     */
    public function getFilenameFromClassname ($class) 
    {   // return a relative path name based on the class name
        return strtolower(strtr($class, array(
            '_' => DIRECTORY_SEPARATOR,
        ))) . ".php";
        
    } // END function getFilenameFromClassname
    
} // END class Loader