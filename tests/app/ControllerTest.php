<?php
/**
 * Test the functionality of the application controller.
 * 
 * All applications should extend this test class as they extend the app
 * controller's functionality
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Test the functionality of the application controller.
 * 
 * All applications should extend this test class as they extend the app
 * controller's functionality
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_App_ControllerTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Local implementation of the setUp hook
     */
    public function setUp ( )
    {
        $this->fixture = new App_Controller;

    } // END function setUp

    /**
     * method to assert some basics about the app controller
     */
    public function test_basics ( )
    {
        // ensure that the app controller inherits the lib controller
        $this->assertInstanceOf('Lib_Controller', $this->fixture);

    } // END function test_basics

} // END class Tests_App_ControllerTest