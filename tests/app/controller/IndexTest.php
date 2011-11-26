<?php
/**
 * Test the index controller
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Test the index controller
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Controller
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_App_Controller_IndexTest
extends PHPUnit_Framework_TestCase
{
    /**
     * local implementation of the setUp hook
     */
    public function setUp ( )
    {
        $this->fixture = new App_Controller_Index;

    } // END function setUp

    /**
     * test some basics about the controller
     */
    public function test_basics ( )
    {
        // assert that the index controller extends the app controller
        $this->assertInstanceOf('App_Controller', $this->fixture);
        
    } // END function test_basics

} // END class Tests_App_Controller_IndexTest