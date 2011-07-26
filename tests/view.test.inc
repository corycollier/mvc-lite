<?php
/**
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View
 * @since       File available since release 1.0.6
 */
/**
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View
 * @since       Class available since release 1.0.6
 */

class ViewTest
extends PHPUnit_Framework_TestCase
{
    
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_View::getInstance();
        
    } // END function setup
    
    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {
        
    } // END function tearDown

} // END class ModelTest
