<?php
/**
 * Unit tests for the Lib_Controller class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the Lib_Controller class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ControllerTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the getter for the request object in the controller
     */
    public function testGetRequest ( )
    {
        $sut = new Controller;
        $request = $sut->getRequest();

        $this->assertInstanceOf('MvcLite\Request', $request);

    }

    /**
     * Test the getter for the response object in the controller
     */
    public function testGetResponse ( )
    {
        $sut = new Controller;
        $response = $sut->getResponse();

        $this->assertInstanceOf('MvcLite\Response', $response);

    }

    /**
     * Test the getter for the view object in the controller
     */
    public function testGetView ( )
    {
        $sut = new Controller;
        $view = $sut->getView();

        $this->assertInstanceOf('MvcLite\View', $view);

    }

    /**
     * test the getter for the session object in the controller
     */
    public function testGetSession ( )
    {
        $sut = new Controller;
        $session = $sut->getSession();

        $this->assertInstanceOf('\MvcLite\Session', $session);

    }

    /**
     * Tests MvcLite\Controller::init().
     */
    public function testInit()
    {
        $sut = $this->getMockBuildeR('MvcLite\Controller')
            ->disableOriginalConstructor()
            ->setMethods(array('getRequest', 'getView'))
            ->getMock();

        $view = $this->getMockBuilder('MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(array('setLayout', 'addViewScriptPath', 'setScript'))
            ->getMock();

        $request = $this->getMockBuilder('MvcLite\Request')
            ->disableOriginalConstructor()
            ->setMethods(array('isAjax'. 'getParam'))
            ->getMock();

        $sut->expects($this->once())
            ->method('getView')
            ->will($this->returnValue($view));

        $sut->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        // Test it out.
        $sut->init();
    }

} // END class ControllerTest
