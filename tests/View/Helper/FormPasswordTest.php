<?php
/**
 * Unit tests for the MvcLite\View\Helper\FormPassword class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\FormPassword;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\FormPassword class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperFormPasswordTest extends TestCase
{
    /**
     * Tests MvcLite\View\Helper\FormPassword::render().
     *
     * @param string $name The name of the element.
     * @param array $attribs An array of attributes to pass to the render method.
     *
     * @dataProvider provideRender
     */
    public function testRender($expected, $name, $attribs = [])
    {
        $sut = new \MvcLite\View\Helper\FormPassword;
        $result = $sut->render($name, $attribs);
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
                'expected' => '<div class="form-group"><label for="passwd"></label><input name="passwd" id="passwd" /></div>',
                'name'     => 'passwd',
                'attribs'  => [],
            ],
        ];
    }
}
