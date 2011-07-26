<?php
/**
 * Base View Class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base View Class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View
extends Lib_Object
{
    /**
     * Variables assigned to the view
     * 
     * @var array
     */
    protected $_vars = array();
    
    /**
     * Instance variable to enforce the singleton pattern
     * 
     * @var Lib_View $_instance
     */    
    private static $_instance;
    
    /**
     * The name of the view script to be used
     * 
     * @var string
     */
    protected $_script;
    
    /**
     * The name of the layout script to be used
     * 
     * @var string
     */
    protected $_layout;
    
    /**
     * Privatize the constructor to enforce the singleton pattern
     */
    private function __construct ( )
    {
        
    } // END function __construct
    
    /**
     * Accessor to the instance property, used for the singleton pattern
     * 
     * @return Lib_View;
     */
    public static function getInstance ( )
    {   // if the instance property hasn't been set, then set it
        if (! self::$_instance) {
            self::$_instance = new Lib_View;
        }
        
        // return the instance property
        return self::$_instance;
        
    } // END function getInstance
    
    
    /**
     * Method to set the script attrubute
     * 
     * @param string $path
     * @return Lib_View $this for a fluent interface
     */
    public function setScript ($path)
    {
        $this->_script = (string)$path;
        
        return $this;
        
    } // END function setScript
    
    /**
     * Method to get the script attribute
     * 
     * @return string the name of the view script to use
     */
    public function getScript ( )
    {
        return $this->_script;
        
    } // END function getScript
    
    /**
     * Method to set the layout attribute
     * 
     * @param string $path
     * @return Lib_View $this for a fluent interface
     */
    public function setLayout ($path)
    {
        $this->_layout = (string)$path;
        
        return $this;
        
    } // END function setLayout
    
    /**
     * Returns the layout script name
     * 
     * @return string The name of the layout script to use
     */
    public function getLayout ( )
    {
        return $this->_layout;
        
    } // END function getLayout
    
    /**
     * Method to render the view
     */
    public function render ( )
    {
        ob_start();
        
        extract($this->_vars);
        include implode(DIRECTORY_SEPARATOR, array(
            APP_PATH,
            'views',
            'scripts',
            $this->getScript() . ".phtml",
        ));
        $content = ob_get_clean();
        
        ob_start();
        include(implode(DIRECTORY_SEPARATOR, array(
            APP_PATH,
            'views',
            'layouts',
            $this->getLayout() . ".phtml",
        )));
        $contents = ob_get_clean();
        
        return $this->filter($contents);
        
    } // END function render
    
    /**
     * Method to filter string input
     * 
     * @param $string the unfiltered output
     * @return string the filtered output
     */
    public function filter ($string)
    {
        return $string;
        
    } // END function filter
    
    /**
     * setter for the _vars property
     * 
     * @param string $var
     * @param unknown_type $value
     * @return Lib_View $this for a fluent interface
     */
    public function set ($var, $value = '')
    {
        $this->_vars[$var] = $value;
        
        return $this;
        
    } // END function set
    
    /**
     * getter for the _vars property
     * 
     * @param string $var
     * @return unknown_type
     */
    public function get ($var)
    {
        return @$this->_vars[$var];
        
    } // END function get
    
} // END class View