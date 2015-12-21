<?php
/**
 * Unit tests for the MvcLite\View\Helper\InputSubmit class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\InputSubmit;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\InputSubmit class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperInputSubmitTest extends TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\InputSubmit
     *
     * @dataProvider provideRender
     */
    public function testRender($expected, $attribs = [])
    {
        $helper = new \MvcLite\View\Helper\InputSubmit;
        $result = $helper->render($attribs);
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
            'empty atttribs array test' => [
                'expected' => '<input type="submit" value="Submit" class="btn btn-default">',
                'attribs' => [],
            ],

        ];
    }
}
