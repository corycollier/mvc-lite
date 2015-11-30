<?php
/**
 * string to lower filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Filter;

/**
 * string to lower filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class StringToLower extends \MvcLite\FilterAbstract
{
    /**
     * (non-PHPdoc)
     * @see \MvcLite\FilterAbstract::filter()
     */
    public function filter ($word = '')
    {
        return strtolower($word);
    }

} // END class Lib_Filter_StringToLower
