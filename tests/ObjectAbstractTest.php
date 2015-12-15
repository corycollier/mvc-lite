<?php
/**
 * Unit tests for the Object class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Object
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the Object class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Object
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ObjectAbstractTest extends TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp()
    {
        $this->sut = $this->getMockForAbstractClass('\MvcLite\ObjectAbstract');
    }

    /**
     * Test the __get method on the Object
     */
    public function testMagicMethodGet()
    {
        $this->setExpectedException('Exception');
        $result = $this->sut->varaible;
    }

    /**
     * Test the __set method on the Object
     */
    public function testMagicMethodSet()
    {
        $this->setExpectedException('Exception');
        $this->sut->varaible = 'empty result';
    }

    /**
     * Test the __call method on the Object
     */
    public function testMagicMethodCall()
    {
        $this->setExpectedException('Exception');
        $result = $this->sut->nonExistantMethod('var');
    }

    public function testIdentify()
    {
        $this->setExpectedException('Exception');
        $result = $this->sut->identify();
    }

    /**
     * Tests ObjectAbstract::__toString.
     */
    public function testMagicMethodToString()
    {
        $expected = get_class($this->sut);
        $result = (string)$this->sut;
        $this->assertEquals($expected, $result);
    }
}
