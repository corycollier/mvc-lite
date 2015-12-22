<?php
/**
 * Checkbox Input View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

use MvcLite\View\Helper\InputElementAbstract as InputElementAbstract;

/**
 * Checkbox Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class InputCheckbox extends InputElementAbstract
{
    /**
     * method to render a input[type=password] element
     *
     * @param array $attribs
     * @return string
     */
    public function render($name, $attribs = [])
    {
        $defaults = $this->getDefaultAttribs($name, 'checkbox');
        $attribs  = array_merge($defaults, $attribs);
        $template = '<div class="checkbox !classes">'
            . '<label><input!attribs>!label</label>'
            . '</div>';

        return strtr($template, [
            '!id'       => $attribs['id'],
            '!label'    => $attribs['label'],
            '!classes'  => $this->getAdditionalClasses($attribs),
            '!attribs'  => $this->getHtmlAttribs($attribs),
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
            'label'
        ];

        if (in_array($name, $no)) {
            return false;
        }
        return true;
    }
}
