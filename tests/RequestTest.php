<?php
/**
 * Unit tests for the MvcLite\Request class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the MvcLite\Request class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
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
     *
     * @dataProvider provideBuildFromString
     */
    public function testBuildFromString($expected, $string)
    {
        $result = $this->sut->buildFromString($string);
        $this->assertSame($expected, $result);
    }

    /**
     * Data Provider for testBuildFromString.
     *
     * @return array An array of data to use for testing.
     */
    public function provideBuildFromString()
    {
        return [
            'simple test' => [
                'expected' => [
                    'controller'    => 'controller',
                    'action'        => 'action',
                    'param1'        => 'value1',
                    'param2'        => 'value2',
                ],
                'string' => '/controller/action/param1/value1/param2/value2/param3',
            ],
            'tricky test' => [
                'expected' => [
                    'controller'    => 'controller',
                    'action'        => 'action',
                ],
                'string' => '/controller/action/controller/value1/action/value2',
            ],
        ];
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
     * Tests MvcLite\Request::setHeaders.
     *
     * @param  array $headers An array of headers to use for testing.
     *
     * @dataProvider provideSetHeaders
     */
    public function testSetHeaders($headers)
    {
        $sut = $this->getMockBuilder('\MvcLite\Request')
            ->disableOriginalConstructor()
            ->setMethods(['getFilterChain', 'setHeader'])
            ->getMock();

        $filterChain = $this->getMockBuilder('\MvcLite\FilterChain')
            ->disableOriginalConstructor()
            ->setMethods(['filter', 'addFilter'])
            ->getMock();

        $filterChain->expects($this->exactly(count($headers)))
            ->method('filter');

        $sut->expects($this->once())
            ->method('getFilterChain')
            ->will($this->returnValue($filterChain));

        $result = $sut->setHeaders($headers);
        $this->assertEquals($sut, $result);
    }

    /**
     * Data provider for testSetHeaders.
     *
     * @return array An array of data to use for testing.
     */
    public function provideSetHeaders()
    {
        return [
            'no http headers' => [
                'headers' => [],
            ],
            'one http headers' => [
                'headers' => [
                    'HTTP_VALUE' => 'something',
                ],
            ],
            'with content type' => [
                'headers' => [
                    'HTTP_VALUE' => 'something',
                    'CONTENT_TYPE' => 'text/html',
                ],
            ],
        ];
    }

    /**
     * Tests MvcLite\Request::setHeader.
     */
    public function testSetHeader()
    {
        $sut = \MvcLite\Request::getInstance();

        $result = $sut->setHeader('name', 'value');
        $this->assertEquals($sut, $result);
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

    /**
     * Tests MvcLite\Request::getUri.
     */
    public function testGetUri()
    {
        $expected = 'the expected value';
        $property = $this->getReflectedProperty('\MvcLite\Request', 'uri');
        $property->setValue($this->sut, $expected);
        $result = $this->sut->getUri();
        $this->assertEquals($expected, $result);
    }

    /**
     * Tests MvcLite\Request::getFormat.
     *
     * @param string $expected The expected return value.
     * @param string $contentType The contentType to use for testing the response.
     * @param boolean $exception if true, expect an exception.
     *
     * @dataProvider provideGetFormat
     */
    public function testGetFormat($expected, $contentType, $exception = false)
    {
        if ($exception) {
            $this->setExpectedException('\MvcLite\Exception');
        }

        $result = $this->sut->getFormat($contentType);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGetFormat.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetFormat()
    {
        return [
            'application/json' => [
                'expected'    => 'json',
                'contentType' => 'application/json',
            ],
            'application/javascript' => [
                'expected'    => 'json',
                'contentType' => 'application/json',
            ],
            'text/html' => [
                'expected'    => 'html',
                'contentType' => 'text/html',
            ],
            'text/plain' => [
                'expected'    => 'text',
                'contentType' => 'text/plain',
            ],
            'text/csv' => [
                'expected'    => 'csv',
                'contentType' => 'text/csv',
            ],
            'bad content type, expect exception' => [
                'expected'    => '',
                'contentType' => 'not/real',
                'exception'   => true,
            ]
        ];
    }

    /**
     * Tests MvcLite\Request::getContentType
     *
     * @dataProvider provideGetContentType
     */
    public function testGetContentType($expected, $headers = [])
    {
        $sut = \MvcLite\Request::getInstance();
        $sut->setHeaders($headers);
        $result = $sut->getContentType();
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGetContentType.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetContentType()
    {
        return [
            'has content type text/plain' => [
                'expected' => 'text/plain',
                'headers'  => [
                    'CONTENT_TYPE' => 'text/plain'
                ]
            ],

            'has no content type, but has accept headers' => [
                'expected' => 'text/plain',
                'headers'  => [
                    'HTTP_ACCEPT' => 'text/plain,text/html'
                ]
            ],

            'has nothing' => [
                'expected' => 'text/plain',
                'headers'  => []
            ],

        ];
    }
}
