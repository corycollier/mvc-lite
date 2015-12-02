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
     * tests the $helper->render() method of Lib_View_Helper_FormPassword
     *
     * @dataProvider provideRender
     */
    public function testRender ($name, $attribs = [])
    {
        $helper = new  \MvcLite\View\Helper\FormPassword;

        $result = $helper->render($name, $attribs);

        $this->assertSame(0, strpos($result, '<label for'));

        $this->assertTrue(strpos($result, '<input type="password"') > 0);
        $this->assertTrue(strpos($result, " name=\"{$name}\"") > 0);
        $this->assertTrue(strpos($result, " id=\"{$name}\"") > 0);

    }

    /**
     * provides a dataset to use for testing the $helper->render() method
     *
     * @return array An array of data to use for testing.
     */
    public function provideRender ( )
    {
        return [
            [
                'name' => 'passwd',
                'attribs' => [],
            ],
            [
                'name' => 'passwd1',
                'attribs' => [],
            ],
            [
                'name' => 'passwd2',
                'attribs' => [],
            ]
        ];
    }
}
