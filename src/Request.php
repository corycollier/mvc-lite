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

use \MvcLite\Traits\Singleton as SingletonTrait;

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
     * method to start the database up
     */
    public function init()
    {
        $this->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $this->params = array_merge($this->params, $_COOKIE);
        $this->params = array_merge($this->params, $_POST);
        $this->params = array_merge($this->params, $_GET);
        $this->setHeaders();
        $this->setParams($this->buildFromString(@$_GET['q']));
    }

    /**
     *
     * Method to set the headers
     */
    protected function setHeaders()
    {
        // Create the filter chain to transform _SERVER to headers.
        $filter = new FilterChain;
        $filter->addFilter(new Filter\UnderscoreToDash);
        $filter->addFilter(new Filter\StringtoLower);
        $filter->addFilter(new Filter\SeparatorToUcwords('-'));

        // iterate over the $_SERVER superglobal values.
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) != 'HTTP_') {
                continue;
            }
            $key = $filter->filter($key);
            $key = strtr($key, ['Http-' => '']);
            $this->headers[$key] = $value;
        }
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
        // create a list of parts by separator
        $parts = array_filter(explode($separator, $string));

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
}