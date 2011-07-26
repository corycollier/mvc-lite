<?php
/**
 * 
 * Enter description here ...
 * @author corycollier
 *
 */
class Response
{
    /**
     * The instance property, used to enforce the singleton pattern
     * 
     * @var Response
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
     * @return Response
     */
    public static function getInstance ( )
    {   // if the instance property isn't already set, set it
        if (! self::$_instance) {
            self::$_instance = new Response;
        }
        
        return self::$_instance;
        
    } // END function getInstance

    /**
     * Set's a header value
     * 
     * @param string $name
     * @param string $value
     * @return Response $this for a fluent interface
     */
    public function setHeader ($name, $value = '')
    {
        $this->_headers[$name] = $value;
        
        return $this;
        
    } // END function setHeader
    
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
     * @return Response $this for a fluent interface
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