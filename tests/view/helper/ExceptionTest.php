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
     * tests the render method of the lib's exception view helper
     *
     * @dataProvider provide_render
     */
    public function test_render ($exception = null, $expected = '')
    {
        $helper = new Exception;

        $result = $helper->render($exception);

        $this->assertSame($expected, $result);

    }

    /**
     *
     * provides a list of data to use to test the $helper->render() method
     */
    public function provide_render ( )
    {
        return array(
            // array(new Exception('testing'), 'testing'),
            array(new \Exception('testing'), 'testing'),
            array(new \ErrorException('testing'), 'testing'),
            array(0),
        );

    }

} // END class Lib_View_Helper_ExceptionTest
