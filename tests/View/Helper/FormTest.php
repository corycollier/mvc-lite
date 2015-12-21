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
                'htmlAttribs',
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

        $view->expects($this->any())
            ->method('getHelper')
            ->will($this->returnValue($element));

        $sut->expects($this->any())
            ->method('elementFactory')
            // ->with(
            //     $this->equalTo($model),
            //     $this->contains(array_keys($fields)),
            //     $this->contains(array_values($fields))
            // )
            ->will($this->returnValue('<element />'));

        $sut->expects($this->any())
            ->method('htmlAttribs')
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
            // test with 2 elements
            'test with 2 elements' => [
                'expected' => '<form>'
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
                'expected' => '<form>'
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
                'expected' => '<form class="testing" method="get">'
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
}


// @codingStandardsIgnoreStart
// testing classes
class FormTestModel{}
class ViewHelperElement extends \MvcLite\View\HelperAbstract{
    public function render() {

    }
}
// @codingStandardsIgnoreEnd
