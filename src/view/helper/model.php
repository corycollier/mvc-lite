<?php
/**
 * Model View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace \MvcLite\View\Helper;

use \MvcLite\Filter;

/**
 * Model View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Model extends \MvcLite\View\HelperAbstract
{
    /**
     * returns the appropriate controller to handle requests for this model
     */
    public function getController(ModelAbstract $model)
    {
        $class = get_class($model);
        $filter = new FilterChain;
        $filter->addFilter(new ClassToCamelcase)
            ->addFilter(new CamelcaseToDash)
            ->addFilter(new Pluralize);

        return $filter->filter($class);

    }

    /**
     * returns an array of field values for the model
     *
     * @param \MvcLite\ModelAbstract $model
     * @return array
     */
    public function getColumns(ModelAbstract $model)
    {
        $results = array();

        foreach ($model->getFields() as $column => $info) {
            $results[$column] = @$info['label'];
        }

        return $results;

    }

    /**
     * method to return a human friendly name for a model
     *
     * @param \MvcLite\ModelAbstract $model
     */
    public function getName(ModelAbstract $model)
    {
        $class = get_class($model);
        $filter = new FilterChain;
        $filter->addFilter(new ClassToCamelcase)
            ->addFilter(new CamelcaseToDash);

        //
        return ucwords(strtr($filter->filter($class), array(
            '-' => ' ',
        )));

    }

} // END class Lib_View_Helper_Model
