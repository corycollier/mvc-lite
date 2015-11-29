<?php
/**
 * Unit tests for the Lib_View_Helper_Csv class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_View_Helper_Csv class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_View_Helper_CsvTest
extends PHPUnit_Framework_TestCase
{
    /**
     * tests the $helper->render() method of Lib_View_Helper_Csv
     *
     * @dataProvider provide_render
     */
    public function test_render ($items, $expected)
    {
        $helper = new Lib_View_Helper_Csv;

        $this->assertSame($expected, $helper->render($items));


    }

    /**
     * provides a dataset to use for testing the $helper->render() method
     */
    public function provide_render ( )
    {
        return array(
            // first dataset
            array(
                array(
                    array(
                        'col1' => 'val1',
                        'col2' => 'val2',
                        'col3' => 'val3',
                    ),
                    array('val1', 'val2', 'val3'),
                ),
                implode(PHP_EOL, array(
                    '"col1", "col2", "col3"',
                    '"val1", "val2", "val3"',
                    '"val1", "val2", "val3"',
                )),
            ),
        );

    }

} // END class Lib_View_Helper_CsvTest
