<?php
/**
 * Unit tests for the MvcLite\View\Helper\InputTextarea class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\InputTextarea;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\InputTextarea class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperInputTextareaTest extends TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\InputTextarea
     *
     * @dataProvider provideRender
     */
    public function testRender($expected, $name, $attribs = [])
    {
        $helper = new \MvcLite\View\Helper\InputTextarea;
        $result = $helper->render($name, $attribs);
        $this->assertEquals($expected, $result);
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
                'expected' => '<label for="passwd" class="form-text">Passwd</label>'
                    . '<textarea id="passwd" name="passwd" class="form-control">'
                    . 'the value'
                    . '</textarea>',
                'name'     => 'passwd',
                'attribs'  => [
                    'value' => 'the value',
                ],
            ],
        ];
    }
}
