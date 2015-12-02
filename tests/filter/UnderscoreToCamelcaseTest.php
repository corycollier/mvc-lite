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

class FilterUnderscoreToCamelcaseTest
extends \MvcLite\TestCase
{
    /**
     *
     * method to test the UnderscoreToCamelcase filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\UnderscoreToCamelcase;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the UnderscoreToCamelcase filter's ability to filter
     *
     * @return array
     */
    public function provideFilter()
    {
        return [
            ['the unfiltered_word', 'the unfilteredWord'],
            ['the_unfiltered_word', 'theUnfilteredWord'],
            ['the-unfiltered_word', 'the-unfilteredWord'],
            ['the-unfiltered_word_', 'the-unfilteredWord'],
            ['_the-unfiltered_word_', 'The-unfilteredWord'],
        ];
    }
}
