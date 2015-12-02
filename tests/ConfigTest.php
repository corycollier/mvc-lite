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
     * Test the registry's setter and getter method
     *
     * @param string $key
     * @param mixed $value
     * @dataProvider provideSetAndGet
     */
    public function testSetAndGet($key, $value)
    {
        $sut = Config::getInstance();
        $sut->set($key, $value);

        $this->assertSame($sut->get($key), $value);
    }

    /**
     * Data provider for ConfigTest::testSetAndGet()
     *
     * @return array
     */
    public function provideSetAndGet()
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
        $this->markTestIncomplete('still working on this one');
    }

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
        ];
    }
}
