<?php
/**
 * Exception message view helper
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\View\Helper;

use MvcLite\View\HelperAbstract as HelperAbstract;

/**
 * Exception message view helper
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View\Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Exception extends HelperAbstract
{
    /**
     * Returns a string representation of an expected exception
     *
     * @param Exception $exception
     * @return string
     */
    public function render($exception = null)
    {
        if (is_null($exception)) {
            return '';
        }

        return $exception->getMessage();
    }
}
