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
extends Lib_Object_Singleton
{
    /**
     * associative array representing the request params
     * 
     * @var array
     */
    protected $_params = array();

    /**
     * associative array of the headers sent from the client
     * 
     * @var array
     */
    protected $_headers = array();

    /**
     * stores the original request uri
     *
     * @var string
     */
    protected $_uri;

    /**
     * Privatizing the constructor to enforce the singleton pattern
     */
    protected function __construct ( )
    {
        parent::__construct();

        $this->_uri = $_SERVER['REQUEST_URI'];
        $this->_params = array_merge($this->_params, $_COOKIE);
        $this->_params = array_merge($this->_params, $_POST);
        $this->_params = array_merge($this->_params, $_GET);
        $this->_setHeaders();

    } // END function __construct

    /**
     * method to start the database up
     */
    public static function init ( )
    {
        self::getInstance();

    } // END function init

    /**
     * 
     * Method to set the headers
     */
    protected function _setHeaders ( )
    {   // iterate over the $_SERVER superglobal values
        foreach($_SERVER as $key => $value) {
            if(substr($key, 0, 5) != 'HTTP_') {
                continue;
            }
            $key = Lib_Filter::serverVarsToHeaderTypes($key);
            $this->_headers[$key] = $value;
        }

    } // END function _setHeaders

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
            : 'index';

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
        $params = $this->_params;
        
        foreach ($params as $key => $value) {
            if (! $key || ! $value || $key === 'q') {
                unset($params[$key]);
            }
        }
        
        return $params;

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
    
    /**
     * getter for the headers property
     * 
     * @return array
     */
    public function getHeaders ( )
    {
        return $this->_headers;
        
    } // END function getHeaders
    
    /**
     * method to get the value for a single header
     * 
     * @param string $header
     */
    public function getHeader ($header = '')
    {
        return @$this->_headers[$header];
        
    } // END function getHeader
    
    /**
     * Method to indicate whether the current request is AJAX or not
     * 
     * @return boolean
     */
    public function isAjax ( )
    {
        // if the request is ajax, don't load the layout
        if ($this->getHeader('X-Requested-With') == 'XMLHttpRequest') {
            return true;
        }
        
        return false;
        
    } // END function isAjax

    /**
     * getter for the uri value
     *
     * @return string
     */
    public function getUri ( )
    {
        return $this->_uri;
        
    } // END function getUri

} // END class Request
