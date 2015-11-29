<?php
/**
 * Unit tests for the Lib_Dispatcher class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the Lib_Dispatcher class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class DispatcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     * tests the init method of the lib dispatcher
     */
    public function testInit()
    {
        $sut = Dispatcher::getInstance();
        $result = $sut->init();
        $this->assertInstanceOf('MvcLite\Dispatcher', $result);
    }

    /**
     *
     * Enter description here ...
     */
    public function testGetInstance()
    {
        $sut = Dispatcher::getInstance();
        $this->assertInstanceOf('MvcLite\Dispatcher', $sut);
    }

    /**
     * tests the dispatch method of the dispatcher
     */
    public function testDispatch()
    {
        $sut = Dispatcher::getInstance();
        $request = Request::getInstance();
        $sut->dispatch();

        $this->assertSame('error', $request->getParam('controller'));
        $this->assertSame('error', $request->getParam('action'));
    }
}

// @codingStandardsIgnoreStart
// testing classes
namespace App;
class IndexController extends \MvcLite\Controller {}
class ErrorController extends \MvcLite\Controller{
    public function errorAction(){}
}
// @codingStandardsIgnoreEnd
