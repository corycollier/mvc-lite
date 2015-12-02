<?php
/**
 * Unit tests for the camelcase to dash class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Filter;

/**
 * Unit tests for the camelcase to dash class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterCamelcaseToDashTest extends \MvcLite\TestCase
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
        $filter = new \MvcLite\Filter\CamelcaseToDash;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provider of data to test the camelcase-to-dash class's filter method
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
