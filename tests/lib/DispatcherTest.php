<?php
/**
 * Unit tests for the Lib_Dispatcher class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Dispatcher class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Dispatcher
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_DispatcherTest
extends PHPUnit_Framework_TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = App_Dispatcher::getInstance();

    } // END function setUp

    /**
     * The tear down method, called after each test
     */
    public function tearDown ( )
    {

    } // END function tearDown

    /**
     * tests the init method of the lib dispatcher
     */
    public function test_init ( )
    {
        $this->setExpectedException('Lib_Exception');

        $dispatcher = Lib_Dispatcher::getInstance();

        $dispatcher->init();

    } // END function test_init

    /**
     * 
     * Enter description here ...
     */
    public function test_getInstance ( )
    {
        $this->assertInstanceOf('App_Dispatcher', $this->fixture);

    } // END function test_getInstance

    /**
     * tests the bootstrap method of the dispatcher
     */
    public function test_bootstrap ( )
    {
        $result = $this->fixture->bootstrap();

        $this->assertInstanceOf('App_Dispatcher', $result);

    } // END function test_bootstrap

    /**
     * tests the dispatch method of the dispatcher
     */
    public function test_dispatch ( )
    {
        ob_start();
        $this->fixture->init();
        $this->fixture->bootstrap();
        $this->fixture->dispatch();
        $contents = ob_get_clean();

        print_r($contents); return;

        $this->assertTrue(is_string($contents));
        $this->assertTrue(strlen($contents) > 0);

        $request = Lib_Request::getInstance();

        // test the exception handling of bogus controllers
        $request->setParam('controller', 'non-existant');
        ob_start();
        $this->fixture->dispatch();
        $contents = ob_get_clean();

        $this->assertSame('error', $request->getParam('controller'));

        // test the exception handling of bogus actions 
        $request->setParam('action', 'non-existant');
        ob_start();
        $this->fixture->dispatch();
        $contents = ob_get_clean();

        $this->assertSame('error', $request->getParam('action'));

    } // END function test_dispatch

} // END class DispatcherTest
