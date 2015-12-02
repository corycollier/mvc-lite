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

namespace MvcLite\View\Helper;

/**
 * HTML Form View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Form extends \MvcLite\View\HelperAbstract
{
    /**
     * renders a form from a model
     *
     * @param \MvcLite\ModelAbstract $model
     */
    public function render($fields, $attribs = [])
    {
        $template = '<form!attribs><fieldset>!elements</fieldset></form>';
        $elements = '';

        foreach ($fields as $column => $field) {
            $elements .= $this->elementFactory($column, $field);
        }

        $elements .= $this->getView()
            ->getHelper('FormSubmit')
            ->render();

        return strtr($template, [
            '!attribs'  => $this->getHtmlAttribs($attribs),
            '!elements' => $elements,
        ]);
    }

    /**
     * method to return an input element from a given parameter array
     *
     * @param array $params
     */
    public function elementFactory($column, $params = [])
    {
        if (@$params['primary']) {
            return '';
        }

        $params['placeholder'] = $params['description'];

        $method = "create{$params['type']}Element";

        return call_user_func([$this, $method], $column, $params);
    }

    /**
     * hook to return a select element representing an enum data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    public function createEnumElement($column, $params = [])
    {
        $options = array_combine($params['options'], $params['options']);

        return $this->getView()
            ->getHelper('FormSelect')
            ->render($column, $options, $params);
    }

    /**
     * hook to return a password element representing a password data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    public function createPasswordElement($column, $params = [])
    {
        return $this->getView()
            ->getHelper('FormPassword')
            ->render($column, $params);
    }

    /**
     * hook to return a text element representing an integer data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function createIntElement($column, $params = [])
    {
        return $this->getView()
            ->getHelper('FormText')
            ->render($column, $params);
    }

    /**
     * hook to return a textarea element representing a text data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function createTextElement($column, $params = [])
    {
        return $this->getView()
            ->getHelper('FormTextarea')
            ->render($column, $params);
    }

    /**
     * hook to return a text element representing a varchar data input
     *
     * @param string $column
     * @param array $params
     * @return string
     */
    protected function createVarcharElement($column, $params = [])
    {
        return $this->getView()
            ->getHelper('FormText')
            ->render($column, $params);
    }

} // END class App_View_Helper_Form
