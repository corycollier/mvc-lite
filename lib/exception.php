<?php
/**
 * Base Exception
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Exception
 * @since       File available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base Exception
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Exception
 * @since       File available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Exception
extends Exception
{
    /**
     * String message indicating that magic methods are bad, mmk?
     * 
     * @var string
     */
    const ERR_MAGIC_METHOD =  'Magic Methods defeat the purpose of this framework >_<';
    
} // END class Lib_Exception