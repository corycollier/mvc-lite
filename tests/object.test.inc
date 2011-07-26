<?php
/**
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Object
 * @since       File available since release 1.0.6
 */
/**
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Object
 * @since       Class available since release 1.0.6
 */

class ObjectTest
extends PHPUnit_Framework_TestCase
{
    
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = new Lib_Object;
        
    } // END function setup
    
    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {
        
    } // END function tearDown
    
    /**
     * Test the __get method on the Lib_Object
     */
    public function test_magicMethodGet ( )
    {
        $this->setExpectedException('Lib_Exception');
        
        $result = $this->fixture->varaible;
        
    } // END function test_magicMethodGet
    
    /**
     * Test the __set method on the Lib_Object
     */
    public function test_magicMethodSet ( )
    {
        $this->setExpectedException('Lib_Exception');
        
        $this->fixture->varaible = 'empty result';
        
    } // END function test_magicMethodSet
    
    /**
     * Test the __call method on the Lib_Object
     */
    public function test_magicMethodCall ( )
    {
        $this->setExpectedException('Lib_Exception');
        
        $result = $this->fixture->nonExistantMethod('var');
        
    } // END function test_magicMethodCall

} // END class ModelTest
