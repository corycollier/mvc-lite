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

use \MvcLite\View\Helper;

/**
 * Test Suite for the Form View Helper
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FormTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Local implementation ofthe setup hook
     */
    public function setUp ( )
    {
        $this->fixture = new Form;
    }

    /**
     * tests the render method of the form view helper
     *
     * @param array $fields
     * @param array $attribs
     * @covers Lib_View_Helper_Form::render
     * @dataProvider provide_render
     */
    public function test_render ($fields, $attribs = array())
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $model = $this->getMock('Tests_Lib_Model_FormTest', array(
            'getFields',
        ));

        $model->expects($this->any())
            ->method('getFields')
            ->will($this->returnValue($fields));

        $helper = $this->getMock('Lib_View_Helper_Form', array(
            'elementFactory',
            '_htmlAttribs',
        ));

        $helper->expects($this->any())
            ->method('elementFactory')
            // ->with(
            //     $this->equalTo($model),
            //     $this->contains(array_keys($fields)),
            //     $this->contains(array_values($fields))
            // )
            ->will($this->returnValue('<element />'));

        $helper->expects($this->once())
            ->method('_htmlAttribs')
            ->with($this->equalTo($attribs))
            ->will($this->returnValue(' attributes '));

        $result = $helper->render($model, $attribs);

    }

    /**
     * provides data to use for testing the render method of the form view
     * helper
     *
     * @return array
     */
    public function provide_render ( )
    {
        return array(
            array(array(
                'id'    => array(
                    'type'      => 'integer',
                    'primary'   => true,
                ),
                'name'  => array(
                    'type'      => 'varchar',
                    'primary'   => false,
                ),
            )),

            array(array(
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
            )),

            array(array(
                'id'    => array(
                    'type'      => 'integer',
                    'primary'   => true,
                ),
                'name'  => array(
                    'type'      => 'varchar',
                    'primary'   => false,
                ),
            ), array(
                'class'     => 'testing',
                'method'    => 'get',
            )),
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

        $result = $this->fixture->elementFactory($column, $model, $params);

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

/**
 * Fixture model to use for testing
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       Class available since release 2.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class FormTestModel{}
