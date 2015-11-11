<?php
/**
 * Text Input View Helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Text Input View Helper class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Lib_View_Helper_FormTextarea
extends Lib_View_Helper_Abstract
{
    /**
     * method to render a input[type=text] element
     * 
     * @param array $attribs
     * @return string
     */
    public function render ($name, $attribs = array())
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
            '!attribs'  => $this->_htmlAttribs($attribs),
            '!value'    => $attribs['value'],
        ));
        
    } // END function render

} // END class Lib_View_Helper_FormText
