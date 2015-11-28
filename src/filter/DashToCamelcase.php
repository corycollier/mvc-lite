<?php
/**
 * dash to underscore filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * dash to underscore filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Filter_DashToCamelcase
extends Lib_Filter_Abstract
{
    /**
     * (non-PHPdoc)
     * @see filter/Lib_Filter_Abstract::filter()
     */
    public function filter ($word = '')
    {
        $words = explode('-', $word);
        $words = array_map('ucwords', $words);
        $words[0] = strtolower($words[0]);
        return implode('', $words);

    } // END function filter

} // END class Lib_Filter_DashToCamelcase
