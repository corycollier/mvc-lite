<?php
/**
 * Submit Input View Helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Submit Input View Helper class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View_Helper_FormSubmit
extends Lib_View_Helper_Abstract
{
    /**
     * renders a submit element
     * 
     * @param array $attribs
     * @return string
     */
    public function render ($attribs = array())
    {
        $template = implode(PHP_EOL, array(
            '<label for="submit">',
            '<input type="submit" !attribs />',
            '</label>',
        ));
        
        return strtr($template, array(
            '!attribs'  => $this->_htmlAttribs($attribs),
        ));
        
    } // END function render

} // END class App_View_Helper_FormSubmit