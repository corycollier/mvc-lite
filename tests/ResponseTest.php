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

    /**
     * test the setting of headers
     */
    public function test_setHeader ( )
    {
        $header = array(
            'Content-type' => 'text/plain',
        );

        $this->fixture->setHeader('Content-type', $header['Content-type']);

        $this->assertSame($header['Content-type'], $this->fixture->getHeader('Content-type'));

    } // END function test_setHeader

    /**
     * Function to provide arguments to tests
     */
    public function headerProvider ( )
    {
        return array(
            array(
                array(
                    'Content-type' => 'text/plain',
                    'X-Testing'     => 'testing value',
                )
            )
        );

    } // END function headerProvider

    /**
     * tests the get headers method of the response
     * @dataProvder headerProvider
     */
    public function test_getHeaders ($headers = array())
    {
        $result = $this->fixture->setHeaders($headers);

        $this->assertInstanceOf('Lib_Response', $result);

        $result = $this->fixture->getHeaders();

        print_r($result);

        foreach ($headers as $name => $value) {
            $this->assertSame($value, $result[$name]);
        }


    } // END function test_getHeaders

    /**
     * test the getting of headers
     */
    public function test_getHeader ( )
    {

    } // END function test_getHeader

} // END class ModelTest
