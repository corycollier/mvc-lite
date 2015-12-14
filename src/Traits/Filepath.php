<?php
/**
 * Filepath Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Traits;

/**
 * Filepath Trait.
 *
 * Allows a cross platform way to get filepaths
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait Filepath
{
    /**
     * Getter for the Request instance.
     *
     * @return MvcLite\Request The Request instance.
     */
    public function filepath($path)
    {
        if (!is_array($path)) {
            $path = explode('/', $path);
        }

        return implode(DIRECTORY_SEPARATOR, $path);
    }
}
