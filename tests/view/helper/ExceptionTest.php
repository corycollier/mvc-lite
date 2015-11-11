<?php
/**
 * Unit tests for the Lib_View_Helper_Exception class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_View_Helper_Exception class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_View_Helper_ExceptionTest
extends PHPUnit_Framework_TestCase
{
    /**
     * tests the render method of the lib's exception view helper
     *
     * @dataProvider provide_render
     */
    public function test_render ($exception = null, $expected = '')
    {
        $helper = new Lib_View_Helper_Exception;

        $result = $helper->render($exception);

        $this->assertSame($expected, $result);

    } // END function test_render

    /**
     *
     * provides a list of data to use to test the $helper->render() method
     */
    public function provide_render ( )
    {
        return array(
            array(new Lib_Exception('testing'), 'testing'),
            array(new Exception('testing'), 'testing'),
            array(new ErrorException('testing'), 'testing'),
            array(0),
        );

    } // END function provide_render

} // END class Lib_View_Helper_ExceptionTest