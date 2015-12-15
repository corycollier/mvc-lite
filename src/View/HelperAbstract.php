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
     * Constructor for all view helpers.
     *
     * @param \MvcLite\View $view
     */
    public function __construct(View $view = null)
    {
        if (! $view) {
            $view = \MvcLite\View::getInstance();
        }
        $this->view = $view;
    }

    /**
     * Method to return a string of key=value pairs.
     *
     * @param array $attribs
     * @return string
     */
    protected function getHtmlAttribs($attribs = [])
    {
        // a list of acceptable html attributes
        $whiteListAttribs = [
            'name',
            'id',
            'placeholder',
            'class',
            'value',
            'href',
            'rel',
            'action',
            'method',
        ];

        // iterate over the attribs provided
        foreach ($attribs as $key => $value) {
            unset($attribs[$key]);
            if (in_array($key, $whiteListAttribs)) {
                $attribs[] = "{$key}=\"{$value}\"";
            }
        }

        if (!count($attribs)) {
            return '';
        }

        // return the pairs, imploded by a single space
        return ' ' . implode(' ', $attribs);
    }
}
