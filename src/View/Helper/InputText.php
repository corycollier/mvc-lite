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
class InputText extends InputElementAbstract
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
        $defaults = $this->getDefaultAttribs($name, 'text');
        $attribs  = array_merge($defaults, $attribs);
        $template = $template = $this->getStandardTemplate();

        return strtr($template, [
            '!label'    => $attribs['label'],
            '!id'       => $name,
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
