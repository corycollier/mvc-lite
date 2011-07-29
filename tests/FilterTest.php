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

class FilterTest
extends PHPUnit_Framework_TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {

    } // END function setup

    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {

    } // END function tearDown

    /**
     * tests the filter's ability to change dashes to camel case
     */
    public function test_dashToCamelCase ( )
    {
        $this->markTestIncomplete('not ready yet');

    } // END function test_dashToCamelCase

    public function test_camelCaseToDash ( )
    {
        $unfiltered = 'ThisIsSomethingElse';

        $expected = 'This-Is-Something-Else';

        $result = Lib_Filter::camelCaseToDash($unfiltered);

        $this->assertSame($expected, $result);

    } // END function test_camelCaseToDash

    public function test_underscoreToDirectorySeparator ( )
    {
        $this->markTestIncomplete('not ready yet');

    } // END function test_underscoreToDirectorySeparator

    public function test_underscoreToCamelCase ( )
    {
        $this->markTestIncomplete('not ready yet');

    } // END function test_underscoreToCamelCase
} // END class ModelTest
