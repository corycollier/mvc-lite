<?php

class Lib_View_Helper_Csv
extends Lib_View_Helper_Abstract
{
    /**
     * 
     * Enter description here ...
     * @param unknown_type $items
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