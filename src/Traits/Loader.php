<?php
/**
 * Loader Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Traits;

/**
 * Loader Trait.
 *
 * Allows a getter for the loader instance.
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait Loader
{
    /**
     * Loader instance variable.
     *
     * @var \Composer\Autoload\ClassLoader
     */
    protected $loader;

    /**
     * Getter for the Loader instance.
     *
     * @return \Composer\Autoload\ClassLoader The Request instance.
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Setter for the Loader instance.
     *
     * @param \Composer\Autoload\ClassLoader $loader The Loader instance
     * @return MvcLite\Traits\Loader Returns $this, for object chaining.
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
        return $this;
    }
}
