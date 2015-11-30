<?php
/**
 * Session Handler
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Request
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Traits\Singleton as SingletonTrait;

/**
 * Session handling class
 *
 * This class handles all necessary interaction with session information
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Request
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Session extends ObjectAbstract
{
    use SingletonTrait;

    /**
     * property to store the data of the session
     *
     * @var array $_data
     */
    protected $data = array();

    /**
     * method to start the database up
     */
    public function init(array $data = array())
    {
        // if this isn't being called from cli, then start session
        if (PHP_SAPI != 'cli') {
            session_start();
           // unset($_SESSION);
        }

        $this->data = $data;
    }

    /**
     * Method to retrieve the data param
     *
     * @return array
     */
    public function getParams()
    {
        return $this->data;
    }

    /**
     * Method to return a single parameter by name
     *
     * @param string $param
     * @return unknown_type
     */
    public function getParam($param)
    {
        return $this->data[$param];
    }

    /**
     * Method to set a single parameter value
     *
     * @param string $param
     * @param string $value
     * @return \MvcLite\Session $this for object-chaining.
     */
    public function setParam($param, $value = '')
    {
        $this->data[$param] = $value;
        $_SESSION = $this->data;

        // return $this for object-chaining.
        return $this;
    }

    /**
     * Utility method to allow for the setting of multiple parameters
     *
     * @param array $params
     * @return \MvcLite\Session $this for object-chaining.
     */
    public function setParams($params = array())
    {
        // iterate over the params, setting them using the setParam method
        foreach ($params as $param => $value) {
            $this->setParam($param, $value);
        }

        // return $this for object-chaining.
        return $this;
    }

    /**
     * Method to destroy the session
     */
    public function destroy()
    {
        $this->data = null;

        // if this isn't being called from cli, then run it
        if (PHP_SAPI != 'cli') {
            session_destroy();
        }

        $this->__destruct();
    }

    /**
     * Implementation of the magic method __destruct, to save state
     */
    public function __destruct()
    {
        $_SESSION = $this->data;
    }
}
