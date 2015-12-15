<?php
/**
 * Underscore to dash filter test
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
use MvcLite\Filter\UnderscoreToDash as UnderscoreToDash;

/**
 * Underscore to dash filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterUnderscoreToDashTest extends TestCase
{
    /**
     * method to test the UnderscoreToDash filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new UnderscoreToDash;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the UnderscoreToDash filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['the unfiltered_word', 'the unfiltered-word'],
            ['_the unfiltered_word', '-the unfiltered-word'],
            ['_the 1 unfiltered_word', '-the 1 unfiltered-word'],
            ['_the 1 unfiltered_word_', '-the 1 unfiltered-word-'],
        ];
    }
}
