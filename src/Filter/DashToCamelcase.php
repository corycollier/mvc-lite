<?php
/**
 * dash to underscore filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Filter;

use MvcLite\FilterAbstract as FilterAbstract;

/**
 * dash to underscore filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class DashToCamelcase extends FilterAbstract
{
    /**
     * Filter
     */
    public function filter($word = '')
    {
        $words = explode('-', $word);
        $words = array_map('ucwords', $words);
        $words[0] = strtolower($words[0]);
        return implode('', $words);
    }
}
