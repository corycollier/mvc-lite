<?php
/**
 * Unit tests for the MvcLite\Registry class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Registry
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the MvcLite\Registry class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Registry
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class RegistryTest extends TestCase
{
    /**
     * Test the registry's setter and getter method
     *
     * @param string $key
     * @param unknown_type $value
     * @dataProvider provideSetAndGet
     */
    public function testSetAndGet($key, $value)
    {
        $sut = Registry::getInstance();
        $sut->set($key, $value);

        $this->assertSame($sut->get($key), $value);
    }

    /**
     * Data provider for RegistryTest::testSetAndGet()
     *
     * @return array
     */
    public function provideSetAndGet()
    {
        // return an array of things to test
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
                'object', new \stdClass(),
            ),
            array(
                'array', range(0, 10),
            )
        );
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
     * Data provider for RegistryTest::testSetAll().
     *
     * provides data to use for testing the registry's ability to set multiple
     * values with a single method call (setAll)
     *
     * @return array
     */
    public function provideSetAll()
    {
        return array(
            array(array(
                'test1' => array(),
                'test2' => array(),
                'test4' => array(),
            )),
        );
    }
}
