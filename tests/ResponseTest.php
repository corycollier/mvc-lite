<?php
/**
 * Unit tests for the MvcLite\Response class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Response
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the MvcLite\Response class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Response
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ResponseTest extends TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp()
    {
        $this->sut = Response::getInstance();
    }

    /**
     * test the setting of the body
     */
    public function testSetBody()
    {
        $result = $this->sut->setBody('');

        $this->assertInstanceOf('\MvcLite\Response', $result);
    }

    /**
     * test getting the body of the response
     */
    public function testGetBody()
    {
        $result = $this->sut->getBody();
        $this->assertSame('', $result);
    }

    /**
     * test the setting of headers
     *
     * @param array $headers
     *
     * @dataProvider provideSetHeader
     */
    public function testSetHeader($headers = [])
    {
        $this->sut->setHeader($headers['name'], $headers['value']);
        $this->assertSame($headers['value'], $this->sut->getHeader($headers['name']));
    }

    /**
     * provider for the $helper->setHeader() method
     *
     * @return array
     */
    public function provideSetHeader()
    {
        return [
            'plain content headers' => [
                'headers' => [
                    'name' => 'Content-Type',
                    'value' => 'text/plain',
                ],
            ],
            'csv content headers' => [
                'headers' => [
                    'name' => 'Content-Type',
                    'value' => 'text/csv',
                ],
            ],
            'testing headers' => [
                'headers' => [
                    'name'  => 'X-Testing',
                    'value' => 'testing value',
                ],
            ],
        ];
    }


    /**
     * tests the get headers method of the response
     *
     * @param array $headers The array of headers to use for setting.
     *
     * @dataProvder provideGetHeaders
     */
    public function testGetHeaders($headers = [])
    {
        $result = $this->sut->setHeaders($headers);

        $this->assertInstanceOf('\MvcLite\Response', $result);

        $result = $this->sut->getHeaders();

        foreach ($headers as $name => $value) {
            $this->assertSame($value, $result[$name]);
        }
    }

    /**
     * Function to provide arguments to tests
     *
     * @return array
     */
    public function provideGetHeaders()
    {
        return [
            'simple content headers' => [
                'headers' => [
                    'Content-type' => 'text/plain',
                    'X-Testing'     => 'testing value',
                ]
            ],
        ];
    }

    /**
     * test the getting of headers
     */
    public function testGetHeader()
    {

    }

    /**
     * Tests the MvcLite\Response::setHeaders method
     *
     * @param array $headers
     * @covers MvcLite\Response::setHeaders
     * @dataProvider provideSetHeaders
     */
    public function testSetHeaders($headers)
    {
        $class = get_class($this->sut);

        $sut = $this->getMockBuilder('\MvcLite\Response')
            ->disableOriginalConstructor()
            ->setMethods(['setHeader'])
            ->getMock();

        $count = count($headers);

        $sut->expects($this->exactly($count))
            ->method('setHeader');

        // $sut->expects($this->once())
        //     ->method('setHeaders');

        $sut->setHeaders($headers);
    }

    /**
     * Provides data to use for testing the setHeaders method of the
     * MvcLite\Response::setHeaders method
     *
     * @return array
     */
    public function provideSetHeaders()
    {
        return [
            [
                'headers' => [
                    'var'   => 'val',
                ],
            ],
            [
                'headers' => [
                    'var1'   => 'val1',
                    'var2'   => 'val2',
                    'var3'   => 'val3',
                ],
            ],
        ];
    }

    /**
     * Tests MvcLite\Response::sendHeaders()
     *
     * @runInSeparateProcess
     * @dataProvider provideSendHeaders
     */
    public function testSendHeaders($headers = [])
    {
        $sut = $this->getMockBuilder('\MvcLite\Response')
            ->disableOriginalConstructor()
            ->setMethods(['getHeaders'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue($headers));

        $result = $sut->sendHeaders();
        $this->assertEquals($sut, $result);
    }

    /**
     * Data provider for testSendHeaders.
     *
     * @return array An array of data to use for testing.
     */
    public function provideSendHeaders()
    {
        return [
            'simple test' => [
                'headers' => [
                    'var1'   => 'val1',
                    'var2'   => 'val2',
                    'var3'   => 'val3',
                ]
            ],
        ];
    }

    /**
     * Tests MvcLite\Response::setContentType.
     *
     * @dataProvider provideSetContentType
     */
    public function testSetContentType($contentType, $exception = false)
    {
        $sut = $this->getMockBuilder('\MvcLite\Response')
            ->disableOriginalConstructor()
            ->setMethods(['setHeader'])
            ->getMock();

        if ($exception) {
            $this->setExpectedException('\MvcLite\Exception');
        } else {
            $sut->expects($this->once())
                ->method('setHeader')
                ->with(
                    $this->equalTo('Content-Type'),
                    $this->equalTo(
                        $contentType ? $contentType : \MvcLite\Response::DEFAULT_CONTENT_TYPE
                    )
                );
        }

        $result = $sut->setContentType($contentType);
        $this->assertEquals($sut, $result);
    }

    /**
     * Data provider for testSetContentType.
     *
     * @return array An array of data to use for testing.
     */
    public function provideSetContentType()
    {
        return [
            'No content type' => [
                'contentType' => '',
            ],

            'Good content type (application/json)' => [
                'contentType' => 'application/json',
            ],
            'Good content type (application/javascript)' => [
                'contentType' => 'application/javascript',
            ],
            'Good content type (text/html)' => [
                'contentType' => 'text/html',
            ],
            'Good content type (text/plain)' => [
                'contentType' => 'text/plain',
            ],
            'Good content type (text/csv)' => [
                'contentType' => 'text/csv',
            ],

            'Bad content type, expect exception' => [
                'contentType' => 'not-gonna-work',
                'exception' => true,
            ],
        ];
    }

    /**
     * Tests the MvcLite\Response::getContentType method.
     *
     * @dataProvider provideGetContentType
     */
    public function testGetContentType($expected, $header)
    {
        $sut = $this->getMockBuilder('\MvcLite\Response')
            ->disableOriginalConstructor()
            ->setMethods(['getHeader'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getHeader')
            ->with($this->equalTo('Content-Type'))
            ->will($this->returnValue($header));

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
            'has header, expect it' => [
                'expected' => 'expected value',
                'header'   => 'expected value',
            ],

            'does not have header, expect default' => [
                'expected' => \MvcLite\Response::DEFAULT_CONTENT_TYPE,
                'header'   => '',
            ],
        ];
    }
}
