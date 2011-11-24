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
     * holds the list of filters
     * 
     * @var array
     */
    protected $_filters = array();
    
    /**
     * adds a filter to the chain
     * 
     * @param Lib_Filter_Abstract $filter
     */
    public function addFilter (Lib_Filter_Abstract $filter)
    {
        $this->_filters[] = $filter;
        
        return $this;
        
    } // END function addFilter
    
    /**
     * method to return a filter instance
     * 
     * @param string $filterName
     */
    public static function factory ($filterName)
    {   // iterate over the registered (haha) packages
        foreach (array('App', 'Lib') as $package) {
            try {
                $class = "{$package}_Filter_{$filterName}";
                Lib_Loader::getInstance()->autoload($class);
                return new $class;
            }
            catch (Lib_Exception $exception) { }
        }
        // throw an exception if we get this far, 
        throw new Lib_Exception("Requested filter [{$filter}] not found");
    }
    
    /**
     * filters a chain
     * 
     * @param string $word
     */
    public function filter ($word = '')
    {   
        // iterate through the filters, triming the word as defined
        foreach ($this->_filters as $filter) {
            $word = $filter->filter($word);
        }
        
        return $word;
        
    } // END function filter
    
    /**
     * translates a string from dash separated to camelcase
     * 
     * @param string $string
     * @return string
     */
    public static function dashToCamelCase ($string = '')
    {
        $words = explode('-', $string);
        $words = array_map('ucwords', $words);
        $words[0] = strtolower($words[0]);
        return implode('', $words);

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
     * 
     * translates a string from all uppercase word separated by underscores, 
     * into proper cased words separated by dashes
     * 
     * @param string $string
     * @return string
     */
    public static function serverVarsToHeaderTypes ($string = '')
    {
        return str_replace(' ', '-', 
            ucwords(str_replace('_', ' ', strtolower(substr($string, 5))))
        );
    } // END function ucaseUnderscoreToPcaseDash
    
} // END function Lib_Filter
