<?php
/**
 * Main Abstract Filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Main Abstract Filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

abstract class FilterAbstract
  extends ObjectAbstract
{
    /**
     * Method that *MUST* be defined by all children
     *
     * @param string $word
     */
    abstract function filter ($word = '');

} // END class Lib_Filter_Abstract
