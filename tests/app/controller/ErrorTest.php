<?php
/**
 * Test the error controller
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Test the error controller
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_App_Controller_ErrorTest
extends PHPUnit_Framework_TestCase
{
    /**
     * local implementation of the setUp hook
     */
    public function setUp ( )
    {
        $this->fixture = new App_Controller_Error;

    } // END function setUp

    /**
     * test some basics about the controller
     */
    public function test_basics ( )
    {
        // assert that the error controller extends the app controller
        $this->assertInstanceOf('App_Controller', $this->fixture);
        
    } // END function test_basics

    /**
     *
     *
     */
    public function test_errorAction ( )
    {
        $result = $this->fixture->errorAction();
        
    } // END function test_errorAction

} // END class Tests_App_Controller_ErrorTest