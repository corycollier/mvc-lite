<?php
/**
 * Base Request
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Request
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Singleton as SingletonTrait;
use MvcLite\Traits\FilterChain as FilterChainTrait;

/**
 * Base Request
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Request
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Request extends ObjectAbstract
{
    use SingletonTrait;
    use FilterChainTrait;

    /**
     * Constants
     */
    const ERR_BAD_CONTENT_TYPE = 'Content type [%s] not recognized';

    /**
     * associative array representing the request params
     *
     * @var array
     */
    protected $params = [];

    /**
     * associative array of the headers sent from the client
     *
     * @var array
     */
    protected $headers = [];

    /**
     * stores the original request uri
     *
     * @var string
     */
    protected $uri;

    /**
     * method to start the request up
     */
    public function init()
    {
        $this->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $this->params = array_merge($this->params, $_COOKIE);
        $this->params = array_merge($this->params, $_POST);
        $this->params = array_merge($this->params, $_GET);
        $this->setHeaders($_SERVER);
        $this->setParams($this->buildFromString(@$_GET['q']));
    }

    /**
     *
     * Method to set the headers.
     *
     * @return MvcLite\Request Returns $this, for object-chaining.
     */
    public function setHeaders($headers = [])
    {
        // Create the filter chain to transform _SERVER to headers.
        $filter = $this->getFilterChain([
            'UnderscoreToDash',
            'StringtoLower',
        ]);
        $filter->addFilter(new Filter\SeparatorToUcwords('-'));

        // iterate over the $_SERVER superglobal values.
        foreach ($headers as $key => $value) {
            if (substr($key, 0, 5) != 'HTTP_') {
                continue;
            }
            $key = $filter->filter($key);
            $key = strtr($key, ['Http-' => '']);
            $this->setHeader($key, $value);
        }

        if (isset($headers['CONTENT_TYPE'])) {
            $this->setHeader('Content-Type', $headers['CONTENT_TYPE']);
        }

        return $this;
    }

    /**
     * Sets a single header
     *
     * @param string $name The name of the header to set.
     * @param string $value The value of the header.
     *
     * @return MvcLite\Request Returns $this, for object-chaining.
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Build an associative array from a string
     *
     * @param string $string
     * @param string $separator
     * @return array
     */
    public function buildFromString($string = '', $separator = '/')
    {
        global $argv;
        // create a list of parts by separator
        $parts = array_filter(explode($separator, $string));
        if (!$parts && PHP_SAPI == 'cli') {
            $parts = $argv;
            array_shift($parts);
        }

        $controller = array_shift($parts);
        $action = array_shift($parts);

        $results = [
            'controller' => $controller ? $controller : 'index',
            'action'     => $action ? $action : 'index',
        ];
        $length = count($parts);
        $i = 0;
        while ($i < $length) {
            if (array_key_exists($i + 1, $parts)) {
                $key = $parts[$i];
                $value = $parts[$i + 1];
                if (in_array($key, ['controller', 'action'])) {
                    if ($i <= 2) {
                        $i = $i + 2;
                    }
                    continue;
                }

                $results[$key] = $value;
            }
            $i = $i + 2;
        }

        return $results;
    }

    /**
     * setter for the params property
     *
     * @param $params
     * @return Request $this for object-chaining.
     */
    public function setParams($params = [])
    {
        $this->params = array_merge($this->params, (array)$params);

        return $this;
    }

    /**
     * getter for the params property
     *
     * @return array All of the request params (_GET, _POST, and _COOKIE)
     */
    public function getParams()
    {
        $params = $this->params;

        foreach ($params as $key => $value) {
            if (! $key || ! $value || $key === 'q') {
                unset($params[$key]);
            }
        }

        return $params;
    }

    /**
     * Gets a single param from the params array
     *
     * @param string $param
     * @return string
     */
    public function getParam($param)
    {
        if (array_key_exists($param, $this->params)) {
            return $this->params[$param];
        }
    }

    /**
     * method to set a param manually
     *
     * @param string $param
     * @param string $value
     * @return Request $this for object-chaining.
     */
    public function setParam($param, $value = '')
    {
        $this->params[$param] = $value;

        return $this;
    }

    /**
     * Determines if the request is post or not
     *
     * @return boolean
     */
    public function isPost()
    {
        // if there is data in the _post property, return true
        if (count($_POST)) {
            return true;
        }

        return false;
    }

    /**
     * getter for the headers property
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * method to get the value for a single header
     *
     * @param string $header
     */
    public function getHeader($header = '')
    {
        return @$this->headers[$header];
    }

    /**
     * Method to indicate whether the current request is AJAX or not
     *
     * @return boolean
     */
    public function isAjax()
    {
        // if the request is ajax, don't load the layout
        if ($this->getHeader('X-Requested-With') == 'XMLHttpRequest') {
            return true;
        }

        return false;
    }

    /**
     * getter for the uri value
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Getter for the content type of the request.
     *
     * @return string The content type.
     */
    public function getContentType()
    {
        $contentType = $this->getHeader('Content-Type');
        if (! $contentType) {
            $accept = $this->getHeader('Accept');
            $parts = explode(',', $accept);
            $contentType = $parts[0];
        }

        if (! $contentType && PHP_SAPI == 'cli') {
            return 'text/plain';
        }

        return $contentType ? $contentType : 'text/html';
    }

    /**
     * Gets a friendly version of the format.
     *
     * @param string $contentType The raw content type.
     *
     * @return string The machine friendly name for the request type (aka Format).
     */
    public function getFormat($contentType)
    {
        $map = [
            'application/json'       => 'json',
            'application/javascript' => 'json',
            'text/html'              => 'html',
            'text/plain'             => 'text',
            'text/csv'               => 'csv',
        ];

        if (!array_key_exists($contentType, $map)) {
            throw new Exception(sprintf(self::ERR_BAD_CONTENT_TYPE, $contentType));
        }

        return $map[$contentType];
    }
}
