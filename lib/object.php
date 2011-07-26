<?php
/**
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Object
 * @since       File available since release 1.0.5
 */
/**
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Object
 * @since       Class available since release 1.0.5
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
        throw new Lib_Exception(Lib_Exception::ERR_MAGIC_METHOD);
        
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
        throw new Lib_Exception(Lib_Exception::ERR_MAGIC_METHOD);
        
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
        throw new Lib_Exception(Lib_Exception::ERR_MAGIC_METHOD);
        
    } // END function __call
    
} // END class Lib_Object