<?php
/**
 * Unit tests for the MvcLite\Filter class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the MvcLite\Filter class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterChainTest extends TestCase
{
    /**
     * Tests MvcLite\FilterChain::addFilter().
     *
     * @dataProvider provideAddFilter
     */
    public function testAddFilter($filter)
    {
        $sut = new FilterChain;
        $result = $sut->addFilter($filter);
        $this->assertSame($result, $sut);
    }

    /**
     * Data provider for FilterChainTest::testAddFilter().
     *
     * @return array
     */
    public function provideAddFilter()
    {
        return [
            'simple test' => [
                'filter' => new FilterTest,
            ]
        ];
    }

    /**
     * Tests FilterChain::filter().
     *
     * @param string $expected The expected result of the test.
     * @param string $word The input value to use in testing.
     * @param array $expected The expected result of the test.
     *
     * @dataProvider provideFilter
     */
    public function testFilter($expected, $word, $filters)
    {
        $sut = new FilterChain;
        $this->getReflectedProperty('\MvcLite\FilterChain', 'filters')
            ->setValue($sut, $filters);
        $result = $sut->filter($word);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for FilterChainTest::testFilter().
     *
     * @return array
     */
    public function provideFilter()
    {
        return [
            'simple test' => [
                'expected' => 'value',
                'word'     => 'value',
                'filters'  => [new FilterTest],
            ]
        ];
    }
}

// @codingStandardsIgnoreStart
// testing classes
class FilterTest extends FilterAbstract {
    public function filter($word = '') {
        return $word;
    }
}
// @codingStandardsIgnoreEnd

