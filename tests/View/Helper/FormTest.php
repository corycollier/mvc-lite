<?php
/**
 * Test Suite for the Form View Helper
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\View\Helper\Form;
use \MvcLite\TestCase as TestCase;

/**
 * Test Suite for the Form View Helper
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FormTest extends TestCase
{
    /**
     * tests the render method of the form view helper
     *
     * @param array $fields
     * @param array $attribs
     *
     * @covers \MvcLite\View\Helper\Form::render
     *
     * @dataProvider provideRender
     */
    public function testRender($expected, $fields, $attribs = [])
    {
        $sut = $this->getMockBuilder('\MvcLite\View\Helper\Form')
            ->setMethods([
                'elementFactory',
                'getHtmlAttribs',
                'getView'
            ])
            ->getMock();

        $view = $this->getMockBuilder('\MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(['getHelper'])
            ->getMock();

        $element = $this->getMockBuilder('ViewHelperElement')
            ->setMethods(['render'])
            ->getMock();

        $view->expects($this->once())
            ->method('getHelper')
            ->will($this->returnValue($element));

        $sut->expects($this->any())
            ->method('elementFactory')
            ->will($this->returnValue('<element />'));

        $sut->expects($this->any())
            ->method('getHtmlAttribs')
            ->with($this->equalTo($attribs))
            ->will($this->returnValue(' attributes '));

        $sut->expects($this->once())
            ->method('getView')
            ->will($this->returnValue($view));

        $result = $sut->render($fields, $attribs);

        $this->assertEquals($expected, $result);
    }

    /**
     * provides data to use for testing the render method of the form view
     * helper
     *
     * @return array
     */
    public function provideRender()
    {
        return [
            // test with grouped elements
            'test with groups' => [
                'expected' => '<form attributes >'
                    . '<div class="form-group"><element /><element /></div>'
                    . '</form>',
                'fields' => [
                    [
                        'id'    => [
                            'type'    => 'integer',
                            'primary' => true,
                        ],
                        'name'  => [
                            'type'    => 'varchar',
                            'primary' => false,
                        ],
                    ],
                ],
                // The needs for attributes here is screwy. Need to find out what's wrong here.
                'attribs' => [
                    'type'  => 'varchar',
                    'primary' => false,
                ],
            ],

            // test with 2 elements
            'test with 2 elements' => [
                'expected' => '<form attributes >'
                    . '<div class="form-group"><element /></div>'
                    . '<div class="form-group"><element /></div>'
                    . '</form>',
                'fields' => [
                    'id' => [
                        'type'      => 'integer',
                        'primary'   => true,
                    ],
                    'name' => [
                        'type'      => 'varchar',
                        'primary'   => false,
                    ],
                ],
            ],
            // test with 3 elements
            'test with 3 elements' => [
                'expected' => '<form attributes >'
                    . '<div class="form-group"><element /></div>'
                    . '<div class="form-group"><element /></div>'
                    . '<div class="form-group"><element /></div>'
                    . '</form>',
                'fields' => [
                    'id'    => [
                        'type'    => 'integer',
                        'primary' => true,
                    ],
                    'name'  => [
                        'type'    => 'varchar',
                        'primary' => false,
                    ],
                    'email' => [
                        'type'    => 'varchar',
                        'primary' => false,
                    ],
                ],
            ],

            // test with attributes
            'test with attributes' => [
                'expected' => '<form attributes >'
                    . '<div class="form-group"><element /></div>'
                    . '<div class="form-group"><element /></div>'
                    . '</form>',
                'fields' => [
                    'id'    => [
                        'type'    => 'integer',
                        'primary' => true,
                    ],
                    'name'  => [
                        'type'    => 'varchar',
                        'primary' => false,
                    ],
                ],
                'attribs' => [
                    'class'  => 'testing',
                    'method' => 'get',
                ],
            ],

        ];
    }

    /**
     * Tests the elementFactory method of the form view helper
     *
     * @param string $column
     * @param array $params
     *
     * @covers \MvcLite\View\Helper\Form::elementFactory
     *
     * @dataProvider provideElementFactory
     */
    public function testElementFactory($expected, $column, $params, $value)
    {
        $sut = $this->getMockBuilder('\MvcLite\View\Helper\Form')
            ->setMethods(['getView'])
            ->getMock();

        $view = $this->getMockBuilder('\MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(['getHelper'])
            ->getMock();

        $helper = $this->getMockBuilder('ViewHelperElement')
            ->setMethods(['render'])
            ->getMock();

        $helper->expects($this->any())
            ->method('render')
            ->will($this->returnValue($expected));

        $view->expects($this->any())
            ->method('getHelper')
            ->will($this->returnValue($helper));

        $sut->expects($this->any())
            ->method('getView')
            ->will($this->returnValue($view));

        $result = $sut->elementFactory($column, $params);

        $this->assertSame($expected, $result);
    }

    /**
     * Data provider for FormTest::testElementFactory().
     *
     * @return array An array of data to use for testing.
     */
    public function provideElementFactory()
    {
        return [
            'primary' => [
                'expected' => '',
                'column' => 'id',
                'params' => [
                    'primary'   => true,
                    'type'      => 'int',
                    'description' => 'description',
                ],
                'value' => 1,
            ],

            'not primary' => [
                'expected' => 'expected value - not primary',
                'column' => 'name',
                'params' => [
                    'type'      => 'varchar',
                    'description' => 'description',
                ],
                'value' => 'the value',
            ],

            'text' => [
                'expected' => 'expected value - text element',
                'column' => 'name',
                'params' => [
                    'type'      => 'text',
                    'description' => 'description',
                ],
                'value' => 'the name',
            ],

            'enum' => [
                'expected' => 'expected value - enum element',
                'column' => 'name',
                'params' => [
                    'type'      => 'enum',
                    'description' => 'description',
                    'options' => ['value', 'value2'],
                ],
                'value' => 'the name',
            ],
        ];
    }

    /**
     * Tests MvcLite\View\Helper\Form::getElementTypeMap.
     */
    public function testGetElementTypeMap()
    {
        $expected = [
            'enum'     => 'InputSelect',
            'password' => 'InputPassword',
            'int'      => 'InputText',
            'text'     => 'InputTextarea',
            'varchar'  => 'InputText',
            'submit'   => 'InputSubmit',
            'checkbox' => 'InputCheckbox',
        ];

        $sut = new View\Helper\Form;
        $method = $this->getReflectedMethod('\MvcLite\View\Helper\Form', 'getElementTypeMap');
        $result = $method->invoke($sut);
        $this->assertEquals($expected, $result);

    }

    /**
     * Tests the MvcLite\View\Helper\Form::getGroupWrapper method
     *
     * @dataProvider provideGetGroupWrapper
     */
    public function testGetGroupWrapper($expected, $string)
    {
        $sut = new View\Helper\Form;
        $result = $sut->getGroupWrapper($string);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGetGroupWrapper.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetGroupWrapper()
    {
        return [
            'empty string' => [
                'expected' => '<div class="form-group"></div>',
                'string'   => '',
            ],

            'simple string' => [
                'expected' => '<div class="form-group">simple</div>',
                'string'   => 'simple',
            ]
        ];
    }
}


// @codingStandardsIgnoreStart
// testing classes
class FormTestModel{}
class ViewHelperElement extends \MvcLite\View\HelperAbstract{
    public function render() {

    }
}
// @codingStandardsIgnoreEnd
