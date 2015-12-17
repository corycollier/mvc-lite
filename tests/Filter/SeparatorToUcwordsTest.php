<?php
/**
 * Separator to upper case words filter test
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
use MvcLite\Filter\SeparatorToUcwords as SeparatorToUcwords;

/**
 * Separator to upper case words filter test
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterSeparatorToUcwordsTest extends TestCase
{
    /**
     * method to test the SeparatorToUcwords filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $separator, $expected)
    {
        $filter = new SeparatorToUcwords($separator);
        $result = $filter->filter($unfiltered);
        $this->assertSame($expected, $result);
    }

    /**
     * provide data for testing the SeparatorToUcwords filter's ability to filter
     *
     * @return array An array of data to use for testing the filter.
     */
    public function provideFilter()
    {
        return [
            ['word', '-', 'Word'],
            ['Lion', '-', 'Lion'],
            ['tIer', '-', 'TIer'],
            ['the dog', ' ', 'The Dog'],
            ['123/SomethinG', '/', '123/SomethinG'],
            ['wow_AWeSoME', '_', 'Wow_AWeSoME'],
        ];
    }
}
