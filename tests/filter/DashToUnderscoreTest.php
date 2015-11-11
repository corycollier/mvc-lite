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
/**
 * class to camelcase filter test
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_Filter_DashToUnderscoreTest
extends PHPUnit_Framework_TestCase
{
    /**
     *
     * method to test the DashToUnderscore filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new Lib_Filter_DashToUnderscore;

        $this->assertSame($expected, $filter->filter($unfiltered));

    } // END function test_filter

    /**
     * provide data for testing the DashToUnderscore filter's ability to filter
     *
     * @return array
     */
    public function provide_filter ( )
    {
        return array(
            array('this-is-dashed', 'this_is_dashed'),
            array('this-_is-dashed', 'this__is_dashed'),
            array('this__is-dashed', 'this__is_dashed'),
            array('this__is-dashed_', 'this__is_dashed_'),
            array('this__is-dashed-_', 'this__is_dashed__'),
        );

    } // END function provide_filter

} // END class Tests_Lib_Filter_DashToUnderscoreTest