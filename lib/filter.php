<?php
/**
 * Base Filter
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base Filter
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Filter
extends Lib_Object
{
    /**
     * translates a string from dash separated to camelcase
     * 
     * @param string $string
     * @return string
     */
    public static function dashToCamelCase ($string = '')
    {
        
    } // END function dashToCamelCase
    
    /**
     * translates a string from camelcase to dash separated
     * 
     * @param string $string
     * @return string
     */
    public static function camelCaseToDash ($string = '')
    {
        $result = '';
        
        for($i = 0; $i < strlen($string); $i++) {
            if ($i > 0 && strtolower($string{$i}) !== $string{$i}) {
                $result .= '-';
            }
            $result .= $string{$i};
        }
        
        return $result;
        
    } // END function camelCaseToDash
    
    /**
     * translates a string from underscore separated to DIRECTORY_SEPARATOR 
     * separated
     * 
     * @param string $string
     * @return string
     */
    public static function underscoreToDirectorySeparator ($string = '')
    {
        
    } // END funciton underscoreToDirectorySeparator
    
    /**
     * translates a string from underscore separated to camelcased
     * 
     * @param string $string
     * @return string
     */
    public static function underscoreToCamelCase ($string = '')
    {
        
    } // END funciton underscoreToCamelCase
    
} // END function Lib_Filter
