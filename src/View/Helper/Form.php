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

use MvcLite\View\HelperAbstract as HelperAbstract;

/**
 * HTML Form View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Form extends HelperAbstract
{
    /**
     * renders a form from a model
     *
     * @param \MvcLite\ModelAbstract $model
     */
    public function render($fields, $attribs = [])
    {
        $template = '<form!attribs>!elements</form>';
        $elements = '';

        foreach ($fields as $column => $field) {
            if (!is_int($column)) {
                $elements .= $this->getGroupWrapper($this->elementFactory($column, $field));
                continue;
            }

            $group = '';
            foreach ($field as $name => $attribs) {
                $group .= $this->elementFactory($name, $attribs);
            }
            $elements .= $this->getGroupWrapper($group);
        }

        $elements .= $this->getView()
            ->getHelper('InputSubmit')
            ->render();

        return strtr($template, [
            '!attribs'  => $this->getHtmlAttribs($attribs),
            '!elements' => $elements,
        ]);
    }

    /**
     * Gets a wrapping string around an element(s) string.
     *
     * @param string $string The element markup.
     *
     * @return string The wrapped markup.
     */
    public function getGroupWrapper($string)
    {
        return sprintf('<div class="form-group">%s</div>', $string);
    }

    /**
     * method to return an input element from a given parameter array
     *
     * @param array $params
     */
    public function elementFactory($column, $params = [])
    {
        if (isset($params['primary'])) {
            return '';
        }

        $map = $this->getElementTypeMap();
        $helper = $map[$params['type']];
        $params['placeholder'] = $params['description'];

        if ($params['type'] == 'enum') {
            $params['options'] = array_combine($params['options'], $params['options']);
        }

        return $this->getView()
            ->getHelper($helper)
            ->render($column, $params);
    }

    /**
     * Gets the known element type map
     * @return array An associative array mapping field types, to form element types.
     */
    protected function getElementTypeMap()
    {
        $map = [
            'enum'     => 'InputSelect',
            'password' => 'InputPassword',
            'int'      => 'InputText',
            'text'     => 'InputTextarea',
            'varchar'  => 'InputText',
            'submit'   => 'InputSubmit',
            'checkbox' => 'InputCheckbox',
        ];

        return $map;
    }
}
