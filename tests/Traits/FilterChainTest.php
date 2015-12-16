<?php
/**
 * Class to test the MvcLite\Traits\FilterChain trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\FilterChain as FilterChainTrait;

/**
 * Class to test the MvcLite\Traits\FilterChain trait
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 3.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FilterChainTraitsTest extends TestCase
{
    /**
     * Tests the getFilterChain method of the trait
     */
    public function testGetFilterChain()
    {
        $sut = new TestFixtureFilterChainTrait;
        $result = $sut->getFilterChain(['StringToLower', 'StringToUpper']);
        $this->assertInstanceOf('\MvcLite\FilterChain', $result);
    }
}

// @codingStandardsIgnoreStart
// testing classes
class TestFixtureFilterChainTrait
{
    use FilterChainTrait;
}
// @codingStandardsIgnoreEnd
