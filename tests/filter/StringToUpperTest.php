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

class FilterStringToUpperTest extends \MvcLite\TestCase
{
    /**
     *
     * method to test the StringToUpper filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\StringToUpper;

        $this->assertSame($expected, $filter->filter($unfiltered));
    }

    /**
     * provide data for testing the StringToUpper filter's ability to filter
     *
     * @return array
     */
    public function provide_filter ( )
    {
        return array(
            array('Word', 'WORD'),
            array('Lion', 'LION'),
            array('tIer', 'TIER'),
            array('The Dog', 'THE DOG'),
            array('123 SomethinG', '123 SOMETHING'),
            array('wow AWeSoME', 'WOW AWESOME'),
        );
    }
}
