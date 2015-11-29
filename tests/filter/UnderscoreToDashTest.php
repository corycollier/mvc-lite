<?php
/**
 * class to camelcase filter test
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Filter;

/**
 * class to camelcase filter test
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FilterUnderscoreToDashTest
extends \MvcLite\TestCase
{
    /**
     *
     * method to test the UnderscoreToDash filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new \MvcLite\Filter\UnderscoreToDash;

        $this->assertSame($expected, $filter->filter($unfiltered));

    }

    /**
     * provide data for testing the UnderscoreToDash filter's ability to filter
     *
     * @return array
     */
    public function provide_filter ( )
    {
        return array(
            array('the unfiltered_word', 'the unfiltered-word'),
            array('_the unfiltered_word', '-the unfiltered-word'),
            array('_the 1 unfiltered_word', '-the 1 unfiltered-word'),
            array('_the 1 unfiltered_word_', '-the 1 unfiltered-word-'),
        );

    }

} // END class Tests_\MvcLite\Filter\UnderscoreToDashTest
