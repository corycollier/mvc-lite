<?php
/**
 * Tests the model view helper's abilities
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 2.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Tests the model view helper's abilities
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  View_Helper
 * @since       File available since release 2.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_View_Helper_ModelTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Local implementation of the setUp hook 
     */
    public function setUp ( )
    {
        $this->fixture = new Lib_View_Helper_Model;

    } // END function setUp

    /**
     * method to test the model view helper's getController method
     *
     * @param Lib_Model $model
     * @param string $expected
     * @dataProvider provide_getController
     */
    public function test_getController ($model, $expected)
    {
        $this->assertSame($expected, $this->fixture->getController($model));
        
    } // END function test_getController

    /**
     * provides data to use for testing the model view helper's getController
     * method
     *
     * @return array
     */
    public function provide_getController ( )
    {
        return array(
            array(new Lib_Model_Testing, 'testings'),
            array(new Lib_Model_ExampleTesting, 'example-testings'),
            array(new Lib_Model_ExampleTestingModel, 'example-testing-models'),
        );
        
    } // END function provide_getController

    /**
     * Method to test the model view helpers ability to return columns for a
     * given model
     *
     * @param array $expected
     * @param array $getFields
     * @dataProvider provide_getColumns
     */
    public function test_getColumns ($expected, $getFields = array())
    {
        $model = $this->getMock('Lib_Model', array(
            'getFields',
        ));

        $model->expects($this->once())
            ->method('getFields')
            ->will($this->returnValue($getFields));

        $this->assertSame($expected, $this->fixture->getColumns($model));
        
    } // END function test_getColumns

    /**
     * Provides data to use for testing the model view helper's ability to 
     * return a list of columns for a given model
     *
     * @return array
     */
    public function provide_getColumns ( )
    {
        return array(
            array(
                array(
                    'id'    => 'ID',
                    'name'  => 'Name',
                ),
                array(
                    'id' => array(
                        'primary'   => true,
                        'type'      => 'integer',
                        'label'     => 'ID',
                    ),
                    'name' => array(
                        'primary'   => true,
                        'type'      => 'varchar',
                        'label'     => 'Name',
                    ),
                ),
            ),
            array(
                array(
                    'id'    => '',
                    'name'  => 'Name',
                ),
                array(
                    'id' => array(
                        'primary'   => true,
                        'type'      => 'integer',
                        'label'     => '',
                    ),
                    'name' => array(
                        'primary'   => true,
                        'type'      => 'varchar',
                        'label'     => 'Name',
                    ),
                ),
            ),
            array(
                array(),
                array(),
            ),
        );
        
    } // END function provide_getColumns

    /**
     * tests the model view helper's ability to return the name of a given model
     *
     * @param Lib_Model $model
     * @param string $expected
     * @dataProvider provide_getName
     */
    public function test_getName ($model, $expected)
    {
        $this->assertSame($expected, $this->fixture->getName($model));
        
    } // END function test_getName

    /**
     * provides data to use for testing the model view helper's ability to get
     * the name of a model
     *
     * @return array
     */
    public function provide_getName ( )
    {
        return array(
            array(new Lib_Model_Testing, 'Testing'),
            array(new Lib_Model_ExampleTesting, 'Example Testing'),
            array(new Lib_Model_ExampleTestingModel, 'Example Testing Model'),
        );
        
    } // END function provide_getName

} // END class Tests_Lib_View_Helper_ModelTest

class Lib_Model_Testing
extends Lib_Model { }

class Lib_Model_ExampleTesting
extends Lib_Model { }

class Lib_Model_ExampleTestingModel
extends Lib_Model { }