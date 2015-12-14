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
class SeparatorToUcwords extends FilterAbstract
{
    /**
     * Placeholder for the separator.
     * @var string
     */
    protected $separator;

    /**
     * Constructor.
     *
     * @param string $separator The separator to use for separating words.
     */
    public function __construct($separator)
    {
        $this->separator = $separator;
    }

    /**
     * filters a given string
     *
     * @param string $word
     *
     * @return string
     */
    public function filter($word = '')
    {
        $temp = strtr($word, [$this->separator => ' ']);
        $temp = ucwords($temp);
        return strtr($temp, [' ' => $this->separator]);
    }
}
