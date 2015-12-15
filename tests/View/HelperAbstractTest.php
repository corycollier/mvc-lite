<?php
/**
 * Test Suite for the Abstract View Helper
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\Form;

/**
 * Test Suite for the Abstract View Helper
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperAbstractTest extends \MvcLite\TestCase
{
    /**
     * Tests MvcLite\View\HelperAbstract.
     *
     * @param  string $expected The expected result of the function call
     * @param  array  $attribs  An array of attributes
     *
     * @dataProvider provideGetHtmlAttribs
     */
    public function testGetHtmlAttribs($expected, $attribs = [])
    {
        $sut = $this->getMockForAbstractClass('\MvcLite\View\HelperAbstract');
        $method = $this->getReflectedMethod('\MvcLite\View\HelperAbstract', 'getHtmlAttribs');
        $result = $method->invoke($sut, $attribs);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGetHtmlAttribs.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetHtmlAttribs()
    {
        return [
            [
                'expected' => '',
                'attribs' => [],
            ]
        ];
    }

    /**
     * Tests MvcLite\View\HelperAbstract::getAcceptableAttribs.
     */
    public function testGetAcceptableAttribs()
    {
        $sut = $this->getMockForAbstractClass('\MvcLite\View\HelperAbstract');
        $expected = [
            'name',
            'id',
            'placeholder',
            'class',
            'value',
            'href',
            'rel',
            'action',
            'method',
        ];

        $result = $sut->getAcceptableAttribs();
        $this->assertEquals($expected, $result);
    }
}

    // protected function getHtmlAttribs($attribs = [])
    // {
    //     // a list of acceptable html attributes
    //     $whiteListAttribs = [
    //         'name',
    //         'id',
    //         'placeholder',
    //         'class',
    //         'value',
    //         'href',
    //         'rel',
    //         'action',
    //         'method',
    //     ];

    //     // iterate over the attribs provided
    //     foreach ($attribs as $key => $value) {
    //         unset($attribs[$key]);
    //         if (in_array($key, $whiteListAttribs)) {
    //             $attribs[] = "{$key}=\"{$value}\"";
    //         }
    //     }

    //     if (!count($attribs)) {
    //         return '';
    //     }

    //     // return the pairs, imploded by a single space
    //     return ' ' . implode(' ', $attribs);
    // }
