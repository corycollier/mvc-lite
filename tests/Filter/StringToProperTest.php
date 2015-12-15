<?php
/**
 * String to Propert filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Filter;
use MvcLite\TestCase as TestCase;
use \MvcLite\Filter\StringToProper as StringToProper;

/**
 * String to Propert filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterStringToProperTest extends TestCase
{
    /**
     *
     * method to test the StringToProper filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new StringToProper;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the StringToProper filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['word', 'Word'],
            ['lion', 'Lion'],
            ['tIer', 'TIer'],
            ['The Dog', 'The Dog'],
            ['123 SomethinG', '123 SomethinG'],
            ['wow AWeSoME', 'Wow AWeSoME'],
        ];
    }
}
