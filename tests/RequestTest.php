<?php
/**
 * Unit tests for the Lib_Request class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Request
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Request class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Request
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class RequestTest
extends PHPUnit_Framework_TestCase
{
    
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Request::getInstance();
        
    } // END function setup
    
    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {
        
    } // END function tearDown
    
    /**
     * Test the request object's build from string method
     */
    public function test_buildFromString ( )
    {
        $string = 'controller/action/param1/value1/param2/value2/param3';
        
        $result = $this->fixture->buildFromString($string);
        
        $this->assertSame($result, array(
            'controller'    => 'controller',
            'action'        => 'action',
            'param1'        => 'value1',
            'param2'        => 'value2',
            'param3'        => null,
        ));
        
    } // END function test_buildFromString
    
    /**
     * Test the getInstance method of the request object
     */
    public function test_getInstance ( )
    {
        $request = Lib_Request::getInstance();
        
        $this->assertInstanceOf('Lib_Request', $request);
        
    } // END function test_getInstance
    
    /**
     * test the request object's method for returning all params
     */
    public function test_getParams ( )
    {
        $params = array(
            'var1'   => 'val1',
            'var2'   => 'val2',
            'var3'   => 'val3',
        );
        
        $this->fixture->setParams($params);

        $result = $this->fixture->getParams();
        
        foreach ($params as $key => $value) {
            $this->assertSame($value, $result[$key]);
        }
        
    } // END function test_getParams
    
    /**
     * test the request object's method for retrieving a single parameter
     */
    public function test_getParam ( )
    {
        $params = array(
            'var1'   => 'val1',
            'var2'   => 'val2',
            'var3'   => 'val3',
        );
        
        $this->fixture->setParams($params);
        
        $this->assertSame($this->fixture->getParam('var1'), $params['var1']);
        
    } // END function test_getParam
    
    /**
     * tests the request's ability to determine if a request is post
     */
    public function test_isPost ( )
    {
        $this->assertFalse($this->fixture->isPost());

    } // END function test_isPost
} // END class ModelTest
