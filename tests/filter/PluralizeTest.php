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

class FilterPluralizeTest
extends \MvcLite\TestCase
{
    /**
     *
     * method to test the Pluralize filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     *
     * @dataProvider provideFilter
     */
    public function testFilter($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\Pluralize;
        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the Pluralize filter's ability to filter
     *
     * @return array
     */
    public function provideFilter()
    {
        return [
            ['word', 'words'],
            ['lion', 'lions'],
            ['tiger', 'tigers'],
            ['dog', 'dogs'],
            ['horse', 'horses'],
            ['baby', 'babies'],
            ['story', 'stories'],
        ];
    }
}
