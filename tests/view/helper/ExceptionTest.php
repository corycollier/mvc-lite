<?php
/**
 * Unit tests for the Lib_View_Helper_Exception class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Tests\View\Helper;

use \MvcLite\View\Helper\Exception;

/**
 * Unit tests for the Lib_View_Helper_Exception class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class ViewHelperExceptionTest extends \MvcLite\TestCase
{
    /**
     * Tests the render method of the lib's exception view helper.
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
        ];
    }
}
