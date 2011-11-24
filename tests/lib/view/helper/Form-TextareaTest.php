<?php
/**
 * Unit tests for the Lib_View_Helper_FormTextarea class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_View_Helper_FormTextarea class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_View_Helper_FormTextareaTest
extends PHPUnit_Framework_TestCase
{
    /**
     * tests the $helper->render() method of Lib_View_Helper_FormTextarea
     *
     * @dataProvider provide_render
     */
    public function test_render ($name, $attribs = array())
    {
        $helper = new Lib_View_Helper_FormTextarea;

        $result = $helper->render($name, $attribs);

        $this->assertSame(0, strpos($result, '<label for'));

        $this->assertTrue(strpos($result, '<textarea type="text"') > 0);
        $this->assertTrue(strpos($result, " name=\"{$name}\"") > 0);
        $this->assertTrue(strpos($result, " id=\"{$name}\"") > 0);

    } // END function test_render

    /**
     * provides a dataset to use for testing the $helper->render() method
     */
    public function provide_render ( )
    {
        return array(
            array('passwd', array(
                'value'    => 'the password',
            )),
            array('passwd1', array(
                'value'    => 'the password',
            )),
            array('passwd2', array(
                'value'    => 'the password',
            )),
        );

    } // END function provide_render

} // END class Lib_View_Helper_FormTextareaTest