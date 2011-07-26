<?php
/**
 * 
 * Enter description here ...
 * @author corycollier
 *
 */
class Loader
{
    /**
     * list of registered resources
     * 
     * @var array
     */
    private $_resources = array();
    
    /**
     * 
     * property to maintain the single instance of this class
     * 
     * @var Loader
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
     */
    public static function getInstance ( )
    {   // if the instance property isn't set, set it
        if (! self::$_instance) {
            self::$_instance = new Loader;
        }
        
        return self::$_instance;
        
    } // END function getInstance
    
    /**
     * 
     * Method to try to load a class
     * 
     * @param string $class
     */
    public function autoload ($class)
    {   // if the class is already recognized, return self
        if (array_key_exists($class, $this->_resources)) {
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
                $this->_resources[$class] = $file;
                require $file;
                return $this;
            }
        }
        
        // hopefully we're not here. throw an exception if we are
        throw new Exception(
            "{$class} not found in include path"
        );
        
    } // END function autoload
    
    /**
     * 
     * Creates a relative filepath for a provided classname
     * 
     * @param string $class
     * @return string
     */
    public function getFilenameFromClassname ($class) 
    {
        $classPrefix = '.';
        
        $classParts = explode('_', $class);
        if (count($classParts) > 1) {
            $classPrefix = strtolower(end($classParts)) . 's';
        }
        
        return implode(DIRECTORY_SEPARATOR, array(
            $classPrefix,
            strtolower($class) . ".class.inc",
        ));
        
    } // END function getFilenameFromClassname
    
} // END class Loader