<?php
/**
 * @file request.php
 * @package Lib
 * @subpackage Request
 * @category MVCLite
 */
/**
 * @package Lib
 * @subpackage Request
 * @category MVCLite 
 */

class Lib_Request
extends Lib_Object
{
    /**
     * associative array representing the request params
     * 
     * @var array
     */
    private $_params;

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
        
        // iterate over the parts, reformatting them as necessary
        foreach ($parts as $key => $value) {
            // destroy the numeric index
            unset($parts[$key]);
            
            // the first key is always the controller
            if ($key === 0) {
                $key = 'controller';
            }
            
            // the second key is always the action
            if ($key === 1) {
                $key = 'action';
            }
            
            // all other keys are the params
            if ($key > 1) {
                $param = @$parts[$key + 1];
                $key = $value;
                $value = $param;
                unset($parts[$key+1]);
            }

            // if there's a key, then reset it
            if ($key) {
                $parts[$key] = $value;
            }
        }
        
        // ensure that the controller and action parts are set
        $parts['controller'] = @$parts['controller']
            ? $parts['controller']
            : 'Index';
            
        $parts['action'] = @$parts['action']
            ? $parts['action']
            : 'index';

        // return parts
        return $parts;
        
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
        $this->_params = (array)$params;
        
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
    
} // END class Request