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
extends Lib_Object_Singleton
{
    /**
     * A list of headers to be output
     * 
     * @var array
     */
    protected $_headers = array();

    /**
     * The body of the response
     * 
     * @var string
     */
    protected $_body = '';

    /**
     * method to start the database up
     */
    public function init ( )
    {

    } // END function init

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
