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

class Tests_Lib_Filter_StringToLowerTest
extends PHPUnit_Framework_TestCase
{
    /**
     *
     * method to test the StringToLower filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new Lib_Filter_StringToLower;

        $this->assertSame($expected, $filter->filter($unfiltered));

    }

    /**
     * provide data for testing the StringToLower filter's ability to filter
     *
     * @return array
     */
    public function provide_filter ( )
    {
        return array(
            array('Word', 'word'),
            array('Lion', 'lion'),
            array('tIer', 'tier'),
            array('The Dog', 'the dog'),
            array('123 SomethinG', '123 something'),
            array('wow AWeSoME', 'wow awesome'),
        );

    }

} // END class Tests_Lib_Filter_StringToLowerTest
