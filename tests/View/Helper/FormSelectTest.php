<?php
/**
 * Unit tests for the Lib_View_Helper_FormSelect class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the Lib_View_Helper_FormSelect class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperFormSelectTest extends \MvcLite\TestCase
{
    /**
     * tests the $helper->render() method of Lib_View_Helper_FormSelect
     *
     * @dataProvider provide_render
     */
    public function test_render ($name, $attribs = array())
    {
        $helper = new  \MvcLite\View\Helper\FormSelect;

        $result = $helper->render($name, $attribs);

        $this->assertSame(0, strpos($result, '<label for'));
        $this->assertTrue(strpos($result, '<select ') > 0);
        $this->assertTrue(strpos($result, " name=\"{$name}\"") > 0);
        $this->assertTrue(strpos($result, " id=\"{$name}\"") > 0);

    }

    /**
     * provides a dataset to use for testing the $helper->render() method
     */
    public function provide_render ( )
    {
        return array(
            array('passwd', array(

            )),
            array('passwd1', array(

            )),
            array('passwd2', array(

            )),
        );

    }

} // END class Lib_View_Helper_FormSelectTest
