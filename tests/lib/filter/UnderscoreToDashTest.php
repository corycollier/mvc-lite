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
/**
 * class to camelcase filter test
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Filter
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_Filter_UnderscoreToDashTest
extends PHPUnit_Framework_TestCase
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
        $filter = new Lib_Filter_UnderscoreToDash;

        $this->assertSame($expected, $filter->filter($unfiltered));

    } // END function test_filter

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

    } // END function provide_filter

} // END class Tests_Lib_Filter_UnderscoreToDashTest