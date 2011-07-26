<?php
/**
 * @file exception.php
 * @package Lib
 * @subpackage Exception
 * @category MVCLite
 */
/**
 * @package Lib
 * @subpackage Exception
 * @category MVCLite 
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