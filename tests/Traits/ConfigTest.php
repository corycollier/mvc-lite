<?php
/**
 * Class to test the MvcLite\Traits\Config trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Config as ConfigTrait;

/**
 * Class to test the MvcLite\Traits\Config trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class ConfigTraitsTest extends TestCase
{
    /**
     * Tests the getConfig method of the trait
     */
    public function testGetConfig()
    {
        $sut = new TestFixtureConfigTrait;
        $result = $sut->getConfig();
        $this->assertInstanceOf('\MvcLite\Config', $result);
    }

}

class TestFixtureConfigTrait
{
    use ConfigTrait;
}
