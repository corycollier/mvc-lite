<?php
/**
 * Password Input View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

/**
 * Password Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FormPassword extends \MvcLite\View\HelperAbstract
{
    /**
     * method to render a input[type=password] element
     *
     * @param array $attribs
     * @return string
     */
    public function render($name, $attribs = [])
    {
        $template = '<label for="!id" class="form-text">'
            . '<span class="label">!label</span>'
            . '<input type="password" !attribs />'
            . '</label>';

        $attribs['name'] = $name;
        $attribs['id'] = $name;

        return strtr($template, [
            '!id'       => $name,
            '!label'    => @$attribs['label'],
            '!attribs'  => $this->getHtmlAttribs($attribs),
        ]);
    }
}
