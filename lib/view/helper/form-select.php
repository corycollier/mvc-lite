<?php
/**
 * Select Input View Helper
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Select Input View Helper class
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View_Helper_FormSelect
extends Lib_View_Helper_Abstract
{
    /**
     * Method to render a select element
     *
     * @param array $options
     * @param array $attribs
     * @return string
     */
    public function render ($name, $options = array(), $attribs = array())
    {
        $displayAttribs = array_merge($attribs, array(
            'name'  => "display-only-{$name}",
            'class' => "display-only",
            'value' => @$attribs['displayValue'],
        ));

        $template = implode(PHP_EOL, array(
            '<label for="!id" class="form-select">',
            '<span class="label">!label</span>',
            '<select !attribs />',
            '!options',
            '</select>',
        ));

        $attribs['name'] = $name;
        $attribs['id'] = $name;

        return strtr($template, array(
            '!id'               => $name,
            '!label'            => @$attribs['label'],
            '!attribs'          => $this->_htmlAttribs($attribs),
            '!displayAttribs'   => $this->_htmlAttribs($displayAttribs),
            '!options'          => $this->_buildOptions($options),
        ));

    } // END function render

    /**
     * method to take an array and turn it into a string of li elements
     *
     * @param array $options
     * @return string
     */
    protected function _buildOptions ($options = array())
    {
        $template = '<option value="!value">!label</option>';

        // iterate through the options, turning them into strings
        foreach ($options as $value => $label) {
            unset($options[$value]);
            $options[$label] = strtr($template, array(
                '!value'    => $value,
                '!label'    => $label,
            ));
        }

        // return the array imploded into a string by newline characters
        return implode(PHP_EOL, $options);

    } // END function _buildOptions


} // END class Lib_View_Helper_FormSelect