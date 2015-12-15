<?php
/**
 * Abstract Model
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Model
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Abstract Model
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Model
 * @since       Class available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
abstract class ModelAbstract extends ObjectAbstract
{
    /**
     * Gets an array representation of the model.
     *
     * @return array An array representation of the model
     */
    abstract public function toArray();

    /**
     * Getter for the fields in the model.
     *
     * @return array An array of fields tied to the model.
     */
    abstract public function getFields();
}
