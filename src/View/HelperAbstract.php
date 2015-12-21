<?php
/**
 * Base View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View;

use MvcLite;
use MvcLite\Traits\View as ViewTrait;
use MvcLite\ObjectAbstract as ObjectAbstract;

/**
 * Base View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
abstract class HelperAbstract extends ObjectAbstract
{
    use ViewTrait;

    /**
     * Method to return a string of key=value pairs.
     *
     * @param array $attribs An array of attributes.
     *
     * @return string The resulting string of attributes.
     */
    protected function getHtmlAttribs($attribs = [])
    {
        // iterate over the attribs provided
        foreach ($attribs as $key => $value) {
            unset($attribs[$key]);
            if ($this->isValidAttribute($key)) {
                $attribs[] = "{$key}=\"{$value}\"";
            }
        }

        if (!count($attribs)) {
            return '';
        }

        // return the pairs, imploded by a single space
        return ' ' . implode(' ', $attribs);
    }

    /**
     * Gets any additional classes that might be required from the attributes.
     *
     * This method is better left to chidl classes to implement.
     *
     * @param array $attribs The array of attributes.
     *
     * @return string The resulting string of css classes
     */
    protected function getAdditionalClasses($attribs = [])
    {
        return '';
    }

    /**
     * Checks an attribute name to see if it's valid.
     *
     * @param string $name The name of the attribute.
     *
     * @return boolean True if the attribute is ok, false if not.
     */
    protected function isValidAttribute($name)
    {
        return true;
    }
}
