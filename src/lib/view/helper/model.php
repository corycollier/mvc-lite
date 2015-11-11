<?php
/**
 * Model View Helper
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Model View Helper class
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View_Helper_Model
extends Lib_View_Helper_Abstract
{
    /**
     * returns the appropriate controller to handle requests for this model
     */
    public function getController (Lib_Model $model)
    {
        $class = get_class($model);
        $filter = new Lib_Filter;
        $filter->addFilter(new Lib_Filter_ClassToCamelcase)
            ->addFilter(new Lib_Filter_CamelcaseToDash)
            ->addFilter(new Lib_Filter_Pluralize);

        return $filter->filter($class);
        
    } // END function getController
    
    /**
     * returns an array of field values for the model
     * 
     * @param Lib_Model $model
     * @return array
     */
    public function getColumns (Lib_Model $model)
    {
        $results = array();
        
        foreach ($model->getFields() as $column => $info) {
            $results[$column] = @$info['label'];
        }
        
        return $results;
        
    } // END function getColumns
    
    /**
     * method to return a human friendly name for a model
     * 
     * @param Lib_Model $model
     */
    public function getName (Lib_Model $model)
    {
        $class = get_class($model);
        $filter = new Lib_Filter;
        $filter->addFilter(new Lib_Filter_ClassToCamelcase)
            ->addFilter(new Lib_Filter_CamelcaseToDash);
            
        //
        return ucwords(strtr($filter->filter($class), array(
            '-' => ' ',
        )));
        
    } // END function getName
    
} // END class Lib_View_Helper_Model
