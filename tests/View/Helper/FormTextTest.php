<?php
/**
 * Unit tests for the MvcLite\View\Helper\FormText class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\FormText;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\FormText class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperFormTextTest extends \MvcLite\TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\FormText
     *
     * @dataProvider provideRender
     */
    public function testRender($name, $attribs = [])
    {
        $helper = new \MvcLite\View\Helper\FormText;

        $result = $helper->render($name, $attribs);

        $this->assertSame(0, strpos($result, '<label for'));

        $this->assertTrue(strpos($result, '<input type="text"') > 0);
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
