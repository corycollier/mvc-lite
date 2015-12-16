<?php
/**
 * Filter Chain Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Traits;

/**
 * Filter Chain Trait.
 *
 * Allows for a simple interface to create a filter chain instance, and add
 * multiple new filters to that chain
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait FilterChain
{
    /**
     * Getter for the Request instance.
     *
     * @return MvcLite\Request The Request instance.
     */
    public function getFilterChain($filters = [])
    {
        $chain = new \MvcLite\FilterChain;
        foreach ($filters as $filter) {
            $class = '\MvcLite\Filter\\' . $filter;
            $chain->addFilter(new $class);
        }
        return $chain;
    }
}
