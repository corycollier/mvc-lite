<?php
/**
 * class to camelcase filter test
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Filter;

/**
 * class to camelcase filter test
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterDashToUnderscoreTest
extends \MvcLite\TestCase
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
        $filter = new \MvcLite\Filter\DashToUnderscore;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the DashToUnderscore filter's ability to filter
     *
     * @return array
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
