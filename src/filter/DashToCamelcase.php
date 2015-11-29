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

namespace MvcLite\Filter;

/**
 * dash to underscore filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class DashToCamelcase extends \MvcLite\FilterAbstract
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

    }

} // END class Lib_Filter_DashToCamelcase
