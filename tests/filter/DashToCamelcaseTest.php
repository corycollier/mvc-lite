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

class FilterDashToCamelcaseTest
extends \MvcLite\TestCase
{
    /**
     *
     * method to test the DashToCamelcase filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\DashToCamelcase;

        $this->assertSame($expected, $filter->filter($unfiltered));

    }

    /**
     * provide data for testing the DashToCamelcase filter's ability to filter
     *
     * @return array
     */
    public function provide_filter ( )
    {
        return array(
            array('this-is-camel-case', 'thisIsCamelCase'),
            array('this-is-camelCase', 'thisIsCamelCase'),
            array('this_is-camelCase', 'this_isCamelCase'),
            array('this is-camelCase', 'this isCamelCase'),
            array('this. is-camelCase', 'this. isCamelCase'),
        );

    }

} // END class Tests_\MvcLite\Filter\DashToCamelcaseTest
