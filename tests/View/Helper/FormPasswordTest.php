<?php
/**
 * Unit tests for the Lib_View_Helper_FormPassword class
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
 * Unit tests for the Lib_View_Helper_FormPassword class
 *
 * @category    PHP
 * @package     MVCLite
 * @subpackage  View\Helper
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperFormPasswordTest extends \MvcLite\TestCase
{
    /**
     * Tests MvcLite\View\Helper\FormPassword::render().
     *
     * @param string $name The name of the element.
     * @param array $attribs An array of attributes to pass to the render method.
     *
     * @dataProvider provideRender
     */
    public function testRender($name, $attribs = [])
    {
        $sut = $this->getMockBuilder('\MvcLite\View\Helper\FormPassword')
            ->disableOriginalConstructor()
            ->setMethods(['getHtmlAttribs'])
            ->getMock();

        $result = $sut->render($name, $attribs);
        $this->assertSame(0, strpos($result, '<label for'));
        $this->assertTrue(strpos($result, '<input type="password"') > 0);
    }

    /**
     * provides a dataset to use for testing the $helper->render() method
     *
     * @return array An array of data to use for testing.
     */
    public function provideRender()
    {
        return [
            [
                'name'    => 'passwd',
                'attribs' => [],
            ],
        ];
    }
}
