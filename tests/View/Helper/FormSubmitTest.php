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
     * @dataProvider provideRender
     */
    public function testRender($attribs = [])
    {
        $helper = new \MvcLite\View\Helper\FormSubmit;
        $result = $helper->render($attribs);
        $this->assertSame(0, strpos($result, '<label for'));
        $this->assertTrue(strpos($result, '<input type="submit"') > 0);
    }

    /**
     * provides a dataset to use for testing the $helper->render() method
     *
     * @return array An array of data to use for testing.
     */
    public function provideRender()
    {
        return [
            'empty atttribs array test' => [
                'attribs' => [],
            ],

        ];
    }
}
