<?php
/**
 * @file loader.test.inc
 * @package Tests
 * @subpackage Loader
 * @category MVCLite
 */
/**
 * @package Tests
 * @subpackage Loader
 * @category MVCLite 
 */

class LoaderTest
extends PHPUnit_Framework_TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Loader::getInstance();
        
    } // END function setUp
    
    /**
     * The tear down method, called after each test
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
        $this->assertInstanceOf('Lib_Loader', $this->fixture);
        
    } // END function test_getInstance
    
    /**
     * test that the autoload method works
     */
    public function test_autoload ( )
    {
        $this->setExpectedException('Exception');
        $result = $this->fixture->autoload('NotGonnaFindThisClass');
        
        $this->assertFalse($result instanceOf Lib_Loader);
        
    } // END function test_autoload
    
} // END class LoaderTest