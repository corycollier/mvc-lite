<?php
/**
 * Csv View Helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

/**
 * Csv View Helper class
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Csv extends \MvcLite\View\HelperAbstract
{
    /**
     * The render method for the csv view helper
     *
     * @param array $items
     */
    public function render ($items = [])
    {
        $return = '';
        $headers = array_keys((array)$items[0]);
        $return .= '"' . implode('", "', $headers) . '"';

        foreach ($items as $item) {
            $item = array_values((array)$item);
            $return .=  PHP_EOL . '"' . implode('", "', $item) . '"';
        }

        return $return;
    }
}
