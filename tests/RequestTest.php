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

namespace MvcLite;

/**
 * Unit tests for the Lib_Request class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Request
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class RequestTest extends TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp()
    {
        $this->sut = Request::getInstance();
    }

    /**
     * Test the request object's build from string method
     */
    public function testBuildFromString()
    {
        $string = '/controller/action/param1/value1/param2/value2/param3';

        $result = $this->sut->buildFromString($string);

        $this->assertSame($result, [
            'controller'    => 'controller',
            'action'        => 'action',
            'param1'        => 'value1',
            'param2'        => 'value2',
            'param3'        => null,
        ]);
    }

    /**
     * test the request object's method for returning all params
     */
    public function testGetParams()
    {
        $params = [
            'var1'   => 'val1',
            'var2'   => 'val2',
            'var3'   => 'val3',
            'q'     => '/asdf/asdf/asdf/',
        ];

        $this->sut->setParams($params);

        $result = $this->sut->getParams();

        unset($params['q']);

        foreach ($params as $key => $value) {
            $this->assertSame($value, $result[$key]);
        }

        $this->assertFalse(array_key_exists('q', $result));

    }

    /**
     * test the request object's method for retrieving a single parameter
     */
    public function testGetParam()
    {
        $params = [
            'var1'   => 'val1',
            'var2'   => 'val2',
            'var3'   => 'val3',
        ];

        $this->sut->setParams($params);

        $this->assertSame($this->sut->getParam('var1'), $params['var1']);

    }

    /**
     * tests the request's ability to determine if a request is post
     */
    public function testIsPost()
    {
        $this->assertFalse($this->sut->isPost());

        $_POST = [
            'var'   => 'value'
        ];

        $this->assertTrue($this->sut->isPost());

    }

    /**
     * Tests the request class's ability to return the headers
     *
     * @param array $headers
     *
     * @dataProvider provideGetHeaders
     */
    public function testGetHeaders($headers = [])
    {
        $this->getReflectedProperty('\MvcLite\Request', 'headers')
            ->setValue($this->sut, $headers);

        $this->assertSame($headers, $this->sut->getHeaders());

    }

    /**
     * Provides data to use for testing the request objects ability to return
     * the headers it was given
     *
     * @return array
     */
    public function provideGetHeaders()
    {
        return [
            'simple test' => [
                'headers' => [
                    'Cache-Content' => false,
                    'X-Test'        => true,
                    'X-Identifier'  => 'asdfasdfasdf',
                ],
            ]
        ];
    }

    /**
     * tests the request instance's ability to determine if it's an ajax request
     */
    public function testIsAjax()
    {
        $this->assertFalse($this->sut->isAjax());

        $this->getReflectedProperty('\MvcLite\Request', 'headers')
            ->setValue($this->sut, [
                'X-Requested-With' => 'XMLHttpRequest'
            ]);

        $this->assertTrue($this->sut->isAjax());
    }
}
