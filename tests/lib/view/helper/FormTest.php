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
/**
 * Test Suite for the Form View Helper
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_View_Helper_FormTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Local implementation ofthe setup hook
     */
    public function setUp ( )
    {
        $this->fixture = new Lib_View_Helper_Form;
        
    } // END function setUp

    /**
     * tests the render method of the form view helper
     *
     * @param array $fields
     * @param array $attribs
     * @dataProvider provide_render
     */
    public function test_render ($fields, $attribs = array())
    {
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
        
    } // END function test_render

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
class Tests_Lib_Model_FormTest
extends Lib_Model { }