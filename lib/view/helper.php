<?php
/**
 * Base View Helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base View Helper class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View_Helper
{
    /**
     * Method to return a string of key=value pairs
     * 
     * @param array $attribs
     * @return string
     */
    protected function _htmlAttribs ($attribs = array())
    {   
        // a list of acceptable html attributes
        $whiteListAttribs = array(
            'name', 'id', 'placeholder', 'class', 'value', 'href', 'rel'
        );
        
        // iterate over the attribs provided
        foreach ($attribs as $key => $value) {
            unset($attribs[$key]);
            if (in_array($key, $whiteListAttribs)) {
                $attribs[] = "{$key}=\"{$value}\"";
            }
        }
        // return the pairs, imploded by a single space
        return ' ' . implode(' ', $attribs);
        
    } // END function _htmlAttribs
    
} // END class Lib_View_Helper