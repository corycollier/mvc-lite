<?php

class LoaderTest
extends PHPUnit_Framework_TestCase
{
    /**
     * 
     * Enter description here ...
     */
    public function setUp ( )
    {
        
    } // END function setUp
    
    /**
     * 
     * Enter description here ...
     */
    public function tearDown ( )
    {
        
    } // END function tearDown
    
    /**
     * 
     * Test that the getInstance method works
     */
    public function test_getInstance ( )
    {
        $loader = Loader::getInstance();
        
        $this->assertInstanceOf('Loader', $loader);
        
    } // END function test_getInstance
    
    /**
     * 
     * test that the autoload method works
     */
    public function test_autoload ( )
    {
        $loader = Loader::getInstance();
        
        $this->setExpectedException('Exception');
        $result = $loader->autoload('NotGonnaFindThisClass');
        
        $this->assertFalse($result instanceOf Loader);
        
    } // END function test_autoload
    
    
} // END class LoaderTest