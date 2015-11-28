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

class Lib_Filter_DashToUnderscore
extends Lib_Filter_Abstract
{
    /**
     * (non-PHPdoc)
     * @see filter/Lib_Filter_Abstract::filter()
     */
    public function filter ($word = '')
    {
        return strtr($word, array(
            '-' => '_',
        ));

    } // END function filter

} // END class Lib_Filter_DashToUnderscore
