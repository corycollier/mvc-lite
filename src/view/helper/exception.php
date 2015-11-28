<?php
/**
 * Exception message view helper
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
 * Exception message view helper
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Exception
    extends HelperAbstract
{
    /**
     * Returns a string representation of an expected exception
     *
     * @param Exception $exception
     * @return string
     */
    public function render ($exception = null)
    {
        if (! @$exception || !($exception instanceOf Exception)) {
            return '';
        }

        return $exception->getMessage();

    } // END function render

} // END class Lib_View_Helper_Exception
