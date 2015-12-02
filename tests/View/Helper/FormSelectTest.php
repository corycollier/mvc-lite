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
     * @dataProvider provideRender
     */
    public function testRender($name, $attribs = [])
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
     *
     * @return array An array of data to use for testing.
     */
    public function provideRender()
    {
        return [
            [
                'name' => 'passwd',
                'attribs' => [],
            ],
        ];
    }
}
