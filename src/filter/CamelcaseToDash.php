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

namespace MvcLite\Filter;

/**
 * camelcase to dash filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class CamelcaseToDash extends \MvcLite\FilterAbstract
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

    }

} // END class Lib_Filter_CamelcaseToDash
