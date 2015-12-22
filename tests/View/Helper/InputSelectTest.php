<?php
/**
 * Unit tests for the MvcLite\View\Helper\InputSelect class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\InputSelect as InputSelect;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\InputSelect class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperInputSelectTest extends TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\InputSelect
     *
     * @dataProvider provideRender
     */
    public function testRender($expected, $name, $attribs = [])
    {
        $helper = new InputSelect;
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
        $template = '<label for="!id">!label</label>'
            . '<select !attribs>'
            . '!options'
            . '</select>';

        return [
            [
                'expected' => strtr($template, [
                    '!id' => 'stuff',
                    '!label' => 'Stuff',
                    '!attribs' => 'id="stuff" type="select" name="stuff" class="form-control"' ,
                    '!options' => '',
                ]),
                'name' => 'stuff',
                'attribs' => [
                    'options' => []
                ],
            ],
        ];
    }

    /**
     * Tests MvcLite\View\Helper\InputSelect
     *
     * @dataProvider provideBuildOptions
     */
    public function testBuildOptions($expected, $options = [])
    {
        $sut = new InputSelect;
        $method = $this->getReflectedMethod('\MvcLite\View\Helper\InputSelect', 'buildOptions');
        $result = $method->invoke($sut, $options);
        $this->assertEquals($expected, $result);

    }

    /**
     * Data Provider for testBuildOptions.
     *
     * @return array An array of data to use for testing.
     */
    public function provideBuildOptions()
    {
        return [
            'empty options' => [
                'expected' => '',
                'options' => [],
            ],

            'single option' => [
                'expected' => '<option value="value">label</option>',
                'options' => [
                    'value' => 'label',
                ]
            ]
        ];
    }
}
