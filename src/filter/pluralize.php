<?php
/**
 * pluralize filter
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * pluralize filter
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Filter_Pluralize
extends Lib_Filter_Abstract
{
    /**
     * filters a given string
     *
     * @param string $word
     * @return string
     */
    public function filter ($word = '')
    {   // if the word ends with the lettter 'y'
        if (substr($word, -1) == 'y') {
            return substr($word, 0, strlen($word) - 1) . 'ies';
        }
        return "{$word}s";

    } // END function filter

} // END class Lib_Filter_Pluralize