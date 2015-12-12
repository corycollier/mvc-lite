<?php
/**
 * Base Object Class
 *
 * @category    PHP
 * @package     MvcLite
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
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Object
 * @since       Class available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */
abstract class ObjectAbstract
{
    const MSG_ERR_IDENTIFY = 'Descendents must implement the identify method';

    /**
     * Overriding the __get magic method
     *
     * Magic Methods are expensive. To help ensure the performance of the
     * MVCLite Framework, we disable them here.
     *
     * @param string $name
     *
     * @throws \MvcLite\Exception
     */
    final public function __get($name)
    {
        $self = get_called_class();
        throw new Exception(strtr(Exception::ERR_MAGIC_METHOD_GET, [
            '!explain'  => "{$self}->{$name}",
        ]));
    }

    /**
     * Overriding the __set magic method
     *
     * Magic Methods are expensive. To help ensure the performance of the
     * MVCLite Framework, we disable them here.
     *
     * @param string $name
     * @param mixed $value
     *
     * @throws \MvcLite\Exception
     */
    final public function __set($name, $value = '')
    {
        $self = get_called_class();
        throw new Exception(strtr(Exception::ERR_MAGIC_METHOD_SET, [
            '!explain'  => "{$self}->{$name} = {$value}",
        ]));
    }

    /**
     * Overriding the __call magic method
     *
     * Magic Methods are expensive. To help ensure the performance of the
     * MVCLite Framework, we disable them here.
     *
     * @param string $method
     * @param array $args
     *
     * @throws \MvcLite\Exception
     */
    final public function __call($method, $args = [])
    {
        $self = get_called_class();
        throw new Exception(strtr(Exception::ERR_MAGIC_METHOD_CALL, [
            '!explain'  => "{$self}::{$method}(" . @implode(',', $args) . ')',
        ]));
    }

    /**
     * returns a string representation of the object
     */
    public function __toString()
    {
        return get_class($this);
    }

    /**
     * method used to identify the object instance
     *
     * @throws \MvcLite\Exception
     * @return string
     */
    public function identify()
    {
        $self = get_called_class();
        throw new Exception($self::MSG_ERR_IDENTIFY);
    }
}
