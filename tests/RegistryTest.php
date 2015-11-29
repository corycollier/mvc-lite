<?php
/**
 * Unit tests for the Lib_Registry class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Registry
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Registry class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Registry
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_RegistryTest
extends PHPUnit_Framework_TestCase
{
    /**
     * method to test the registry's setter method
     *
     * @param string $key
     * @param unknown_type $value
     * @dataProvider provide_setAndGet
     */
    public function test_setAndGet ($key, $value)
    {
        $registry = Lib_Registry::getInstance();

        $registry->set($key, $value);

        $this->assertSame($registry->get($key), $value);

    }

    /**
     * data provider for setting information to the registry
     *
     * @return array
     */
    public function provide_setAndGet ( )
    {   // return an array of things to test
        return array(
            array(
                'string', 'value1',
            ),
            array(
                'int', 1,
            ),
            array(
                'bool', false,
            ),
            array(
                'object', new stdClass(),
            ),
            array(
                'array', range(0,10),
            )
        );

    }

    /**
     * method to test the registry's ability to set multiple values at once
     *
     * @param array $params
     * @dataProvider provide_setAll
     */
    public function test_setAll ($params)
    {
        $this->markTestIncomplete('still working on this one');

    }

    /**
     * provides data to use for testing the registry's ability to set multiple
     * values with a single method call (setAll)
     *
     * @return array
     */
    public function provide_setAll ( )
    {
        return array(
            array(array(
                'test1' => array(),
                'test2' => array(),
                'test4' => array(),
            )),
        );

    }

} // END class RegistryTest
