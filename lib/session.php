<?php
/**
 * Session Handler
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Request
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Session handling class
 * 
 * This class handles all necessary interaction with session information
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Request
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Session
extends Lib_Object_Singleton
{
    /**
     * property to store the data of the session
     *
     * @var array $_data
     */
    protected $_data = array();

    /**
     * Privatizing the constructor to enforce the singleton pattern
     * 
     * Initialize the _data property, and unset the _SESSION superglobal to 
     * prevent anything else from using it
     */
    protected function __construct ( )
    {
        // if this isn't being called from cli, then run it
        if ( PHP_SAPI != 'cli' ) {
            session_start();
            $this->_data = $_SESSION;
            unset($_SESSION);
        }

    } // END function __construct

    /**
     * Method to retrieve the _data param
     * 
     * @return array
     */
    public function getParams ( )
    {
        return @$this->_data;

    } // END function getData

    /**
     * Method to return a single parameter by name
     * 
     * @param string $param
     * @return unknown_type
     */
    public function getParam ($param)
    {
        return @$this->_data[$param];
        
    } // END function getParam
    
    /**
     * Method to set a single parameter value
     * 
     * @param string $param
     * @param unknown_type $value
     * @return Lib_Session $this for a fluent interface
     */
    public function setParam ($param, $value = '')
    {
        $this->_data[$param] = $value;
        
        // return $this for a fluent interface
        return $this;
    }
    
    /**
     * Utility method to allow for the setting of multiple parameters 
     * 
     * @param array $params
     * @return Lib_Session $this for a fluent interface
     */
    public function setParams ($params = array())
    {   // iterate over the params, setting them using the setParam method
        foreach ($params as $param => $value) {
            $this->setParam($param, $value);
        }
        
        // return $this for a fluent interface
        return $this;
        
    } // END function setParams

    /**
     * Method to destroy the session
     */
    public function destroy ( )
    {
        $this->_data = null;
        
        // if this isn't being called from cli, then run it
        if ( PHP_SAPI != 'cli' ) {
            session_destroy();
        }
        
        $this->__destruct();
        
    } // END function destroy
    
    /**
     * Implementation of the magic method __destruct, to save state 
     */
    public function __destruct ( )
    {
        $_SESSION = $this->_data;
        
    } // END function __destruct
    
} // END class Lib_Request
