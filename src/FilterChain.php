<?php
/**
 * Base Filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Base Filter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Filter
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FilterChain extends ObjectAbstract
{
    const MSG_ERR_FILTER_NOT_FOUND = "Requested filter [%s] not found";

    /**
     * holds the list of filters
     *
     * @var array
     */
    protected $filters = [];

    /**
     * adds a filter to the chain
     *
     * @param \MvcLite\FilterAbstract $filter
     */
    public function addFilter(FilterAbstract $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * filters a chain
     *
     * @param string $word
     */
    public function filter($word = '')
    {
        // iterate through the filters, triming the word as defined
        foreach ($this->filters as $filter) {
            $word = $filter->filter($word);
        }

        return $word;
    }
}
