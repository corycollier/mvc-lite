<?php
/**
 * csv View Helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * csv View Helper class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View_Helper_Csv
extends Lib_View_Helper_Abstract
{
    /**
     * The render method for the csv view helper
     *
     * @param array $items
     */
    public function render ($items = array())
    {
        $return = '';
        
        $headers = array_keys((array)$items[0]);
    
        $return .= '"' . implode('", "', $headers) . '"';
    
        foreach ($items as $item) {
        
            $item = array_values((array)$item);
            
            $return .=  PHP_EOL . '"' . implode('", "', $item) . '"';
        }
        
        return $return;
        
    } // END function render
    
} // END class Lib_View_Helper_Csv