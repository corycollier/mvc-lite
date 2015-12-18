<?php
/**
 * Unit tests for the MvcLite\Config class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Config
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the MvcLite\Config class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Config
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ConfigTest extends TestCase
{

    /**
     * Tests MvcLite\Config::init()
     *
     * @dataProvider provideInit
     */
    public function testInit($config, $exception = null)
    {
        $sut = $this->getMockBuilder('\MvcLite\Config')
            ->disableOriginalConstructor()
            ->setMethods(['setAll'])
            ->getMock();

        if ($exception) {
            $this->setExpectedException($exception);
        } else {
            $sut->expects($this->once())->method('setAll');
        }


        $sut->init($config);
    }

    /**
     * Data provider for testInit.
     *
     * @return array An array of data to use for testing.
     */
    public function provideInit()
    {
        return [
            'simple config, no exception' => [
                'config' => [],
            ],

            'invalid file location, expect exception' => [
                'config' => '/bad/file/path',
                'exception' => 'MvcLite\Exception',
            ],

            'valid file location, no exception' => [
                'config' => ROOT . '/tests/_file/testing.ini',
            ],
        ];
    }

    /**
     * Test the config's setter method
     *
     * @param string $key
     * @param mixed $value
     *
     * @dataProvider provideSet
     */
    public function testSet($key, $value)
    {
        $sut = Config::getInstance();
        $result = $sut->set($key, $value);
        $this->assertSame($sut, $result);

        $data = $this->getReflectedProperty('\MvcLite\Config', 'data')->getValue($sut);
        $result = $data[$key];
        $this->assertEquals($value, $result);
    }

    /**
     * Tests the config's get method.
     *
     * @param  string $key   The key to lookup
     * @param  mixed $value The value that should exist
     *
     * @dataProvider provideGet
     */
    public function testGet($expected, $key, $data)
    {
        $sut      = Config::getInstance();
        $property = $this->getReflectedProperty('\MvcLite\Config', 'data');
        $data     = $property->setValue($sut, $data);
        $result   = $sut->get($key);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data Provider for the testGet method.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGet()
    {
        return [
            'key exists, expect value' => [
                'expected' => 'value',
                'key'      => 'key',
                'data'     => [
                    'key' => 'value'
                ],
            ],
            'key does not exist, do notexpect value' => [
                'expected' => null,
                'key'      => 'key2',
                'data'     => [
                    'key' => 'value'
                ],
            ],
        ];
    }

    /**
     * Data provider for ConfigTest::testSet()
     *
     * @return array
     */
    public function provideSet()
    {
        // return an array of things to test
        return [
            [
                'key' => 'string',
                'value' => 'value1',
            ],
            [
                'key' => 'int',
                'value' => 1,
            ],
            [
                'key' => 'bool',
                'value' => false,
            ],
            [
                'key' => 'object',
                'value' => new \stdClass(),
            ],
            [
                'key' => 'array',
                'value' => range(0, 10),
            ],
        ];
    }

    /**
     * method to test the registry's ability to set multiple values at once
     *
     * @param array $params
     * @dataProvider provideSetAll
     */
    public function testSetAll($params)
    {
        $sut = $this->getMockBuilder('\MvcLite\Config')
            ->disableOriginalConstructor()
            ->setMethods(['set'])
            ->getMock();

        $sut->expects($this->exactly(count($params)))
            ->method('set');

        $sut->setAll($params);
    }

        // itereate through the built results, setting their values to registry
        // foreach ($params as $setting => $values) {
        //     $this->set($setting, $values);
        // }

        // return $this;

    /**
     * Data provider for ConfigTest::testSetAll().
     *
     * provides data to use for testing the registry's ability to set multiple
     * values with a single method call (setAll)
     *
     * @return array
     */
    public function provideSetAll()
    {
        return [
            'simple test' => [
                'params' => [
                    'test1' => [],
                    'test2' => [],
                    'test4' => [],
                ],
            ],
            'nested test' => [
                'params' => [
                    'test1' => [],
                    'test2' => [],
                    'test4' => [
                        'child' => ['value1', 'value2'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Tests MvcLite\Config::getSection.
     *
     * @dataProvider provideGetSection
     */
    public function testGetSection($expected, $name, $data)
    {
        $sut = \MvcLite\Config::getInstance();
        $sut->setAll($data);
        $result = $sut->getSection($name);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGetSection.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetSection()
    {
        return [
            'empty everything' => [
                'expected' => [],
                'name' => '',
                'data' => []
            ],

            'empty data' => [
                'expected' => [],
                'name' => 'app',
                'data' => []
            ],

            'empty expected' => [
                'expected' => [],
                'name' => 'app',
                'data' => [
                    'test.thing1' => 'test.value',
                    'test.thing2' => 'test.value',
                    'test.thing3' => 'test.value',
                ]
            ],

            'expectations' => [
                'expected' => ['app.name' => 'value'],
                'name' => 'app',
                'data' => [
                    'test.thing1' => 'test.value',
                    'test.thing2' => 'test.value',
                    'test.thing3' => 'test.value',
                    'app.name' => 'value'
                ]
            ],
        ];
    }
}
