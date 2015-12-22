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

use MvcLite\View\Helper\InputElementAbstract as InputElementAbstract;

/**
 * Password Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class InputPassword extends InputElementAbstract
{
    /**
     * method to render a input[type=password] element
     *
     * @param array $attribs
     * @return string
     */
    public function render($name, $attribs = [])
    {
        $defaults = $this->getDefaultAttribs($name, 'password');
        $attribs  = array_merge($defaults, $attribs);
        $template = $this->getStandardTemplate();

        return strtr($template, [
            '!id'       => $attribs['id'],
            '!label'    => $attribs['label'],
            '!attribs'  => $this->getHtmlAttribs($attribs),
        ]);
    }
}
