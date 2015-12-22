<?php
/**
 * Base Response
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Response
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Singleton as SingletonTrait;

/**
 * Base Response
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Response
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Response extends ObjectAbstract
{
    use SingletonTrait;

    const DEFAULT_CONTENT_TYPE = 'application/json';
    const ERR_INVALID_CONTENT_TYPE = 'The given content-type [%s] is not valid';

    /**
     * A list of headers to be output
     *
     * @var array
     */
    protected $headers = [];

    /**
     * The body of the response
     *
     * @var string
     */
    protected $body = '';

    /**
     * method to start the response up
     */
    public function init()
    {

    }

    /**
     * Set's a header value
     *
     * @param string $name
     * @param string $value
     *
     * @return MvcLite\Response $this for object-chaining.
     */
    public function setHeader($name, $value = '')
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Set multiple headers at one time
     *
     * @param array $headers
     *
     * @return MvcLite\Response $this for object-chaining.
     */
    public function setHeaders($headers = [])
    {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }

        return $this;
    }

    /**
     * gets the header by name
     *
     * @param string $name
     *
     * @return string
     */
    public function getHeader($name)
    {
        return $this->headers[$name];
    }

    /**
     * Returns all of the headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Function to return a formatted header string
     *
     * @return MvcLite\Response $this for object-chaining.
     */
    public function sendHeaders()
    {
        // iterate over the headers, sending them out
        foreach ($this->getHeaders() as $name => $value) {
            header("{$name}: {$value}");
        }

        return $this;
    }

    /**
     * set the body of the response
     *
     * @param string $string
     *
     * @return MvcLite\Response $this for object-chaining.
     */
    public function setBody($string)
    {
        $this->body = (string)$string;
        return $this;
    }

    /**
     * gets the response body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Setter for the content type.
     *
     * @param string $contentType The value to set the content type to.
     *
     * @return MvcLite\Response Returns $this, for object-chaining.
     *
     * @throws MvcLite\Exception If the content type is invalid, an exception is thrown.
     */
    public function setContentType($contentType = '')
    {
        if (! $contentType) {
            $contentType = self::DEFAULT_CONTENT_TYPE;
        }

        $types = [
            'application/json',
            'application/javascript',
            'text/html',
            'text/plain',
            'text/csv',
        ];

        if (!in_array($contentType, $types)) {
            throw new Exception(sprintf(SELF::ERR_INVALID_CONTENT_TYPE, $contentType));
        }

        $this->setHeader('Content-Type', $contentType);

        return $this;
    }

    /**
     * Getter for the content type.
     *
     * @return string The content type for the response
     */
    public function getContentType()
    {
        $contentType = $this->getHeader('Content-Type');
        if (! $contentType) {
            $contentType = self::DEFAULT_CONTENT_TYPE;
        }
        return $contentType;
    }
}
