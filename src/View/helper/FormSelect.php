<?php
/**
 * Select Input View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

/**
 * Select Input View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FormSelect extends \MvcLite\View\HelperAbstract
{
    /**
     * Method to render a select element
     *
     * @param array $options
     * @param array $attribs
     * @return string
     */
    public function render ($name, $options = [], $attribs = [])
    {
        $displayAttribs = array_merge($attribs, [
            'name'  => "display-only-{$name}",
            'class' => "display-only",
            'value' => @$attribs['displayValue'],
        ]);

        $template = implode(PHP_EOL, [
            '<label for="!id" class="form-select">',
            '<span class="label">!label</span>',
            '<select !attribs />',
            '!options',
            '</select>',
        ]);

        $attribs['name'] = $name;
        $attribs['id'] = $name;

        return strtr($template, array(
            '!id'               => $name,
            '!label'            => @$attribs['label'],
            '!attribs'          => $this->getHtmlAttribs($attribs),
            '!displayAttribs'   => $this->getHtmlAttribs($displayAttribs),
            '!options'          => $this->buildOptions($options),
        ));
    }

    /**
     * method to take an array and turn it into a string of li elements
     *
     * @param array $options
     * @return string
     */
    protected function buildOptions ($options = [])
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
}
