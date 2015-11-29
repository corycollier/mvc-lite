<?php
/**
 * Base Object Class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Object
 * @since       File available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Base Object Class
 *
 * All classes in the MVCLite framework extends this class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Object
 * @since       Class available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */
abstract class ObjectAbstract
{
    /**
     * Overriding the __get magic method
     *
     * Magic Methods are expensive. To help ensure the performance of the
     * MVCLite Framework, we disable them here.
     *
     * @param string $name
     * @throws Lib_Exception
     */
    final public function __get ($name)
    {
        $self = get_called_class();
        throw new Exception(strtr(Exception::ERR_MAGIC_METHOD_GET, array(
            '!explain'  => "{$self}->{$name}",
        )));

    }

    /**
     * Overriding the __set magic method
     *
     * Magic Methods are expensive. To help ensure the performance of the
     * MVCLite Framework, we disable them here.
     *
     * @param string $name
     * @param unknown_type $value
     * @throws Lib_Exception
     */
    final public function __set ($name, $value = '')
    {
        $self = get_called_class();
        throw new Exception(strtr(Exception::ERR_MAGIC_METHOD_SET, array(
            '!explain'  => "{$self}->{$name} = {$value}",
        )));

    }

    /**
     * Overriding the __call magic method
     *
     * Magic Methods are expensive. To help ensure the performance of the
     * MVCLite Framework, we disable them here.
     *
     * @param string $method
     * @param array $args
     * @throws Lib_Exception
     */
    final public function __call ($method, $args = array())
    {
        $self = get_called_class();
        throw new Exception(strtr(Exception::ERR_MAGIC_METHOD_CALL, array(
            '!explain'  => "{$self}::{$method}(" . @implode(',', $args) . ')',
        )));

    }

    /**
     * returns a string representation of the object
     */
    public function __toString ( )
    {
        return get_class($this);

    }

    /**
     * method used to identify the object instance
     *
     * @throws Lib_Exception
     * @return string
     */
    public function identify ( )
    {
        throw new Lib_Exception(
            'Descendents must implement the identify method'
        );

    }

} // END class Lib_Object
