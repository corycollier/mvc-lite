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

class DispatcherTest extends TestCase
{

        // $this->loader = $loader;
        // $this->getConfig()->init($this->filepath(CONFIG_PATH . '/app.ini'));
        // $this->getRequest()->init();
        // $this->getDatabase()->init();
        // $this->getResponse()->init();

    /**
     * tests the init method of the lib dispatcher
     */
    public function testInit()
    {
        global $loader;

        $sut = $this->getMockBuilder('MvcLite\Dispatcher')
            ->disableOriginalConstructor()
            ->setMethods(['getConfig', 'getDatabase', 'getRequest', 'getResponse'])
            ->getMock();

        $config = $this->getMockBuilder('MvcLite\Config')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();
        $config->expects($this->once())->method('init');

        $database = $this->getMockBuilder('MvcLite\Database')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();
        $database->expects($this->once())->method('init');

        $request = $this->getMockBuilder('MvcLite\Request')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();
        $request->expects($this->once())->method('init');

        $response = $this->getMockBuilder('MvcLite\Response')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();
        $response->expects($this->once())->method('init');

        $sut->expects($this->once())
            ->method('getConfig')
            ->will($this->returnValue($config));

        $sut->expects($this->once())
            ->method('getDatabase')
            ->will($this->returnValue($database));

        $sut->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $sut->expects($this->once())
            ->method('getResponse')
            ->will($this->returnValue($response));

        $result = $sut->init($loader);
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
     *
     * @dataProvider provideDispatch
     */
    public function testDispatch($controller, $action, $params = [])
    {
        global $loader;

        $sut = $this->getMockBuilder('\MvcLite\Dispatcher')
            ->disableOriginalConstructor()
            ->setMethods(['translateControllerName', 'translateActionName', 'getRequest', 'getConfig'])
            ->getMock();

        $config = $this->getMockBuilder('\MvcLite\Config')
            ->disableOriginalConstructor()
            ->setMethods(['init'])
            ->getMock();

        $request = $this->getMockBuilder('\MvcLite\Request')
            ->disableOriginalConstructor()
            ->setMethods(['getParams'])
            ->getMock();

        $request->expects($this->once())
            ->method('getParams')
            ->will($this->returnValue($params));

        $sut->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $sut->expects($this->any())
            ->method('getConfig')
            ->will($this->returnValue($config));

        $sut->expects($this->once())
            ->method('translateControllerName')
            ->with($this->equalTo($params['controller']))
            ->will($this->returnValue($controller));

        $sut->expects($this->once())
            ->method('translateActionName')
            ->with($this->equalTo($params['action']))
            ->will($this->returnValue($action));

        $result = $sut->init($loader);

        $sut->dispatch();

        // $this->assertSame('error', $r equest->getParam('action'));
    }

    /**
     * Data provider for DispatcherTestCase::testDispatch.
     *
     * @return array An array of data to use for testing.
     */
    public function provideDispatch()
    {
        return [
            'simple params' => [
                'controller' => 'IndexController',
                'action'    => 'index',
                'params' => [
                    'controller' => 'index',
                    'action'    => 'index'
                ]
            ],
        ];
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
