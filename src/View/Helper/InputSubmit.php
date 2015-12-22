<?php
/**
 * Submit Input View Helper
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

use MvcLite\View\Helper\InputElementAbstract as InputElementAbstract;

/**
 * Submit Input View Helper class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class InputSubmit extends InputElementAbstract
{
    /**
     * renders a submit element
     *
     * @param array $attribs
     * @return string
     */
    public function render($attribs = [])
    {
        $defaults = [
            'value' => 'Submit',
            'class' => 'btn btn-default',
        ];

        $attribs = array_merge($defaults, $attribs);

        $template = '<input type="submit"!attribs>';

        return strtr($template, [
            '!attribs'  => $this->getHtmlAttribs($attribs),
        ]);
    }
}
