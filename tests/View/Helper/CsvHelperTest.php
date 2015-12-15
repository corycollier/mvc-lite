<?php
/**
 * Unit tests for the MvcLite\View\Helper\Csv class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper;
use MvcLite\TestCase as TestCase;

/**
 * Unit tests for the MvcLite\View\Helper\Csv class.
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Tests
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewHelperCsvTest extends TestCase
{
    /**
     * tests the $helper->render() method of MvcLite\View\Helper\Csv
     *
     * @param array $items An array of data to use.
     * @param string $expected The expected string result.
     *
     * @dataProvider provideRender
     */
    public function testRender($items, $expected)
    {
        $sut = new \MvcLite\View\Helper\Csv;
        $result = $sut->render($items);

        $this->assertSame($expected, $result);
    }

    /**
     * provides a dataset to use for testing the $helper->render() method
     *
     * @return array An array of data to use for testing.
     */
    public function provideRender()
    {
        return [
            // first dataset
            [
                'items' => [
                    [
                        'col1' => 'val1',
                        'col2' => 'val2',
                        'col3' => 'val3',
                    ],
                    ['val1', 'val2', 'val3'],
                ],
                'expected' => implode(PHP_EOL, [
                    '"col1", "col2", "col3"',
                    '"val1", "val2", "val3"',
                    '"val1", "val2", "val3"',
                ]),
            ],
        ];
    }
}
