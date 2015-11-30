<?php
/**
 * Class to handle errors throughout the site
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Error
 * @since       File available since release 1.2.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Traits\Singleton as SingletonTrait;

/**
 * Class to handle errors throughout the site
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Error
 * @since       File available since release 1.2.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Error extends ObjectAbstract
{
    use SingletonTrait;

    /**
     * Holder for all the errors that have occured for the request.
     *
     * @var array $errors
     */
    protected $errors = array();

    /**
     * handler for errors
     */
    public static function handle(
        $errno,
        $errstr,
        $errfile = null,
        $errline = null,
        $errcontext = array()
    ) {
        $self = get_called_class();

        // append the errors to the list of errors that have occured so far
        $self::getInstance()->addError(array(
            'errno'         => $errno,
            'errstr'        => $errstr,
            'errfile'       => $errfile,
            'errline'       => $errline,
            'errcontext'    => $errcontext,
        ));

        // switch, based on the error number given
        switch ($errno) {
            case E_ERROR:
            case E_WARNING:
            case E_PARSE:
            case E_CORE_WARNING:
            case E_USER_ERROR:
                // figure out something appropriate to do
                throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);

            // the default stuff
            default:
                return;
        }

    }

    /**
     * Adds errors to the instance's error property.
     *
     * @param array $error An array representing an error.
     *
     * @return \MvcLite\Error $this for object-chaining.
     */
    protected function addError($error = array())
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * Getter for the errors property.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
