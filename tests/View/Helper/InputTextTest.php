<?php
/**
 * Unit tests for the MvcLite\View\Helper\InputText class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\InputText;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\InputText class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperInputTextTest extends \MvcLite\TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\InputText
     *
     * @dataProvider provideRender
     */
    public function testRender($expected, $name, $attribs = [])
    {
        $helper = new \MvcLite\View\Helper\InputText;
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
                'expected' => '<div class="form-group">'
                    . '<label for="passwd">Passwd</label>'
                    . '<input id="passwd" type="text" name="passwd" class="form-control" value="the value" />'
                    . '</div>',
                'name'    => 'passwd',
                'attribs' => [
                    'value' => 'the value',
                ],
            ],
        ];
    }
}
