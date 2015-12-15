<?php
/**
 * Dash to underscore filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Filter;
use MvcLite\TestCase as TestCase;
use MvcLite\Filter\DashToUnderscore as DashToUnderscore;

/**
 * Dash to underscore filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterDashToUnderscoreTest extends TestCase
{
    /**
     * method to test the DashToUnderscore filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new DashToUnderscore;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the DashToUnderscore filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['this-is-dashed', 'this_is_dashed'],
            ['this-_is-dashed', 'this__is_dashed'],
            ['this__is-dashed', 'this__is_dashed'],
            ['this__is-dashed_', 'this__is_dashed_'],
            ['this__is-dashed-_', 'this__is_dashed__'],
        ];
    }
}
