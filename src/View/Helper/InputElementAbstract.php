<?php
/**
 * Base Form Element Helper class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       File available since release 3.3.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

use MvcLite\View\HelperAbstract as HelperAbstract;

/**
 * Base Form Element Helper class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       Class available since release 3.3.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
abstract class InputElementAbstract extends HelperAbstract
{
    /**
     * Gets the default attributes.
     *
     * @param string $name The name of the element.
     *
     * @return string The resulting array of attributes.
     */
    public function getDefaultAttribs($name, $type)
    {
        $results = [
            'id'    => $name,
            'type'  => $type,
            'name'  => $name,
            'class' => 'form-control',
            'label' => ucwords($name),
        ];

        return $results;
    }

    /**
     * Standard template for form elements.
     *
     * This template works for all input[type=$type] elements.
     *
     * @return string The resulting html.
     */
    public function getStandardTemplate()
    {
        return '<label for="!id">!label</label><input!attribs />';
    }
}
