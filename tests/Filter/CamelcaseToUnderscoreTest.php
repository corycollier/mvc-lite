<?php
/**
 * Unit tests for the camelcase to underscore class
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
use MvcLite\Filter\CamelcaseToUnderscore as CamelcaseToUnderscore;

/**
 * Unit tests for the camelcase to underscore class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterCamelcaseToUnderscoreTest extends TestCase
{
    /**
     * method to test the camelcase-to-dash class's filter method
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new CamelcaseToUnderscore;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provider of data to test the camelcase-to-dash class's filter method.
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            [
                'unfiltered' => 'somethingElse',
                'filtered'   => 'something_else',
            ],
            [
                'filtered'   => 'somethingelse',
                'unfiltered' => 'somethingelse',
            ],
            [
                'filtered'   => 'somethinGelse',
                'unfiltered' => 'somethin_gelse'
            ]
        ];
    }
}
