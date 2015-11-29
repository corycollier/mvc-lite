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
    /**
     * holds the list of filters
     *
     * @var array
     */
    protected $filters = array();

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
     * Method to return a filter instance.
     *
     * @param string $filter
     *
     * @return FilterAbstract The filter instance (if found)
     *
     * @throws MvcLite\Exception If no filter is found, an exception is thrown.
     */
    public static function factory($filter)
    {   // iterate over the registered (haha) packages
        foreach (array('App', 'MvcLite') as $package) {
            try {
                $class = "\\{$package}\\Filter\\{$filter}";
                return new $class;
            }
            catch (MvcLite\Exception $exception) { }
        }
        // throw an exception if we get this far,
        throw new MvcLite\Exception("Requested filter [{$filter}] not found");
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
