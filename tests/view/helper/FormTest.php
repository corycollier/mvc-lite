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
     * Local implementation ofthe setup hook
     */
    public function setUp ( )
    {
        $this->sut = new  \MvcLite\View\Helper\Form;
    }

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
    public function testRender ($expected, $fields, $attribs = array())
    {
        $sut = $this->getMockBuilder('\MvcLite\View\Helper\Form')
            ->setMethods(array(
                'elementFactory',
                'htmlAttribs',
                'getView'
            ))
            ->getMock();

        $view = $this->getMockBuilder('\MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(array('getHelper'))
            ->getMock();

        $element = $this->getMockBuilder('ViewHelperElement')
            ->setMethods(array('render'))
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
        return array(
            // test with 2 elements
            'test with 2 elements' => array(
                'expected' => '<form><fieldset>'
                    . '<element /><element />'
                    . '</fieldset></form>',
                'fields' => array(
                    'id'    => array(
                        'type'      => 'integer',
                        'primary'   => true,
                    ),
                    'name'  => array(
                        'type'      => 'varchar',
                        'primary'   => false,
                    ),
                )
            ),

            // test with 3 elements
            'test with 3 elements' => array(
                'expected' => '<form><fieldset>'
                    . '<element /><element /><element />'
                    . '</fieldset></form>',
                'fields' => array(
                    'id'    => array(
                        'type'      => 'integer',
                        'primary'   => true,
                    ),
                    'name'  => array(
                        'type'      => 'varchar',
                        'primary'   => false,
                    ),
                    'email' => array(
                        'type'      => 'varchar',
                        'primary'   => false,
                    ),
                )
            ),

            // test with attributes
            'test with attributes' => array(
                'expected' => '<form class="testing" method="get">'
                    . '<fieldset><element /><element /></fieldset>'
                    . '</form>',
                'fields' => array(
                    'id'    => array(
                        'type'      => 'integer',
                        'primary'   => true,
                    ),
                    'name'  => array(
                        'type'      => 'varchar',
                        'primary'   => false,
                    ),
                ),
                'attribs' => array(
                    'class'     => 'testing',
                    'method'    => 'get',
                )
            ),
        );
    }

    /**
     * Tests the elementFactory method of the form view helper
     *
     * @param string $column
     * @param Lib_Model $model
     * @param array $params
     * @covers Lib_View_Helper_Form::elementFactory
     * @dataProvider provide_elementFactory
     */
    public function test_elementFactory ($column, $model, $params, $value, $expected)
    {
        $model->expects($this->once())
            ->method('get')
            ->with($column)
            ->will($this->returnValue($params['value']));

        $helper = $this->getMock('Lib_View_Helper_Form', array(
            'elementFactory',
        ));

        $result = $this->sut->elementFactory($column, $model, $params);

        $this->assertSame($expected, $result);

    }

    /**
     *
     *
     *
     */
    public function provide_elementFactory ( )
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $model = $this->getMockForAbstractClass('Lib_Model', array(
            'get',
            '_createReferenceElement',
        ));

        return array(
            'primary' => array('id', $model, array(
                'primary'   => true,
                'type'      => 'int',
            ), 1, ''),

            'not primary' => array('name', $model, array(
                'type'      => 'varchar',
            ), 'the value', implode('', array(
                '<label for="name" class="form-text">',
                '<span class="label"></span>',
                '<input type="text"  placeholder="" value="" name="name" id="name" />',
                '</label>'
            ))),

            'text' => array('name', $model, array(
                'type'      => 'text',
            ), 'the name', implode(PHP_EOL, array(
                '<label for="name" class="form-text">',
                '<span class="label"></span>',
                '<textarea type="text"  placeholder="" value="" name="name" id="name"></textarea>',
                '</label>'
            ))),



        );

    }

} // END class Tests_Lib_View_Helper_FormTest


// @codingStandardsIgnoreStart
// testing classes
class FormTestModel{}
class ViewHelperElement extends \MvcLite\View\HelperAbstract{}
// @codingStandardsIgnoreEnd
