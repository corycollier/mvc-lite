<?php
/**
 * Class to test the MvcLite\Traits\Loader trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Loader as LoaderTrait;

/**
 * Class to test the MvcLite\Traits\Loader trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class LoaderTraitsTest extends TestCase
{
    /**
     * Tests the getLoader method of the trait
     */
    public function testGetLoader()
    {
        global $loader;
        $sut = new TestFixtureLoaderTrait;
        $property = $this->getReflectedProperty('\MvcLite\TestFixtureLoaderTrait', 'loader');
        $property->setValue($sut, new \stdClass);
        $result = $sut->getLoader();
        $this->assertInstanceOf('\stdClass', $result);
    }

    /**
     * Tests MvcLite\Traits\Loader::setLoader
     */
    public function testSetLoader()
    {
        $loader = new \stdClass;
        $sut = new TestFixtureLoaderTrait;
        $result = $sut->setLoader($loader);
        $this->assertSame($sut, $result);
    }
}

// @codingStandardsIgnoreStart
// testing classes
class TestFixtureLoaderTrait
{
    use LoaderTrait;
}
// @codingStandardsIgnoreEnd
