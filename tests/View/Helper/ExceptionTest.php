<?php
/**
 * Unit tests for the MvcLite\View\Helper\Exception class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\Exception;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\Exception class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class ViewHelperExceptionTest extends TestCase
{
    /**
     * Tests the render method of the Exception view helper.
     *
     * @param string $expected The expected result.
     * @param \MvcLite\Exception $exception The exception instance.
     *
     * @dataProvider provideRender
     */
    public function testRender($expected = '', $exception = null)
    {
        $sut = new \MvcLite\View\Helper\Exception;
        $result = $sut->render($exception);
        $this->assertSame($expected, $result);
    }

    /**
     *
     * provides a list of data to use to test `the $helper->render() method
     *
     * @return array An array of data to use for testing.
     */
    public function provideRender()
    {
        return [
            'basic test' => [
                'expected' => 'testing',
                'exception' => new \MvcLite\Exception('testing'),
            ],

            'null exception' => [
                'expected' => '',
                'exception' => null,
            ],
        ];
    }
}
