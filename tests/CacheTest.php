<?php
/**
 * Class to test the Lib_Cache object
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Class to test the Lib_Cache object
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class CacheTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the init method of the cache object.
     *
     * @dataProvider provideInit
     */
    public function testInit ($config = array())
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
    public function provideInit ( )
    {
        return array(
            array(array(
                'prefix'    => 'cache',
                'directory' => '/tmp',
            )),
            array(array(
                'prefix'    => '',
                'directory' => '/tmp',
            )),
        );

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
    public function testGet (ObjectAbstract $object, $name, $expected)
    {
        $sut = Cache::getInstance();
        $sut->set($object, $name, $expected);
        $result = $sut->get($object, $name);
        $this->assertEquals($expected, $result);

    }

    /**
     * Returns data to use to test the get method of the lib cache object.
     *
     * @return array
     */
    public function provideGet ( )
    {
        $object = $this->getMockForAbstractClass('MvcLite\ObjectAbstract');
        return array(
            array($object, 'variable1', array(new \stdClass)),
            array($object, 'variable2', new \stdClass),
            array($object, 'variable3', 'array(new \stdClass)'),
        );

    }

    /**
     * tests the setter of the cache object
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     * @param unknown_type $data
     * @dataProvider provideSet
     */
    public function testSet (ObjectAbstract $object, $name, $data = null)
    {
        $sut = Cache::getInstance();

    }

    /**
     * returns data to use to test the set method of the lib cache object
     *
     * @return array
     */
    public function provideSet ( )
    {
        $object = $this->getMockForAbstractClass('MvcLite\ObjectAbstract');

        return array(
            array($object, 'variable1', array(new \stdClass)),
            array($object, 'variable2', new \stdClass),
            array($object, 'variable3', 'array(new \stdClass)'),
        );

    }

    /**
     * test the protected _getNamespace method of the Lib_Cache object
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     * @param string $expected
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
     * provides data to use for testing the protected _getNamespace method
     */
    public function provideGetCacheKey()
    {
        $object = $this->getMockForAbstractClass('MvcLite\ObjectAbstract');
        $prefix = strtolower(strtr(get_class($object), array('_' => '-')));
        return array(
            array($object, 'var', '-' . $prefix . '-var')
        );

    }


} // END class Tests_Lib_CacheTest
