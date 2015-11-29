<?php
/**
 * HTML Form View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace \MvcLite\View\Helper;

use \MvcLite\View;

/**
 * HTML Form View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Form
    extends HelperAbstract
{
    /**
     * renders a form from a model
     *
     * @param \MvcLite\ModelAbstract $model
     */
    public function render(ModelAbstract $model, $attribs = array())
    {
        $template = '<form !attribs><fieldset>!elements</fieldset></form>';
        $elements = '';

        foreach ($model->getFields() as $column => $field) {
            $elements .= $this->elementFactory($column, $model, $field);
        }

        $elements .= $this->_view->getHelper('FormSubmit')->render();

        return strtr($template, array(
            '!attribs'  => $this->_htmlAttribs($attribs),
            '!elements' => $elements,
        ));

    }

    /**
     * method to return an input element from a given parameter array
     *
     * @param array $params
     */
    public function elementFactory ($column, ModelAbstract $model, $params = array())
    {
        if (@$params['primary']) {
            return '';
        }

        $params['placeholder'] = $params['description'];
        $params['value'] = $model->get($column);

        if (@$params['reference']) {
            return $this->_createReferenceElement($column, $model, $params);
        }

        $method = "_create{$params['type']}Element";

        return call_user_func(array($this, $method), $column, $model, $params);

    }

    /**
     * returns a form-select element for a given model
     *
     * @param \MvcLite\ModelAbstract $model
     * @param array $params
     * @return string
     */
    protected function _createReferenceElement ($column, ModelAbstract $model, $params = array())
    {
        $class = $params['reference']['model'];
        $referenceModel = new $class;
        $referenceModel->find();
        $options = array();
        foreach ($referenceModel->getData() as $object) {
            $id = $object->id;
            $object = new $class($object);
            $options[$id] = (string)$object;
            if ($id == $model->get($column)) {
                $params['value'] = $id;
                $params['displayValue'] = (string)$object;
            }
        }
        return $this->_view->getHelper('FormSelect')->render($column, $options, $params);

    }

    /**
     * hook to return a select element representing an enum data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    public function _createEnumElement ($column, ModelAbstract $model, $params = array())
    {
        return $this->_view->getHelper('FormSelect')
            ->render(
                $column,
                array_combine($params['options'], $params['options']),
                $params
            );

    }

    /**
     * hook to return a password element representing a password data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    public function _createPasswordElement ($column, ModelAbstract $model, $params = array())
    {
        return $this->_view->getHelper('FormPassword')->render($column, $params);

    }

    /**
     * hook to return a text element representing an integer data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function _createIntElement ($column, ModelAbstract $model, $params = array())
    {
        return $this->_view->getHelper('FormText')->render($column, $params);

    }

    /**
     * hook to return a textarea element representing a text data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function _createTextElement ($column, ModelAbstract $model, $params = array())
    {
        return $this->_view->getHelper('FormTextarea')->render($column, $params);

    }

    /**
     * hook to return a text element representing a varchar data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function _createVarcharElement ($column, ModelAbstract $model, $params = array())
    {
        return $this->_view->getHelper('FormText')->render($column, $params);

    }

} // END class App_View_Helper_Form
