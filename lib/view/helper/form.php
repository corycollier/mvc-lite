<?php
/**
 * HTML Form View Helper
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * HTML Form View Helper class
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View_Helper_Form
extends Lib_View_Helper_Abstract
{
    /**
     * renders a form from a model
     *
     * @param App_Model $model
     */
    public function render (Lib_Model $model, $attribs = array())
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

    } // END function render

    /**
     * method to return an input element from a given parameter array
     *
     * @param array $params
     */
    public function elementFactory ($column, Lib_Model $model, $params = array())
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

    } // END function elementFactory

    /**
     * returns a form-select element for a given model
     *
     * @param Lib_Model $model
     * @param array $params
     * @return string
     */
    protected function _createReferenceElement ($column, Lib_Model $model, $params = array())
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

    } // END function _createReferenceElement

    /**
     * hook to return a select element representing an enum data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    public function _createEnumElement ($column, Lib_Model $model, $params = array())
    {
        return $this->_view->getHelper('FormSelect')
            ->render(
                $column,
                array_combine($params['options'], $params['options']),
                $params
            );

    } // END function _createEnumElement

    /**
     * hook to return a password element representing a password data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    public function _createPasswordElement ($column, Lib_Model $model, $params = array())
    {
        return $this->_view->getHelper('FormPassword')->render($column, $params);

    } // END function _createPasswordElement

    /**
     * hook to return a text element representing an integer data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function _createIntElement ($column, Lib_Model $model, $params = array())
    {
        return $this->_view->getHelper('FormText')->render($column, $params);

    } // END function _createIntElement

    /**
     * hook to return a textarea element representing a text data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function _createTextElement ($column, Lib_Model $model, $params = array())
    {
        return $this->_view->getHelper('FormTextarea')->render($column, $params);

    } // END function _createTextElement

    /**
     * hook to return a text element representing a varchar data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function _createVarcharElement ($column, Lib_Model $model, $params = array())
    {
        return $this->_view->getHelper('FormText')->render($column, $params);

    } // END function _createVarcharElement

} // END class App_View_Helper_Form