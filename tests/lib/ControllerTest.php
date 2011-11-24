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
extends PHPUnit_Framework_TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = new Lib_Controller;
        
    } // END function setup
    
    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {
        
    } // END function tearDown
    
    /**
     * Test the getter for the request object in the controller
     */
    public function test_getRequest ( )
    {
        $request = $this->fixture->getRequest();
        
        $this->assertInstanceOf('Lib_Request', $request);
        
    } // END function test_getRequest

    /**
     * Test the getter for the response object in the controller
     */
    public function test_getResponse ( )
    {
        $response = $this->fixture->getResponse();
        
        $this->assertInstanceOf('Lib_Response', $response);
        
    } // END function test_getResponse
    
    /**
     * Test the getter for the view object in the controller
     */
    public function test_getView ( )
    {
        $view = $this->fixture->getView();
        
        $this->assertInstanceOf('Lib_View', $view);
        
    } // END function test_getView
    
    /**
     * test the getter for the session object in the controller
     */
    public function test_getSession ( )
    {
        $session = $this->fixture->getSession();
        
        $this->assertInstanceOf('Lib_Session', $session);
        
    } // END function test_getSession
    
} // END class ControllerTest