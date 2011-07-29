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
