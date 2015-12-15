<?php
/**
 * Text Input View Helper
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
 * Text Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FormText extends HelperAbstract
{
    /**
     * Render a input[type=text] element.
     *
     * @param string $name The name of the text element.
     * @param array $attribs An array of attributes.
     * @return string The resulting HTML.
     */
    public function render($name, $attribs = [])
    {
        $template = '<label for="!id" class="form-text">'
            . '<span class="label">!label</span>'
            . '<input type="text" !attribs />'
            . '</label>';

        $attribs['name'] = $name;
        $attribs['id'] = $name;

        return strtr($template, [
            '!label'    => @$attribs['label'],
            '!id'       => $name,
            '!attribs'  => $this->getHtmlAttribs($attribs),
        ]);
    }
}
