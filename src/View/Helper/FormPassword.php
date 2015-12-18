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

use MvcLite\View\HelperAbstract as HelperAbstract;

/**
 * Password Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FormPassword extends HelperAbstract
{
    /**
     * method to render a input[type=password] element
     *
     * @param array $attribs
     * @return string
     */
    public function render($name, $attribs = [])
    {
        $template = '<div class="form-group">'
            . '<label for="!id">!label</label>'
            . '<input!attribs />'
            . '</div>';

        $attribs['name'] = $name;
        $attribs['id'] = $name;
        $attribs['type'] = 'password';

        return strtr($template, [
            '!id'       => $name,
            '!label'    => @$attribs['label'],
            '!attribs'  => $this->getHtmlAttribs($attribs),
        ]);
    }
}
