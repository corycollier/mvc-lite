<?php

class DispatcherTest
extends PHPUnit_Framework_TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        
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
        $dispatcher = Dispatcher::getInstance();
        
        $this->assertInstanceOf('Dispatcher', $dispatcher);
        
    } // END function test_getInstance
    
    public function test_dispatch ( )
    {
        $dispatcher = Dispatcher::getInstance();
        
        ob_start();
        $dispatcher->dispatch();
        $contents = ob_get_clean();
        
        $this->assertTrue(is_string($contents));
        $this->assertTrue(strlen($contents) > 0);
        
    } // END function test_dispatch
    
} // END class DispatcherTest