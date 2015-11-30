<?php
/**
 * Base Exception
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Exception
 * @since       File available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Base Exception
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Exception
 * @since       File available since release 1.0.5
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Exception
    extends \Exception
{
    /**
     * String message indicating that magic methods are bad, mmk?
     *
     * @var string
     */
    const ERR_MAGIC_METHOD
        = 'Magic Methods defeat the purpose of this framework >_<';

    const ERR_MAGIC_METHOD_GET
        = 'Cannot use __get in the MVCLite framework: !explain';

    const ERR_MAGIC_METHOD_SET
        = 'Cannot use __set in the MVCLite framework: !explain';

    const ERR_MAGIC_METHOD_CALL
        = 'Cannot use __call in the MVCLite framework: !explain';
}
