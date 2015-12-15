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
    public function testRender($expected, $name, $attribs = [])
    {
        $helper = new \MvcLite\View\Helper\FormSelect;
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
        $template = implode(PHP_EOL, [
            '<label for="!id" class="form-select">',
            '<span class="label">!label</span>',
            '<select !attribs />',
            '!options',
            '</select>',
        ]);

        return [
            [
                'expected' => strtr($template, [
                    '!id' => 'stuff',
                    '!label' => '',
                    '!attribs' => ' name="stuff" id="stuff"' ,
                    '!options' => '',
                ]),
                'name' => 'stuff',
                'attribs' => [
                    'options' => []
                ],
            ],
        ];
    }
}
