<?php
/**
 * Autoloader class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Loader
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Autoloader class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Loader
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
require_once 'object.php';
require_once 'object/singleton.php';

class Lib_Loader
extends Lib_Object_Singleton
{
    /**
     * list of registered resources
     *
     * @var array
     */
    private $_resources = array();

    /**
     * Privatizing the constructor to enforce the singleton pattern
     */
    protected function __construct ( )
    {   // register this class's autload method as the spl autoloader
        spl_autoload_register(array($this, 'autoload'));

        require implode(DIRECTORY_SEPARATOR, array(
            LIB_PATH,
            'filter.php',
        ));

        $this->_resources['Lib_Object'] = true;
        $this->_resources['Lib_Object_Singleton'] = true;
        $this->_resources['Lib_Filter'] = true;

    } // END function __construct

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
            
            // last chance to try to find the file
            $file = realpath(implode(DIRECTORY_SEPARATOR, array(
                $includePath, 
                "{$class}.php",
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
    {
        $classParts = explode('_', $class);
        $replaceTerm = end($classParts);
        $localname = Lib_Filter::camelCaseToDash($replaceTerm);

        $classParts[count($classParts) - 1] = $localname;
        $class = implode('_', $classParts);

        // return a relative path name based on the class name
        return strtolower(strtr($class, array(
            '_' => DIRECTORY_SEPARATOR,
        ))) . ".php";

    } // END function getFilenameFromClassname

} // END class Loader
