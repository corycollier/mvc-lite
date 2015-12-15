<?php
/**
 * Unit tests for the MvcLite\View\Helper\FormTextarea class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\FormTextarea;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\FormTextarea class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperFormTextareaTest extends TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\FormTextarea
     *
     * @dataProvider provideRender
     */
    public function testRender($name, $attribs = [])
    {
        $helper = new  \MvcLite\View\Helper\FormTextarea;

        $result = $helper->render($name, $attribs);

        $this->assertSame(0, strpos($result, '<label for'));

        $this->assertTrue(strpos($result, '<textarea type="text"') > 0);
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
                'name'    => 'passwd',
                'attribs' => [
                    'value' => 'the value',
                ],
            ],
        ];
    }
}
