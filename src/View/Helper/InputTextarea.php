<?php
/**
 * Text Input View Helper
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
 * Text Input View Helper class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class InputTextarea extends InputElementAbstract
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
        $defaults = $this->getDefaultAttribs($name, 'text');
        $attribs  = array_merge($defaults, $attribs);
        $template = '<div class="form-group">'
            . '<label for="!id" class="form-text">!label</label>'
            . '<textarea!attribs>!value</textarea>'
            . '</div>';

        return strtr($template, [
            '!label'    => $attribs['label'],
            '!id'       => $name,
            '!attribs'  => $this->getHtmlAttribs($attribs),
            '!value'    => $attribs['value'],
        ]);
    }

    /**
     * Local override of the isValidAttribute method.
     *
     * @param string $name The name of the attribute.
     *
     * @return boolean True if valid, false if not.
     */
    protected function isValidAttribute($name)
    {
        $no = [
            'label', 'value', 'type'
        ];

        if (in_array($name, $no)) {
            return false;
        }
        return true;
    }
}
