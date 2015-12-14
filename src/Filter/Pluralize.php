<?php
/**
 * pluralize filter
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
 * pluralize filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Pluralize extends FilterAbstract
{
    /**
     * filters a given string
     *
     * @param string $word
     *
     * @return string
     */
    public function filter($word = '')
    {
        // if the word ends with the lettter 'y'
        if (substr($word, -1) == 'y') {
            return substr($word, 0, strlen($word) - 1) . 'ies';
        }
        return "{$word}s";
    }
}
