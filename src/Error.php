<?php
/**
 * Class to handle errors throughout the site
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Error
 * @since       File available since release 1.2.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Object\Singleton;

/**
 * Class to handle errors throughout the site
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Error
 * @since       File available since release 1.2.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Error
    extends Object\Singleton
{
    /**
     * holder for all the errors that have occured for the request
     *
     * @var array $_errors
     */
    private $_errors = array();

    /**
     * handler for errors
     */
    public static function handle ($errno, $errstr, $errfile = null,
        $errline = null, $errcontext = array())
    {
        $self = get_called_class();

        // append the errors to the list of errors that have occured so far
        $self::getInstance()->_addError(array(
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
                throw new ErrorException(
                    $errstr, 0, $errno, $errfile, $errline
                );

            // the default stuff
            default:
                return;
        }

    } // END function handle

    /**
     * adds errors to the instance's error property
     *
     * @param array $error
     * @return Lib_Error $this for a fluent interface
     */
    private function _addError ($error = array())
    {
        $this->_errors[] = $error;
        return $this;

    } // END function _addError

    /**
     * getter for the _errors property
     *
     * @return array
     */
    public function getErrors ( )
    {
        return $this->_errors;

    } // END function getErrors

} // END class Lib_Error
