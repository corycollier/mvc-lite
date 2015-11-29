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

class Tests_Lib_ResponseTest
extends PHPUnit_Framework_TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Response::getInstance();

    }

    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {

    }

    /**
     * test the setting of the body
     */
    public function test_setBody ( )
    {
        $result = $this->fixture->setBody('');

        $this->assertInstanceOf('Lib_Response', $result);

    }

    /**
     * test getting the body of the response
     */
    public function test_getBody ( )
    {
        $result = $this->fixture->getBody();

        $this->assertSame('', $result);

    }

    /**
     * test the setting of headers
     *
     * @param array $headers
     * @dataProvider provide_setHeader
     */
    public function test_setHeader ($headers = array())
    {
        $this->fixture->setHeader($headers['name'], $headers['value']);

        $this->assertSame($headers['value'], $this->fixture->getHeader($headers['name']));

    }

    /**
     * provider for the $helper->setHeader() method
     *
     * @return array
     */
    public function provide_setHeader ( )
    {
        return array(
            array(array(
                'name' => 'Content-Type',
                'value' => 'text/plain',
            )),
            array(array(
                'name' => 'Content-Type',
                'value' => 'text/csv',
            )),
            array(array(
                'name'  => 'X-Testing',
                'value' => 'testing value',
            )),
        );

    }

    /**
     * Function to provide arguments to tests
     *
     * @return array
     */
    public function headerProvider ( )
    {
        return array(
            array(array(
                'Content-type' => 'text/plain',
                'X-Testing'     => 'testing value',
            )),
        );

    }

    /**
     * tests the get headers method of the response
     * @dataProvder headerProvider
     */
    public function test_getHeaders ($headers = array())
    {
        $result = $this->fixture->setHeaders($headers);

        $this->assertInstanceOf('Lib_Response', $result);

        $result = $this->fixture->getHeaders();

        foreach ($headers as $name => $value) {
            $this->assertSame($value, $result[$name]);
        }


    }

    /**
     * test the getting of headers
     */
    public function test_getHeader ( )
    {

    }

    /**
     * Tests the Lib_Response::setHeaders method
     *
     * @param array $headers
     * @covers Lib_Response::setHeaders
     * @dataProvider provide_setHeaders
     */
    public function test_setHeaders ($headers)
    {
        $class = get_class($this->fixture);

        $method = new ReflectionMethod($class, '__construct');
        $method->setAccessible(true);

        $fixture = $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->setMethods(array(
                'setHeader',
            ))
            ->getMock();

        $count = count($headers);

        $fixture->expects($this->exactly($count))
            ->method('setHeader');

        // $fixture->expects($this->once())
        //     ->method('setHeaders');

        $fixture->setHeaders($headers);

    }

    /**
     * Provides data to use for testing the setHeaders method of the
     * Lib_Response::setHeaders method
     *
     * @return array
     */
    public function provide_setHeaders ( )
    {
        return array(
            array(array(
                'var'   => 'val',
            )),

            array(array(
                'var1'   => 'val1',
                'var2'   => 'val2',
                'var3'   => 'val3',
            )),

        );

    }
}
