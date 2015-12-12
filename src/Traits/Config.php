<?php
/**
 * Config Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Traits;

/**
 * Config Trait.
 *
 * Allows a getter for the database instance.
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait Config
{

    /**
     * @var MvcLite\Config
     */
    protected $config;

    /**
     * Getter for the config.
     *
     * @return Config Returns the config instance.
     */
    public function getConfig()
    {
        if (!$this->config) {
            $this->config = \MvcLite\Config::getInstance();
        }
        return $this->config;
    }
}
