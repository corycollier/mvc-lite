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

/**
 * Text Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FormTextarea extends \MvcLite\View\HelperAbstract
{
    /**
     * method to render a input[type=text] element
     *
     * @param string $name The name of the element.
     * @param array $attribs An array of attributes to give the element.
     * @return string The resulting HTML.
     */
    public function render($name, $attribs = [])
    {
        $template = implode(PHP_EOL, [
            '<label for="!id" class="form-text">',
            '<span class="label">!label</span>',
            '<textarea type="text" !attribs>!value</textarea>',
            '</label>'
        ]);

        $attribs['name'] = $name;
        $attribs['id'] = $name;

        return strtr($template, [
            '!label'    => @$attribs['label'],
            '!id'       => $name,
            '!attribs'  => $this->getHtmlAttribs($attribs),
            '!value'    => $attribs['value'],
        ]);
    }
}
