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



    /**
     * test the setting and getting of variables to the view
     * @dataProvider provideVariables
     */
    public function test_setAndGet ($variables = array())
    {
        foreach ($variables as $name => $value) {
            $this->fixture->set($name, $value);
        }

        foreach ($variables as $name => $value) {
            $this->assertSame($this->fixture->get($name), $value);
        }

    } // END function test_setAndGet

    /**
     * method to provide data for test methods
     */
    public function provideVariables ( )
    {
        return array(
            array(
                array(
                    'var1'  => 'val1',
                    'var2'  => 'val2',
                    'var3'  => 'val3',
                ),

            )
        );

    } // END function provideVariables

} // END class ModelTest
