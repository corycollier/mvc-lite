<?php
/**
 * Select Input View Helper
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

use MvcLite\View\Helper\InputElementAbstract as InputElementAbstract;

/**
 * Select Input View Helper class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class InputSelect extends InputElementAbstract
{
    /**
     * Method to render a select element
     *
     * @param array $options
     * @param array $attribs
     * @return string
     */
    public function render($name, $attribs = [])
    {
        $options = $attribs['options'];
        unset($attribs['options']);

        $defaults = $this->getDefaultAttribs($name, 'select');
        $attribs  = array_merge($defaults, $attribs);
        $template = '<div class="form-group">'
            . '<label for="!id">!label</label>'
            . '<select!attribs>!options</select>'
            . '</div>';

        return strtr($template, [
            '!id'      => $attribs['id'],
            '!label'   => $attribs['label'],
            '!attribs' => $this->getHtmlAttribs($attribs),
            '!options' => $this->buildOptions($options),
        ]);
    }

    /**
     * method to take an array and turn it into a string of li elements
     *
     * @param array $options
     * @return string
     */
    protected function buildOptions($options = [])
    {
        $template = '<option value="!value">!label</option>';

        // iterate through the options, turning them into strings
        foreach ($options as $value => $label) {
            unset($options[$value]);
            $options[$label] = strtr($template, [
                '!value'    => $value,
                '!label'    => $label,
            ]);
        }

        // return the array imploded into a string by newline characters
        return implode(PHP_EOL, $options);
    }

    /**
     * Local override of the isValidAttribute method.
     *
     * @param string $name The name of the attribute.
     *
     * @return boolean True if valid, false if not.
     */
    protected function isValidAttribute($name)
    {
        $no = [
            'label'
        ];

        if (in_array($name, $no)) {
            return false;
        }
        return true;
    }
}
