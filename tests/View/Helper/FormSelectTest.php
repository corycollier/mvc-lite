<?php
/**
 * Unit tests for the MvcLite\View\Helper\FormSelect class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\FormSelect;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\FormSelect class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperFormSelectTest extends TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\FormSelect
     *
     * @dataProvider provideRender
     */
    public function testRender($name, $attribs = [])
    {
        $helper = new \MvcLite\View\Helper\FormSelect;

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
