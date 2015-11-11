<?php
/**
 * Main Abstract Filter
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Main Abstract Filter
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

abstract class Lib_Filter_Abstract
extends Lib_Object
{
    /**
     * Method that *MUST* be defined by all children
     * 
     * @param string $word
     */
    abstract function filter ($word = '');
    
} // END class Lib_Filter_Abstract