<?php
/**
 * Unit tests for the Lib_View_Helper_FormSubmit class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\View\Helper;

/**
 * Unit tests for the Lib_View_Helper_FormSubmit class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperFormSubmitTest extends \MvcLite\TestCase
{
    /**
     * tests the $helper->render() method of Lib_View_Helper_FormSubmit
     *
     * @dataProvider provide_render
     */
    public function test_render ($attribs = array())
    {
        $helper = new FormSubmit;

        $result = $helper->render($attribs);

        $this->assertSame(0, strpos($result, '<label for'));

        $this->assertTrue(strpos($result, '<input type="submit"') > 0);

    }

    /**
     * provides a dataset to use for testing the $helper->render() method
     */
    public function provide_render ( )
    {
        return array(
            array(

            ),
        );

    }

} // END class Lib_View_Helper_FormSubmitTest
