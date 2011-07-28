<?php
/**
 * Unit tests for the Lib_Loader class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Loader
 * @since       File available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Loader class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Loader
 * @since       Class available since release 1.0.2
 * @author      Cory Collier <corycollier@corycollier.com>
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
        $this->setExpectedException('Lib_Exception');
        $result = $this->fixture->autoload('NotGonnaFindThisClass');

        $this->assertFalse($result instanceOf Lib_Loader);

    } // END function test_autoload

} // END class LoaderTest
