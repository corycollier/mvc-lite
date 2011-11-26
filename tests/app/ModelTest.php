<?php
/**
 * Class to test the application model's functionality
 *
 * As the application changes, the App_Model's functionality will likely change
 * as well. Any changes should be tested, and those tests belong here
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Class to test the application model's functionality
 *
 * As the application changes, the App_Model's functionality will likely change
 * as well. Any changes should be tested, and those tests belong here
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_App_ModelTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Local implementation of the setUp hook
     */
    public function setUp ( )
    {
        $this->fixture = new App_Model;
        
    } // END function setUp

    /**
     * test just the basics about the app model
     */
    public function test_basics ( )
    {
        // assert that the app model extends the lib model
        $this->assertInstanceOf('Lib_Model', $this->fixture);
        
    } // END function test_basics

} // END class Tests_App_ModelTest