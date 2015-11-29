<?php
/**
 * Defines the base singleton type
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Object
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Object;

/**
 * Defines the base singleton type
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Object
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Singleton
    extends \MvcLite\ObjectAbstract
{
    /**
     * @var array
     */
    protected static $instances = array();

    /**
     * Privatizing the constructor, to enforce the singleton pattern.
     */
    protected function __construct()
    {

    }

    /**
     * Accessor method to get to the single instance of this class.
     *
     * @return \MvcLite\Object\Singleton
     */
    public static function getInstance()
    {
        $self = get_called_class();

        if (!isset($self::$instances[$self]) || ! $self::$instances[$self]) {
            $self::$instances[$self] = new $self;
        }

        return $self::$instances[$self];

    }

}
