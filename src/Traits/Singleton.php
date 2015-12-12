<?php
/**
 * Singleton Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */


namespace MvcLite\Traits;

/**
 * Singleton Trait.
 *
 * Allows getting a single instance of self.
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait Singleton
{
    /**
     * Static instance variable
     * @var Singleton
     */
    protected static $instance;

    /**
     * Privatizing the constructor to protect the singleton pattern.
     */
    private function __construct()
    {

    }

    /**
     * Getter for the instance variable.
     *
     * @return Singleton
     */
    public static function getInstance()
    {
        $self = get_called_class();
        if (!$self::$instance) {
            $self::$instance = new $self;
        }
        return $self::$instance;
    }
}
