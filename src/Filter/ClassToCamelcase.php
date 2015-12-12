<?php
/**
 * class to camelcase filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Filter;

/**
 * class to camelcase filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ClassToCamelcase extends \MvcLite\FilterAbstract
{
    /**
     * (non-PHPdoc)
     * @see \MvcLite\FilterAbstract::filter()
     */
    public function filter($word = '')
    {
        $words = explode('_', $word);
        $word = end($words);

        $result = '';

        for ($i = 0; $i < strlen($word); $i++) {
            if ($i === 0) {
                $result .= strtolower($word{$i});
                continue;
            }
            $result .= $word{$i};
        }
        return $result;
    }
}
