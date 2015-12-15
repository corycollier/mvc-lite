<?php
/**
 * Unit tests for the camelcase to dash class
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
use MvcLite\Filter\CamelcaseToDash as CamelcaseToDash;

/**
 * Unit tests for the camelcase to dash class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterCamelcaseToDashTest extends TestCase
{
    /**
     * Test the camelcase-to-dash class's filter method
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new CamelcaseToDash;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * Data provider of data to test the camelcase-to-dash class's filter method.
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            [
                'unfiltered' => 'somethingElse',
                'filtered'   => 'something-else',
            ],
            [
                'unfiltered' => 'somethingelse',
                'filtered'   => 'somethingelse',
            ],
            [
                'unfiltered' => 'somethinGelse',
                'filtered'   => 'somethin-gelse',
            ]
        ];
    }
}
