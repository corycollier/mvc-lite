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

class FilterStringToLowerTest
extends \MvcLite\TestCase
{
    /**
     *
     * method to test the StringToLower filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\StringToLower;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the StringToLower filter's ability to filter
     *
     * @return array
     */
    public function provideFilter()
    {
        return [
            ['Word', 'word'],
            ['Lion', 'lion'],
            ['tIer', 'tier'],
            ['The Dog', 'the dog'],
            ['123 SomethinG', '123 something'],
            ['wow AWeSoME', 'wow awesome'],
        ];
    }
}
