<?php
/**
 * Database Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Traits;

/**
 * Database Trait.
 *
 * Allows a getter for the database instance.
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait Database
{

    /**
     * @var MvcLite\Database
     */
    protected $database;

    /**
     * Getter for the database.
     *
     * @return Database Returns the database instance.
     */
    public function getDatabase()
    {
        if (!$this->database) {
            $this->database = \MvcLite\Database::getInstance();
        }
        return $this->database;
    }
}
