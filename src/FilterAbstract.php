<?php
/**
 * Main Abstract Filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Main Abstract Filter
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
abstract class FilterAbstract extends ObjectAbstract
{
    /**
     * Method that *MUST* be defined by all children
     *
     * @param string $word
     */
    abstract public function filter($word = '');
}
