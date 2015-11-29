<?php
/**
 * Unit tests for the camelcase to dash class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the camelcase to dash class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_Filter_CamelcaseToDashTest
extends PHPUnit_Framework_TestCase
{
    /**
     * method to test the camelcase-to-dash class's filter method
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new Lib_Filter_CamelcaseToDash;

        $this->assertSame($expected, $filter->filter($unfiltered));

    }

    /**
     * provider of data to test the camelcase-to-dash class's filter method
     */
    public function provide_filter ( )
    {
        return array(
            array('somethingElse', 'something-else'),
            array('somethingelse', 'somethingelse'),
            array('somethinGelse', 'somethin-gelse'),
        );

    }

} // END class Tests_Lib_Filter_CamelcaseToDashTest
