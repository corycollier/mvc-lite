<?php
/**
 * Base Object Class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Object
 * @since       File available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base Object Class
 * 
 * All classes in the MVCLite framework extends this class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Object
 * @since       Class available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Object
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
        throw new Lib_Exception(strtr(Lib_Exception::ERR_MAGIC_METHOD_GET, array(
            '!explain'  => "{$self}->{$name}",
        )));

    } // END function __get

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
        throw new Lib_Exception(strtr(Lib_Exception::ERR_MAGIC_METHOD_SET, array(
            '!explain'  => "{$self}->{$name} = {$value}",
        )));

    } // END function __set

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
        throw new Lib_Exception(strtr(Lib_Exception::ERR_MAGIC_METHOD_CALL, array(
            '!explain'  => "{$self}::{$method}(" . @implode(',', $args) . ')',
        )));

    } // END function __call
    
} // END class Lib_Object
