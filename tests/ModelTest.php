<?php
/**
 * Unit tests for the Lib_Model class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Model class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_Lib_ModelTest
extends PHPUnit_Framework_TestCase
{
    /**
     * The setup method, called before each test
     */
    public function setUp ( )
    {
        $this->fixture = new Tests_Lib_Model_Test;
        
    } // END function setup
    
    /**
     * The tear down hook, called after each test
     */
    public function tearDown ( )
    {
        
    } // END function tearDown

    /**
     * tests the constructor of the library model class
     *
     * @param array|null $data
     * @dataProvider provide___construct
     */
    public function test___construct ($data)
    {
        $this->fixture = new Tests_Lib_Model_Test;

        $property = new ReflectionProperty('Lib_Model', '_database');
        $property->setAccessible(true);
        $result = $property->getValue($this->fixture);

        $this->assertInstanceOf('Lib_Database', $result);

        $property = new ReflectionProperty('Lib_Model', '_data');
        $property->setAccessible(true);
        $result = $property->getValue($this->fixture);

        $this->assertTrue(is_array($result));
        
    } // END function test___construct

    /**
     * Provides data to use for testing the lib model's constructor
     *
     * @return array
     */
    public function provide___construct ( )
    {
        return array(
            'empty' => array(null),
            'empty array'   => array(array()),
            'object'        => array(new stdClass),
        );
        
    } // END function provide___construct

    /**
     * method to test the magic method __toString for the lib model
     *
     * @param Lib_Model $model
     * @dataProvider provide___toString
     */
    public function test___toString ($model)
    {
        $this->assertEquals($model->__toString(), get_class($model));
        
    } // END function test___toString

    /**
     * Provides data to use for testing the lib model's toString method
     *
     * @return array
     */
    public function provide___toString ( )
    {
        return array(
            array(new Tests_Lib_Model_Test),
        );
        
    } // END function provide___toString

    /**
     * Test the lib model's ability to determine if it's loaded or not
     *
     * @param array $data
     * @param boolean $expected
     * @dataProvider provide_isLoaded
     */
    public function test_isLoaded ($data, $expected = true)
    {
        $property = new ReflectionProperty('Tests_Lib_Model_Test', '_data');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $data);

        $this->assertSame($expected, $this->fixture->isLoaded());
        
    } // END function test_isLoaded

    /**
     * provides data to use for testing the model's ability to notify if it is 
     * loaded with data
     *
     * @return array
     */
    public function provide_isLoaded ( )
    {
        return array(
            array(null          , false),
            array(false         , false),
            array(''            , false),
            array(new stdClass  , false),
            array(array()       , false),
            array(range(0,1)    , true),
        );
        
    } // END function provide_isLoaded

    /**
     * tests the model's _filterParams method
     * 
     * @param array $fields
     * @param array $params
     * @dataProvider provide__filterParams
     */
    public function test__filterParams ($fields, $params)
    {
        $property = new ReflectionProperty('Tests_Lib_Model_Test', '_fields');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $fields);

        $method = new ReflectionMethod('Tests_Lib_Model_Test', '_filterParams');
        $method->setAccessible(true);
        $result = $method->invoke($this->fixture, $params);

        $this->assertEquals(array_intersect_key($params, $fields), $result);
        
    } // END function test__filterParams

    /**
     * provides data to use for testing the model's ability to filter params
     *
     * @return array
     */
    public function provide__filterParams ( )
    {
        return array(
            array(
                array(
                    'id'    => array(),
                    'name'  => array(),
                    'desc'  => array(),
                ),
                array(
                    'id'            => 1,
                    'controller'    => 'test-controller',
                    'action'        => 'test-action'
                ),
            ),
        );
    }

    /**
     * tests the model's rewind method
     */
    public function test_rewind ( )
    {
        $this->fixture->rewind();

        $property = new ReflectionProperty('Tests_Lib_Model_Test', '_cursor');
        $property->setAccessible(true);
        $result = $property->getValue($this->fixture);


        $this->assertSame(0, $result);

    } // END function test_rewind

    /**
     * method to test the model's ability to shift it's cursor to the next place
     */
    public function test_next ( )
    {
        $property = new ReflectionProperty('Tests_Lib_Model_Test', '_cursor');
        $property->setAccessible(true);
        $originalValue = $property->getValue($this->fixture);

        $this->fixture->next();

        $nextValue = $property->getValue($this->fixture);

        $this->assertTrue(($originalValue + 1) == $nextValue);
        
    } // END function test_text

    /**
     * tests the model's ability to return the key of it's iteration index
     */
    public function test_key ( )
    {
        $property = new ReflectionProperty('Tests_Lib_Model_Test', '_cursor');
        $property->setAccessible(true);
        $result = $property->getValue($this->fixture);

        $this->assertSame($result, $this->fixture->key());
        
    } // END function test_key

    /**
     * Test the creation of data using the model's create method
     *
     * @param array $params
     * @dataProvider provide_create
     */
    public function test_create ($params = array())
    {
        // Create a stub for the SomeClass class.
        $databaseMock = $this->getMockBuilder('Lib_Database')
                             ->disableOriginalConstructor()
                             ->getMock();
        
        $modelMock = $this->getMock('Tests_Lib_Model_Test', array(
            'getDatabase',
            'load',
        ));

        $modelMock->expects($this->any())
            ->method('getDatabase')
            ->will($this->returnValue($databaseMock));

        $modelMock->expects($this->any())
            ->method('load')
            ->will($this->returnValue(new Tests_Lib_Model_Test($params)));

        $result = $modelMock->create($params);

        $this->assertInstanceOf('Lib_Model', $result);
        
    } // END function test_create

    /**
     * Provides data to use for testing the model's ability to create data
     *
     * @return array
     */
    public function provide_create ( )
    {
        return array(
            array(array(
                'name'  => 'value',
                'email' => 'email value',
            )),
        );
    }

    /**
     * Test the updating of data using the model's update method
     */
    public function test_update ( )
    {
        $this->markTestIncomplete(
            "Test not yet implemented. Model functionality still forthcoming"
        );
        
    } // END function test_update
    
    /**
     * Test the deletion of data using the model's delete method
     */
    public function test_delete ( )
    {
        $this->markTestIncomplete(
            "Test not yet implemented. Model functionality still forthcoming"
        );
        
    } // END function test_delete

    /**
     * test the model's ability to find records
     *
     * @param array $params
     * @dataProvider provide_find
     */
    public function test_find ($params = array())
    {
        $result = $this->fixture->find($params);

        $this->assertInstanceOf('Lib_Model', $result);
        
    } // END function test_find

    /**
     * provides data to use for testing the find method of the model
     *
     * @return array
     */
    public function provide_find ( )
    {
        return array(
            array(array()),
        );
        
    } // END function provide_find

    /**
     * test the load method of the model class
     *
     * @param array $params
     * @dataProvivder provide_load
     */
    public function test_load ($params = array())
    {
        $result = $this->fixture->load($params);

        $this->assertInstanceOf('Lib_Model', $result);
        
    } // END function test_load

    /**
     * provides data to use for testing the load method of the model
     *
     * @return array
     */
    public function provide_load ( )
    {
        return array(
            array(array()),
        );
        
    } // END function provide_load

    /**
     * tests the model's ability to run queries directly
     */
    public function test_query ( )
    {
        $sql = 'SELECT * FROM users';

        $result = $this->fixture->query($sql);

        $this->assertInstanceOf('Lib_Model', $result);
        
    } // END function test_query

    /**
     * tests the model's ability to get the property value for the current item
     * in iteration
     *
     * @param array $data
     * @param string $property
     * @param string $expected
     * @param boolean $isException
     * @dataProvider provide_get
     */
    public function test_get ($data, $property, $expected, $isException = false)
    {
        $dataProperty = new ReflectionProperty('Lib_Model', '_data');
        $dataProperty->setAccessible(true);
        $dataProperty->setValue($this->fixture, $data);

        $result = $this->fixture->get($property);

        $this->assertSame($expected, $result);

    } // END function test_get

    /**
     * Provides data to use for testing the model's abilty to get the property
     * value for the current item in iteration
     *
     * @return array
     */
    public function provide_get ( )
    {
        return array(
            array(array(
                (object)array(
                    'id'    => 1,
                )
            ), 'id', 1),

        );
        
    } // END function provide_get

    /**
     * test the factory method of the model
     *
     * @param string $class
     * @param array $params
     * @dataProvider provide_factory
     */
    public function test_factory ($class, $params = array())
    {
        $result = $this->fixture->factory($class, $params);

        $this->assertInstanceOf($class, $result);
        
    } // END function test_factory

    /**
     * provides data to use for testing the factory method of the model
     *
     * @return array
     */
    public function provide_factory ( )
    {
        return array(
            array('Tests_Lib_Model_Test', array(
                'id'    => 1,
            )),
        );
        
    } // END function provide_factory

    /**
     * tests the model's ability to return the current item in iteration
     *
     * @param string $class
     * @param array $data
     * @dataProvider provide_current
     */
    public function test_current ($class, $data = array())
    {
        $property = new ReflectionProperty('Lib_Model', '_data');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $data);

        $result = $this->fixture->current();

        $this->assertInstanceOf($class, $result);
        
    } // END function test_current

    /**
     * provides data to use for testing the model's ability to return the
     * current item in iteration
     *
     * @return array
     */
    public function provide_current ( )
    {
        return array(
            array('Tests_Lib_Model_Test', array(
                array(
                    'id'    => 5,
                ),
            )),
        );

    } // END function provide_current

    /**
     * tests the model's ability to return it's _fields property
     *
     * @param array $fields
     * @dataProvider provide_getFields
     */
    public function test_getFields ($fields = array())
    {
        $property = new ReflectionProperty('Lib_Model', '_fields');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $fields);

        $this->assertEquals($fields, $this->fixture->getFields());
        
    } // END function test_getFields

    /**
     * Provides data to use for testing the model's ability to return it's 
     * _fields property
     *
     * @return array
     */
    public function provide_getFields ( )
    {
        return array(
            array(array(
                'prop1' => 'val1',
                'prop2' => 'val2',
                'prop3' => 'val3', 
            )),

            array(array(
                'prop1' => array(),
                'prop2' => new stdClass,
                'prop3' => '', 
            )),
        );

    } // END function provide_getFields

    /**
     * tests the model's ability to return it's _fields property
     *
     * @param array $fields
     * @dataProvider provide_getFields
     */
    public function test_getData ($data = array())
    {
        $property = new ReflectionProperty('Lib_Model', '_data');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $data);

        $this->assertEquals($data, $this->fixture->getData());
        
    } // END function test_getData

    /**
     * Provides data to use for testing the model's ability to return it's 
     * _fields property
     *
     * @return array
     */
    public function provide_getData ( )
    {
        return array(
            array(array(
                'prop1' => 'val1',
                'prop2' => 'val2',
                'prop3' => 'val3', 
            )),

            array(array(
                'prop1' => array(),
                'prop2' => new stdClass,
                'prop3' => '', 
            )),
        );

    } // END function provide_getData

    /**
     * Test the filter method of the model
     *
     * @param array $params
     * @param array $expected
     * @dataProvider provide_filter
     */
    public function test_filter ($params = array(), $expected = array())
    {
        $mock = $this->getMock('Lib_Model', array(
            '_filterParams',
        ));

        $mock->expects($this->once())
            ->method('_filterParams')
            ->with($this->equalTo($params))
            ->will($this->returnValue($expected));

        $this->assertEquals($expected, $mock->filter($params));
        
    } // END function test_filter

    /**
     * Provides data to use for testing the model's ability to filter params
     *
     * @return array
     */
    public function provide_filter ( )
    {
        return array(
            array(array(
                'var1'  => 'val1',
                'var2'  => 'val2',
                'var3'  => 'val3',
            ), array(
                'var1'  => 1,
                'var2'  => 'val',
                'var3'  => 'val3',
            )),
            array(array(
                'var1'  => array('val1'),
                'var2'  => (object)array(
                    'prop1' => 'prop1val',
                ),
                'var3'  => 'val3',
            ), array(
                'var1'  => 1,
                'var2'  => 'prop1val',
                'var3'  => 'val3',

            )),
        );
        
    } // END function provide_filter

    /**
     * Tests the toArray method of the lib model class
     *
     * @param integer $cursor
     * @param array $data
     * @param array $expected
     * @dataProvider provide_toArray
     */
    public function test_toArray ($cursor, $data = array(), $expected = array())
    {
        $dataProperty = new ReflectionProperty('Lib_Model', '_data');
        $dataProperty->setAccessible(true);
        $dataProperty->setValue($this->fixture, $data);

        $cursorProperty = new ReflectionProperty('Lib_Model', '_cursor');
        $cursorProperty->setAccessible(true);
        $cursorProperty->setValue($this->fixture, $cursor);

        $this->assertEquals($expected, $this->fixture->toArray());
        
    } // END function test_toArray

    /**
     * Provides data to use for testing the toArray method of the model
     *
     * @return array
     */
    public function provide_toArray ( )
    {
        $data = array(
            array(
                'id'    => 1,
                'name'  => 'test 1',
            ), array(
                'id'    => 2,
                'name'  => 'test 2',
            ), array(
                'id'    => 3,
                'name'  => 'test 3',
            )
        );

        return array(
            array(0, $data, array(
                'id'    => 1,
                'name'  => 'test 1',
            )),
            array(1, $data, array(
                'id'    => 2,
                'name'  => 'test 2',
            )),
            array(2, $data, array(
                'id'    => 3,
                'name'  => 'test 3',
            )),
        );
        
    } // END function provide_toArray

    /**
     * Tests the 'valid' method of the model
     *
     * @param boolean $expected
     * @param integer $cursor
     * @param array $data
     * @dataProvider provide_valid
     */
    public function test_valid ($expected, $cursor, $data)
    {
        $dataProperty = new ReflectionProperty('Lib_Model', '_data');
        $dataProperty->setAccessible(true);
        $dataProperty->setValue($this->fixture, $data);

        $cursorProperty = new ReflectionProperty('Lib_Model', '_cursor');
        $cursorProperty->setAccessible(true);
        $cursorProperty->setValue($this->fixture, $cursor);

        $this->assertSame($expected, $this->fixture->valid());
        
    } // END function test_valid

    /**
     * Provides data to use for testing the 'valid' method of the model
     *
     * @return array 
     */
    public function provide_valid ( )
    {
        $data = array(
            array(
                'id'    => 1,
                'name'  => 'test 1',
            ), array(
                'id'    => 2,
                'name'  => 'test 2',
            ), array(
                'id'    => 3,
                'name'  => 'test 3',
            )
        );

        return array(
            array(true, 0, $data),
            array(true, 1, $data),
            array(true, 2, $data),
            array(false, 3, $data),
        );

    } // END function provide_valid

    /**
     * Tests the model's ability to return a list of values for a given property
     *
     * @param string $property
     * @param array $data
     * @param array $expected
     * @dataProvider provide_values
     */
    public function test_values ($property, $data, $expected)
    {
        $dataProperty = new ReflectionProperty('Lib_Model', '_data');
        $dataProperty->setAccessible(true);
        $dataProperty->setValue($this->fixture, $data);

        $this->assertSame($expected, $this->fixture->values($property));
        
    } // END function test_values

    /**
     * Provides data to use for testing the model's ability to return a list of
     * values for a given property
     *
     * @return array
     */
    public function provide_values ( )
    {
        $data = array(
            (object)array(
                'id'    => 1,
                'name'  => 'test 1',
            ), (object)array(
                'id'    => 2,
                'name'  => 'test 2',
            ), (object)array(
                'id'    => 3,
                'name'  => 'test 3',
            )
        );

        return array(
            array('id', $data, array(
                1, 2, 3,
            )),

            array('name', $data, array(
                'test 1', 'test 2', 'test 3'
            )),
        );
        
    } // END function provide_values

    /**
     * tests the model's abilty to load collections
     *
     * @param array $definitions
     * @dataProvider provide_loadCollections
     */
    public function test_loadCollections ( )
    {
        $testMock = $this->getMock('Tests_Lib_Model_Test', array(
            'loadCollection',
        ));

        $property = new ReflectionProperty('Lib_Model', '_collections');
        $property->setAccessible(true);

        $testMockCollectionsValue = $property->getValue($testMock);
        $testMock->expects($this->exactly(count($testMockCollectionsValue)))
            ->method('loadCollection');

        $testMock->loadCollections();

    } // END function test_loadCollections

    /**
     * Provides data to use for testing the model's ability to load collections
     * of data as defined in a model
     *
     * @return array
     */
    public function provide_loadCollections ( )
    {
        return array(
            array(array(
                 
            )),
        );
    }

    /**
     * tests the model's ability to load a single collection
     *
     * @param string $collection
     * @param array $definition
     * @dataProvider provide_loadCollection
     */
    public function test_loadCollection ($collection, $definition = array())
    {
        
    } // END function test_collection

    /**
     * provides data to use for testing the loadCollection method of the model
     *
     * @return array
     */
    public function provide_loadCollection ( )
    {
        return array(
            array('objects', array(

            ))
        );

    } // END function provide_loadCollection

} // END class ModelTest

/**
 * Fixture model to use for testing
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       Class available since release 2.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Tests_Lib_Model_Test
extends Lib_Model 
{
    protected $_table = 'test';

    protected $_fields = array(
        'id'    => array(
            'type'      => 'int',
            'primary'   => true,
        ),
    );

    public $objects;

    protected $_collections = array(
        'objects' => array(
            'property'      => 'objects',
            'type'          => 'many-to-many',
            'model'         => 'Tests_Lib_Model_Obj',
            'reference'     => array(
                'model'         => 'Tests_Lib_Model_ObjTest',
                'local_key'     => 'id',
                'remote_key'    => 'test_id',
                'foreign_key'   => 'obj_id',
            ),
        ),
    );
}

/**
 * Fixture model to use for testing
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       Class available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Tests_Lib_Model_Obj
extends Lib_Model
{
    protected $_table = 'obj';

    protected $_fields = array(
        'id'    => array(
            'type'      => 'int',
            'primary'   => true,
        ),
    );
}

/**
 * Fixture model to use for testing
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Model
 * @since       Class available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Tests_Lib_Model_ObjTest
extends Lib_Model
{
    protected $_table = 'objs_tests';

    protected $_fields = array(
        'test_id'    => array(
            'type'      => 'int',
        ),
        'obj_id'    => array(
            'type'      => 'int',
        ),
    );
}
