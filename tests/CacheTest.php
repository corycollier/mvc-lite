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
/**
 * Class to test the Lib_Cache object
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_CacheTest
extends PHPUnit_Framework_TestCase
{
    /**
     * setUp hook
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Cache::getInstance();
        
    } // END function setUp

    /**
     * tests the init method of the cache object
     *
     * @dataProvider provide_init
     */
    public function test_init ($config = array())
    {
        $this->fixture->init($config);

        $property = new ReflectionProperty('Lib_Cache', '_config');
        $property->setAccessible(true);
        $result = $property->getValue($this->fixture);

        $this->assertSame($result, $config);
        
    } // END function test_init

    /**
     * provider of data for the init method
     */
    public function provide_init ( )
    {
        return array(
            array(array(
                'prefix'    => 'cache',
                'directory' => 'var/cache/',
            )),
            array(array(
                'prefix'    => '',
                'directory' => 'var/cache/',
            )),
        );
        
    } // END function provide_init

    /**
     * tests the getter of the cache object
     *
     * @param Lib_Object $object
     * @param string $name
     * @param string $expectedValue
     * @dataProvider provide_get
     */
    public function test_get (Lib_Object $object, $name, $expectedValue)
    {
        $this->fixture->set($object, $name, $expectedValue);

        $this->assertEquals($expectedValue, 
            $this->fixture->get($object, $name)
        );
        
    } // END function test_get

    /**
     * returns data to use to test the get method of the lib cache object
     *
     * @return array
     */
    public function provide_get ( )
    {
        return array(
            array(new Lib_Object, 'variable1', array(new stdClass)),
            array(new Lib_Object, 'variable2', new stdClass),
            array(new Lib_Object, 'variable3', 'array(new stdClass)'),
        );
        
    } // END function provide_get // END function test_get

    /**
     * tests the setter of the cache object
     * 
     * @param Lib_Object $object
     * @param string $name
     * @param unknown_type $data
     * @dataProvider provide_set
     */
    public function test_set (Lib_Object $object, $name, $data = null)
    {
        
    } // END function test_set

    /**
     * returns data to use to test the set method of the lib cache object
     *
     * @return array
     */
    public function provide_set ( )
    {
        return array(
            array(new Lib_Object, 'variable1', array(new stdClass)),
            array(new Lib_Object, 'variable2', new stdClass),
            array(new Lib_Object, 'variable3', 'array(new stdClass)'),
        );
        
    } // END function provide_set

    /**
     * test the protected _getNamespace method of the Lib_Cache object
     *
     * @param Lib_Object $object
     * @param string $name
     * @param string $expected
     * @dataProvider provide__getCacheKey
     */
    public function test__getCacheKey (Lib_Object $object, $name, $expected)
    {
        $method = new ReflectionMethod('Lib_Cache', '_getCacheKey');
        $method->setAccessible(true);
        $result = $method->invoke($this->fixture, $object, $name);

        $this->assertSame($expected, $result);
        
    } // END function test__getCacheKey

    /**
     * provides data to use for testing the protected _getNamespace method
     */
    public function provide__getCacheKey ( )
    {
        return array(
            array(new Lib_Object, 'var', '-lib-object-var')
        );
        
    } // END function provide__getCacheKey


} // END class Tests_Lib_CacheTest