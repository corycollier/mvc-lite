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

class RegistryTest
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
        
    } // END function test_set
    
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
    
} // END class RegistryTest