<?php
/**
 * Class to test the MvcLite\Cache object
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Class to test the MvcLite\Cache object
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class CacheTest extends TestCase
{
    /**
     * Tests the init method of the cache object.
     *
     * @dataProvider provideInit
     */
    public function testInit($config = [])
    {
        $sut = Cache::getInstance();
        $sut->init($config);

        $property = new \ReflectionProperty('\\MvcLite\\Cache', 'config');
        $property->setAccessible(true);
        $result = $property->getValue($sut);

        $this->assertSame($result, $config);
    }

    /**
     * Provider of data for the init method.
     *
     * @return array An array of data to use in testing the init method.
     */
    public function provideInit()
    {
        return [
            'with prefix' => [
                'config' => [
                    'prefix'    => 'cache',
                    'directory' => '/tmp',
                ]
            ],
            'without prefix' => [
                'config' => [
                    'prefix'    => '',
                    'directory' => '/tmp',
                ]
            ]
        ];
    }

    /**
     * Tests the getter of the cache object.
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     * @param string $expected
     *
     * @dataProvider provideGet
     */
    public function testGet(ObjectAbstract $object, $name, $expected)
    {
        $sut = $this->getMockBuilder('\MvcLite\Cache')
            ->disableOriginalConstructor()
            ->setMethods(['getCacheKey', 'getFilePath'])
            ->getMock();

        $sut->expects($this->any())
            ->method('getCacheKey')
            ->will($this->returnValue('cache-key'));

        $sut->expects($this->any())
            ->method('getFilePath')
            ->will($this->returnValue('/tmp/cache-key-test'));

        $sut->set($object, $name, $expected);
        $result = $sut->get($object, $name);
        $this->assertEquals($expected, $result);
    }

    /**
     * Returns data to use to test the get method of the lib cache object.
     *
     * @return array
     */
    public function provideGet()
    {
        $object = $this->getMockForAbstractClass('MvcLite\ObjectAbstract');
        return [
            [$object, 'variable1', [new \stdClass]],
            [$object, 'variable2', new \stdClass],
            [$object, 'variable3', '[new \stdClass]'],
        ];
    }

    /**
     * tests the setter of the cache object
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     * @param unknown_type $data
     * @dataProvider provideSet
     */
    public function testSet(ObjectAbstract $object, $name, $data = null)
    {
        $sut = Cache::getInstance();
    }

    /**
     * returns data to use to test the set method of the lib cache object
     *
     * @return array An array of data to use for testing.
     */
    public function provideSet()
    {
        $object = $this->getMockForAbstractClass('MvcLite\ObjectAbstract');
        return [
            [$object, 'variable1', [new \stdClass]],
            [$object, 'variable2', new \stdClass],
            [$object, 'variable3', '[new \stdClass]'],
        ];
    }

    /**
     * test the protected getCacheKey method of the Cache object
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     * @param string $expected
     *
     * @dataProvider provideGetCacheKey
     */
    public function testGetCacheKey(ObjectAbstract $object, $name, $expected)
    {
        $sut = Cache::getInstance();
        $method = new \ReflectionMethod('\\MvcLite\\Cache', 'getCacheKey');
        $method->setAccessible(true);
        $result = $method->invoke($sut, $object, $name);

        $this->assertSame($expected, $result);
    }

    /**
     * Data Provider for testGetCacheKey
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetCacheKey()
    {
        $object = $this->getMockForAbstractClass('MvcLite\ObjectAbstract');
        $prefix = strtolower(strtr(get_class($object), ['_' => '-']));
        return [
            'simple testing' => [
                'object'   => $object,
                'name'     => 'var',
                'expected' => '-' . $prefix . '-var'
            ]
        ];
    }
}
