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
}
