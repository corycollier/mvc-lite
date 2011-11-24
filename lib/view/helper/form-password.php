<?php
/**
 * Password Input View Helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Password Input View Helper class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Lib_View_Helper_FormPassword
extends Lib_View_Helper_Abstract
{
    /**
     * method to render a input[type=password] element
     * 
     * @param array $attribs
     * @return string
     */
    public function render ($name, $attribs = array())
    {
        $template = '<label for="!id" class="form-text"><span class="label">!label</span><input type="password" !attribs /></label>';
        
        $attribs['name'] = $name;
        $attribs['id'] = $name;
        
        return strtr($template, array(
            '!id'       => $name,
            '!label'    => @$attribs['label'],
            '!attribs'  => $this->_htmlAttribs($attribs),
        ));
        
        
    } // END function render

} // END class Lib_View_Helper_FormPassword