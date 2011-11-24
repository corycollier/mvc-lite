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

class Tests_Lib_Filter_ClassToCamelcaseTest
extends PHPUnit_Framework_TestCase
{
    /**
     *
     * method to test the ClassToCamelcase filter's ability to filter a string
     *
     * @param string $unfiltered
     * @param string $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($unfiltered, $expected)
    {
        $filter = new Lib_Filter_ClassToCamelcase;

        $this->assertSame($expected, $filter->filter($unfiltered));

    } // END function test_filter

    /**
     * provide data for testing the ClassToCamelcase filter's ability to filter
     *
     * @return array
     */
    public function provide_filter ( )
    {
        return array(
            array('ClassToCamelcase', 'classToCamelcase'),
            array('classToCamelcase', 'classToCamelcase'),
            array('class-ToCamelcase', 'class-ToCamelcase'),
            array('class ToCamelcase', 'class ToCamelcase'),
            array('class ToCamelcase', 'class ToCamelcase'),
            array('class_ToCamelcase', 'toCamelcase'),
            array('class_To__Camelcase', 'camelcase'),
        );

    } // END function provide_filter

} // END class Tests_Lib_Filter_ClassToCamelcaseTest