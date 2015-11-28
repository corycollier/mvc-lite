<?php
/**
 * camelcase to dash filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * camelcase to dash filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Filter_CamelcaseToDash
extends Lib_Filter_Abstract
{
    /**
     * (non-PHPdoc)
     * @see filter/Lib_Filter_Abstract::filter()
     */
    public function filter ($word = '')
    {
        $result = '';

        for ($i = 0; $i < strlen($word); $i++) {
            if ($i > 0 && strtolower($word{$i}) !== $word{$i}) {
                $result .= '-';
            }
            $result .= strtolower($word{$i});
        }

        return $result;

    } // END function filter

} // END class Lib_Filter_CamelcaseToDash
