<?php
/**
 * Base Response
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Response
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base Response
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Response
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Response
extends Lib_Object
{
    /**
     * The instance property, used to enforce the singleton pattern
     * 
     * @var Lib_Response
     */
    private static $_instance;

    /**
     * A list of headers to be output
     * 
     * @var array
     */
    private $_headers = array();

    /**
     * The body of the response
     * 
     * @var string
     */
    private $_body = '';

    /**
     * Privatizing the constructor to enforce the singleton pattern
     */
    private function __construct ( )
    {
        $this->setHeader('X-Powered-By', 'lightness');

    } // END function __construct

    /**
     * Method to get the instance of the response object
     * 
     * @return Lib_Response
     */
    public static function getInstance ( )
    {   // if the instance property isn't already set, set it
        if (! self::$_instance) {
            self::$_instance = new Lib_Response;
        }

        return self::$_instance;

    } // END function getInstance

    /**
     * Set's a header value
     * 
     * @param string $name
     * @param string $value
     * @return Lib_Response $this for a fluent interface
     */
    public function setHeader ($name, $value = '')
    {
        $this->_headers[$name] = $value;

        return $this;

    } // END function setHeader

    /**
     * Set multiple headers at one time
     *
     * @param array $headers
     * @return Lib_Response $this for a fluent interface
     */
    public function setHeaders ($headers = array())
    {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }

        return $this;

    } // END function setHeaders

    /**
     * gets the header by name
     * 
     * @param string $name
     * @return string
     */
    public function getHeader ($name)
    {
        return @$this->_headers[$name];

    } // END function getHeader

    /**
     * Returns all of the headers
     * 
     * @return array
     */
    public function getHeaders ( )
    {
        return $this->_headers;

    } // END function getHeaders

    /**
     * Function to return a formatted header string
     * 
     * @return Lib_Response $this for a fluent interface
     */
    public function sendHeaders ( )
    {   // iterate over the headers, sending them out
        foreach ($this->getHeaders() as $name => $value) {
            header("{$name}: {$value}");
        }

        return $this;

    } // END function getHeaderString

    /**
     * set the body of the response
     * 
     * @param string $string
     * @return Response $this for a fluent interface
     */
    public function setBody ($string)
    {
        $this->_body = (string)$string;

        return $this;

    } // END function setBody

    /**
     * gets the response body
     * 
     * @return string
     */
    public function getBody ( )
    {
        return $this->_body;

    } // END function getBody

} // END class Response
