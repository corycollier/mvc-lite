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

namespace MvcLite\Tests\View\Helper;

/**
 * Test Suite for the Form View Helper
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FormTest extends \MvcLite\TestCase
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
                'expected' => '<form><fieldset>'
                    . '<element /><element />'
                    . '</fieldset></form>',
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
                'expected' => '<form><fieldset>'
                    . '<element /><element /><element />'
                    . '</fieldset></form>',
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
                    . '<fieldset><element /><element /></fieldset>'
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
        $method = "create{$params['type']}Element";
        $sut = $this->getMockBuilder('\MvcLite\View\Helper\Form')
            ->setMethods(['getView'])
            ->getMock();

        $view = $this->getMockBuilder('\MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(['getHelper'])
            ->getMock();

        $helper = $this->getMockBuilder('ViewHelperElement')
            ->setMethods([
                'createEnumElement',
                'createPasswordElement',
                'createIntElement',
                'createTextElement',
                'createVarcharElement',
                'render'
            ])
            ->getMock();

        $helper->expects($this->any())
            ->method($method)
            ->with($this->equalTo($value), $this->equalTo($params))
            ->will($this->returnValue($value));

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
                'expected' => implode('', [
                    '<label for="name" class="form-text">',
                    '<span class="label"></span>',
                    '<input type="text"  placeholder="" value="" name="name" id="name" />',
                    '</label>'
                ]),
                'column' => 'name',
                'params' => [
                    'type'      => 'varchar',
                    'description' => 'description',
                ],
                'value' => 'the value',
            ],

            'text' => [
                'expected' => implode(PHP_EOL, [
                    '<label for="name" class="form-text">',
                    '<span class="label"></span>',
                    '<textarea type="text"  placeholder="" value="" name="name" id="name"></textarea>',
                    '</label>'
                ]),
                'column' => 'name',
                'params' => [
                    'type'      => 'text',
                    'description' => 'description',
                ],
                'value' => 'the name',
            ],
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
