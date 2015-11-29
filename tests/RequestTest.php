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

class Tests_Lib_RequestTest
extends PHPUnit_Framework_TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Request::getInstance();

    }

    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {

    }

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

    }

    /**
     * Test the getInstance method of the request object
     */
    public function test_getInstance ( )
    {
        $request = Lib_Request::getInstance();

        $this->assertInstanceOf('Lib_Request', $request);

    }

    /**
     * test the request object's method for returning all params
     */
    public function test_getParams ( )
    {
        $params = array(
            'var1'   => 'val1',
            'var2'   => 'val2',
            'var3'   => 'val3',
            'q'     => '/asdf/asdf/asdf/',
        );

        $this->fixture->setParams($params);

        $result = $this->fixture->getParams();

        unset($params['q']);

        foreach ($params as $key => $value) {
            $this->assertSame($value, $result[$key]);
        }

        $this->assertFalse(array_key_exists('q', $result));

    }

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

    }

    /**
     * tests the request's ability to determine if a request is post
     */
    public function test_isPost ( )
    {
        $this->assertFalse($this->fixture->isPost());

        $_POST = array(
            'var'   => 'value'
        );

        $this->assertTrue($this->fixture->isPost());

    }

    /**
     * Tests the request class's ability to return the headers
     *
     * @param array $headers
     * @dataProvider provide_getHeaders
     */
    public function test_getHeaders ($headers = array())
    {
        $property = new ReflectionProperty('Lib_Request', '_headers');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $headers);

        $this->assertSame($headers, $this->fixture->getHeaders());

    }

    /**
     * Provides data to use for testing the request objects ability to return
     * the headers it was given
     *
     * @return array
     */
    public function provide_getHeaders ( )
    {
        return array(
            array(array(
                'Cache-Content' => false,
                'X-Test'        => true,
                'X-Identifier'  => 'asdfasdfasdf',
            )),
            array(array(

            )),
        );

    }

    /**
     * tests the request instance's ability to determine if it's an ajax request
     */
    public function test_isAjax ( )
    {
        $this->assertFalse($this->fixture->isAjax());

        $property = new ReflectionProperty('Lib_Request', '_headers');
        $property->setAccessible(true);
        $property->setValue($this->fixture, array(
            'X-Requested-With' => 'XMLHttpRequest'
        ));

        $this->assertTrue($this->fixture->isAjax());


    }

}
