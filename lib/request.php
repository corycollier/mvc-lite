<?php
/**
 * Base Request
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Request
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base Request
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Request
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Request
extends Lib_Object
{
    /**
     * associative array representing the request params
     * 
     * @var array
     */
    private $_params = array();

    /**
     * instance variable used to enforce the singleton pattern
     * 
     * @var Lib_Request
     */
    private static $_instance;
    
    /**
     * Privatizing the constructor to enforce the singleton pattern
     */
    private function __construct ( )
    {
        unset($_GET['q']);
        $this->_params = array_merge($this->_params, $_COOKIE);
        $this->_params = array_merge($this->_params, $_POST);
        $this->_params = array_merge($this->_params, $_GET);
        
    } // END function __construct
    
    /**
     * Build an associative array from a string
     * 
     * @param string $string
     * @param string $separator
     * @return array
     */
    public static function buildFromString ($string = '', $separator = '/')
    {   // create a list of parts by separator
        $parts = explode($separator, $string);
        $results = array();
        
        $results['controller'] = @$parts[0] 
            ? $parts[0]
            : 'Index';
            
        $results['action'] = @$parts[1]
            ? $parts[1]
            : 'index';
        
        // iterate over the parts, reformatting them as necessary
        foreach ($parts as $key => $value) {
            if (($key < 2) || ($key % 2)) {
                continue;
            }
            
            $results[$value] = @$parts[$key + 1];
        }

        // return parts
        return $results;
        
    } // END function buildFromString
    
    /**
     * Method used to enforce the singleton pattern 
     *
     * @return Lib_Request
     */
    public static function getInstance ( )
    {   // if the instance property isn't already set, set it
        if (! self::$_instance) {
            self::$_instance = new Lib_Request;
        }
        
        return self::$_instance;
        
    } // END function getInstance
    
    /**
     * setter for the params property
     * 
     * @param $params
     * @return Request $this for a fluent interface
     */
    public function setParams ($params = array())
    {
        $this->_params = array_merge($this->_params, (array)$params);
        
        return $this;
        
    } // END function setParams
    
    /**
     * getter for the params property
     * 
     * @return array All of the request params (_GET, _POST, and _COOKIE)
     */
    public function getParams ( )
    {
        return $this->_params;
        
    } // END function getParams
    
    /**
     * Gets a single param from the params array
     * 
     * @param string $param
     * @return string
     */
    public function getParam ($param)
    {
        return @$this->_params[$param];
        
    } // END function getParam
    
    /**
     * method to set a param manually
     * 
     * @param string $param
     * @param string $value
     * @return Request $this for a fluent interface
     */
    public function setParam ($param, $value = '')
    {
        $this->_params[$param] = $value;
        
        return $this;
        
    } // END function setParam
    
    /**
     * Determines if the request is post or not
     * 
     * @return boolean
     */
    public function isPost ( )
    {   // if there is data in the _post property, return true
        if (count($_POST)) {
            return true;
        }
        
        return false;
        
    } // END function isPost
    
} // END class Request