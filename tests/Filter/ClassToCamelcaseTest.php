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

class FilterClassToCamelcaseTest extends \MvcLite\TestCase
{
    /**
     *
     * method to test the ClassToCamelcase filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\ClassToCamelcase;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the ClassToCamelcase filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['ClassToCamelcase', 'classToCamelcase'],
            ['classToCamelcase', 'classToCamelcase'],
            ['class-ToCamelcase', 'class-ToCamelcase'],
            ['class ToCamelcase', 'class ToCamelcase'],
            ['class ToCamelcase', 'class ToCamelcase'],
            ['class_ToCamelcase', 'toCamelcase'],
            ['class_To__Camelcase', 'camelcase'],
        ];
    }
}
