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

abstract class Lib_View_Helper_Abstract
extends Lib_Object
{
    /**
     * property to hold a reference to the view that's calling the helper
     * 
     * @var Lib_View
     */
    protected $_view;
    
    /**
     * Constructor for all view helpers
     * 
     * @param Lib_View $view
     */
    public function __construct(Lib_View $view = null)
    {
        if (! $view) {
            $view = Lib_View::getInstance();
        }
        $this->_view = $view;
        
    } // END function __construct
    
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
            'name', 'id', 'placeholder', 'class', 'value', 'href', 'rel', 'action', 'method',
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
    
} // END class Lib_View_Helper_Abstract