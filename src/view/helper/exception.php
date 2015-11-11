<?php
/**
 * Exception message view helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Exception message view helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View_Helper_Exception
extends Lib_View_Helper_Abstract
{
    /**
     * returns a string representation of an expected exception
     * 
     * @param Exception $exception
     * @return string
     */
    public function render ($exception = null)
    {
        if (! @$exception || !($exception instanceOf Exception)) {
            return '';
        }
        
        return $exception->getMessage();
        
    } // END function render
    
} // END class Lib_View_Helper_Exception