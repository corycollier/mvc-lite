<?php
/**
 * Unit tests for the MvcLite\Controller class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the MvcLite\Controller class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ControllerTest extends TestCase
{
    /**
     * Tests MvcLite\Controller::init().
     */
    public function testInit()
    {
        $sut = $this->getMockBuildeR('MvcLite\Controller')
            ->disableOriginalConstructor()
            ->setMethods(['getRequest', 'getView'])
            ->getMock();

        $view = $this->getMockBuilder('MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(['setLayout', 'addViewScriptPath', 'setScript'])
            ->getMock();

        $request = $this->getMockBuilder('MvcLite\Request')
            ->disableOriginalConstructor()
            ->setMethods(['isAjax'. 'getParam'])
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
}
