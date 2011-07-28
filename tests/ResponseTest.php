<?php
/**
 * Unit tests for the Lib_Response class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Response
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Response class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Response
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ResponseTest
extends PHPUnit_Framework_TestCase
{
    
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Response::getInstance();
        
    } // END function setup
    
    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {
        
    } // END function tearDown

    /**
     * test the setting of the body
     */
    public function test_setBody ( )
    {
        $result = $this->fixture->setBody('');
    
        $this->assertInstanceOf('Lib_Response', $result);

    } // END function test_setBody

    /**
     * test getting the body of the response
     */
    public function test_getBody ( )
    {
        $result = $this->fixture->getBody();

        $this->assertSame('', $result);
        
    } // END function test_getBody

} // END class ModelTest
