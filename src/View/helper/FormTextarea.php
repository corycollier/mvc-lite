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
    public function render($name, $attribs = array())
    {
        $template = implode(PHP_EOL, array(
            '<label for="!id" class="form-text">',
            '<span class="label">!label</span>',
            '<textarea type="text" !attribs>!value</textarea>',
            '</label>'
        ));

        $attribs['name'] = $name;
        $attribs['id'] = $name;

        return strtr($template, array(
            '!label'    => @$attribs['label'],
            '!id'       => $name,
            '!attribs'  => $this->getHtmlAttribss($attribs),
            '!value'    => $attribs['value'],
        ));

    }

} // END class Lib_View_Helper_FormText
