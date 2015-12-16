<?php
/**
 * Class to test the MvcLite\Traits\Session trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Session as SessionTrait;

/**
 * Class to test the MvcLite\Traits\Session trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class SessionTraitsTest extends TestCase
{
    /**
     * Tests the getSession method of the trait
     */
    public function testGetSession()
    {
        $sut = new TestFixtureSessionTrait;
        $result = $sut->getSession();
        $this->assertInstanceOf('\MvcLite\Session', $result);
    }
}

// @codingStandardsIgnoreStart
// testing classes
class TestFixtureSessionTrait
{
    use SessionTrait;
}
// @codingStandardsIgnoreEnd
