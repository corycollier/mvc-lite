<?php
/**
 * Submit Input View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

/**
 * Submit Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FormSubmit extends \MvcLite\View\HelperAbstract
{
    /**
     * renders a submit element
     *
     * @param array $attribs
     * @return string
     */
    public function render($attribs = array())
    {
        $template = implode(PHP_EOL, array(
            '<label for="submit">',
            '<input type="submit" !attribs />',
            '</label>',
        ));

        return strtr($template, array(
            '!attribs'  => $this->getHtmlAttribs($attribs),
        ));
    }
}
