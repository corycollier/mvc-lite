<?php
/**
 * @file dispatcher.test.inc
 * @package Tests
 * @subpackage Dispatcher
 * @category MVCLite
 */
/**
 * @package Tests
 * @subpackage Dispatcher
 * @category MVCLite 
 */

class DispatcherTest
extends PHPUnit_Framework_TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Dispatcher::getInstance();
        
    } // END function setUp
    
    /**
     * The tear down method, called after each test
     */
    public function tearDown ( )
    {
        
    } // END function tearDown
    
    /**
     * 
     * Enter description here ...
     */
    public function test_getInstance ( )
    {
        $this->assertInstanceOf('Lib_Dispatcher', $this->fixture);
        
    } // END function test_getInstance
    
    public function test_dispatch ( )
    {
        ob_start();
        $this->fixture->dispatch();
        $contents = ob_get_clean();
        
        $this->assertTrue(is_string($contents));
        $this->assertTrue(strlen($contents) > 0);
        
    } // END function test_dispatch
    
} // END class DispatcherTest