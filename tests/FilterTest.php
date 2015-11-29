<?php
/**
 * Unit tests for the Lib_Filter class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Filter class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_FilterTest
extends PHPUnit_Framework_TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {

    }

    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {

    }

    /**
     * tests the filter's ability to change dashes to camel case
     *
     * @param string $expected
     * @param string $unfiltered
     * @dataProvider provide_dashToCamelCase
     */
    public function test_dashToCamelCase ($expected, $unfiltered)
    {
        $this->assertSame($expected, Lib_Filter::dashToCamelCase($unfiltered));

    }

    /**
     * provides data to use for testing the dashToCamelCase method
     *
     * @return array
     */
    public function provide_dashToCamelCase ( )
    {
        return array(
            array('thisShouldBeCamelCase', 'this-should-be-camel-case'),
            array('thisShouldBeCamel_case', 'this-should-be-camel_case'),
        );

    }

    public function test_camelCaseToDash ( )
    {
        $unfiltered = 'ThisIsSomethingElse';

        $expected = 'This-Is-Something-Else';

        $result = Lib_Filter::camelCaseToDash($unfiltered);

        $this->assertSame($expected, $result);

    }


    /**
     * tests the ucaseUnderscoreToPcaseDash method of the filter class
     */
    public function test_serverVarsToHeaderTypes ( )
    {
        $string = 'HTTP_VALUE_TESTING';

        $result = Lib_Filter::serverVarsToHeaderTypes($string);

        $expected = 'Value-Testing';

        $this->assertSame($result, $expected);

    }

} // END class ModelTest
