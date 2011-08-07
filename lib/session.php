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
extends Lib_Object
{
    /**
     * property to contain all of the session information
     * @var array
     */
    private $_data = array();

    /**
     * Property used to enforce the singleton pattern
     * @var Lib_Session
     */
    private static $_instance;

    /**
     * Privatizing the constructor to enforce the singleton pattern
     * 
     * Initialize the _data property, and unset the _SESSION superglobal to 
     * prevent anything else from using it
     */
    private function __construct ( )
    {
        session_start();
        $this->_data = $_SESSION;
        unset($_SESSION);

    } // END function __construct

    /**
     * Method to enforce the singleton pattern
     * 
     * Used to retrieve the single instance of the session object
     * @return Lib_Session
     */
    public static function getInstance ( )
    {   // if the _instance property hasn't already been set, set it
        if (! self::$_instance) {
            self::$_instance = new Lib_Session;
        }

        // return the _instance proeperty
        return self::$_instance;

    } // END function getInstance

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
        session_destroy();
        $this->__destruct();

    } // END function destroy

    /**
     * Implementation of the magic method __destruct, to save state 
     */
    public function __destruct ( )
    {
        $_SESSION = $this_>_data;

    } // END function __destruct

} // END class Lib_Request
