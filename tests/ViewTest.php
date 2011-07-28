<?php
/**
 * Unit tests for the Lib_View class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_View class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewTest
extends PHPUnit_Framework_TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_View::getInstance();

    } // END function setup

    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {

    } // END function tearDown

    /**
     * tests the filter method of the view object
     */
    public function test_filter ( )
    {
        $unfiltered = 'asdasdfads';

        $expected = 'asdasdfads';

        $result = $this->fixture->filter($unfiltered);

        $this->assertSame($expected, $result);

    } // END function test_filter


} // END class ModelTest
