<?php
/**
 * Unit tests for the \MvcLite\View class
 *
 * @category    PHP
 * @package     MVCLite
 * @subpackage  Tests
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the \MvcLite\View class
 *
 * @category    PHP
 * @package     MVCLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewTest extends TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp()
    {
        $this->sut = View::getInstance();
    }

    /**
     * tests the filter method of the view object
     */
    public function testFilter()
    {
        $unfiltered = 'asdasdfads';
        $expected   = 'asdasdfads';
        $result     = $this->sut->filter($unfiltered);

        $this->assertSame($expected, $result);
    }

    /**
     * test the setting and getting of variables to the view.
     *
     * @param array $variables The variables to use for testing.
     *
     * @dataProvider provideVariables
     */
    public function testSetAndGet($variables = [])
    {
        foreach ($variables as $name => $value) {
            $this->sut->set($name, $value);
        }

        foreach ($variables as $name => $value) {
            $this->assertSame($this->sut->get($name), $value);
        }
    }

    /**
     * method to provide data for test methods
     *
     * @return array
     */
    public function provideVariables()
    {
        return [
            'first test' => [
                'variables' => [
                    'var1'  => 'val1',
                    'var2'  => 'val2',
                    'var3'  => 'val3',
                ],
            ]
        ];
    }
}
