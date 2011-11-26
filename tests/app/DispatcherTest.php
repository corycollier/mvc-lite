<?php
/**
 * Tests the functionality of the App_Dispatcher
 *
 * This should test any application specific dispatching that's required
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Tests the functionality of the App_Dispatcher
 *
 * This should test any application specific dispatching that's required
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_App_DispatcherTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Local implementation of the setUp hook
     */
    public function setUp ( )
    {
        $this->fixture = App_Dispatcher::getInstance();

    } // END function setUp

    /**
     * Tests the application dispatcher's init method
     */
    public function test_init ( )
    {
        $this->fixture->init();

        $this->assertTrue((APPLICATION_ENV != ''));
        
    } // END function test_init

} // END class Tests_App_DispatcherTest