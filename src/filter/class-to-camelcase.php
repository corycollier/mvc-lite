<?php
/**
 * class to camelcase filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * class to camelcase filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Filter_ClassToCamelcase
extends Lib_Filter_Abstract
{
    /**
     * (non-PHPdoc)
     * @see filter/Lib_Filter_Abstract::filter()
     */
    public function filter ($word = '')
    {
        $words = explode('_', $word);
        $word = end($words);

        $result = '';

        for($i = 0; $i < strlen($word); $i++) {
            if ($i === 0) {
                $result .= strtolower($word{$i});
                continue;
            }
            $result .= $word{$i};
        }

        return $result;

    } // END function filter

} // END class Lib_Filter_ClassToCamelcase
