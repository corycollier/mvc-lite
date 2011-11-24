<?php
/**
 * Unit tests for the Lib_Database class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Database
 * @since       File available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit tests for the Lib_Database class
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Database
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class DatabaseTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Hook to setup each unit test
     */
    public function setup ( )
    {
        $this->fixture = Lib_Database::getInstance();
        
    } // END function setUp
    
    /**
     * hook to tear down unit tests
     */
    public function tearDown ( )
    {
        
    } // END function tearDown
    
    public function test_getHandle ( )
    {
        $this->assertInstanceOf('mysqli', $this->fixture->getHandle());
        
    } // END function test_getHandle
    
    /**
     * Method to test the update method of the database class
     * 
     * @param string $table
     * @param array $params
     * @dataProvider provide_update
     */
    public function test_update ($table, $updateParams = array(), $existingParams = array())
    {
        if (! count($existingParams)) {
            $this->setExpectedException('Lib_Exception');
        }

        $result = $this->fixture->update($table, $updateParams, $existingParams);
        
        
        $this->assertInstanceOf('Lib_Database', $result);
        
        
    } // END function test_update
    
    /**
     * method to provide parameters to test the update method of the database class
     * 
     * @return array
     */
    public function provide_update ( )
    {
        return array(
            array('users', array(
                'email' => 'test@test.com', 
                ), array(
                'id' => '5',
            )),
            array('users', array(
                'email' => 'test@test.com', 
                ), array(
//                'id' => '1',
            )),
        );
        
    } // END function provide_update
    
    /**
     * tests the database object's ability to insert data into a table
     * 
     * @param string $table
     * @param array $fields
     * @dataProvider provide_insert
     */
    public function test_insert ($table, $fields = array())
    {
        if (! count($fields)) {
            $this->setExpectedException('Lib_Exception');
        }
        // delete any similar records first
        $this->fixture->delete($table, $fields);
        $result = $this->fixture->insert($table, $fields);
        
        $this->assertInstanceOf('Lib_Database', $result);
        
    } // END function test_insert
    
    /**
     * provides parameters to test the database object's ability to insert data
     * 
     * @return array
     */
    public function provide_insert ( )
    {
        return array(
            array('users', array(
                'email' => 'test1@test.com'
            )),
            array('users', array(
                'email' => 'test2@test.com'
            )),
            array('users', array()),
        );
        
    } // END function provide_insert
    
    /**
     * tests the database object's ability to fetch data
     * 
     * @param string $table
     * @param array|string $fields
     * @param array|string $where
     * @param array|string $order
     * @param array $limit
     * @dataProvider provide_fetch
     */
    public function test_fetch ($table, $fields = '*', $where = '', $order = null, $limit = null)
    {
        $result = $this->fixture->fetch($table, $fields, $where, $order, $limit);
        
        $this->assertInstanceOf('Lib_Database', $result);
        
    } // END function test_fetch
    
    /**
     * provides data to the fetch tester for testing the database object's 
     * ability to fetch data
     * 
     * @return array
     */
    public function provide_fetch ( )
    {
        return array(
            array('users'),
            array(
                'users',
                array('email'),
            ),
            array(
                'users',
                array('id', 'email'),
            ),
            array(
                'users',
                array('id', 'email'),
                array(
                    'id'    => 5, 
                    'email' => 'test@test.com'
                ),
            ),
            array(
                'users',
                array('id', 'email'),
                null,
                'id',
            ),
            array(
                'users',
                array('id', 'email'),
                null,
                array('id', 'email'),
            ),
        );
        
    } // END function provide_fetch
    
    /**
     * tests the database object's ability to delete data
     * @param string $table
     * @param array $params
     * @dataProvider provide_delete
     */
    public function test_delete ($table, $params = array())
    {
        $result = $this->fixture->delete($table, $params);
        
        $this->assertInstanceOf('Lib_Database', $result);
        
    } // END function test_delete
    
    /**
     * provides data to test the database object's ability to delete data
     * 
     * @return array
     */
    public function provide_delete ( )
    {
        return array(
            array('users', array(
                'email' => 'test@test.com',
            )),
            array('users', array(
                'id'    => range(1,3),
            )),
        );
        
    } // END function provide_delete
    
    public function test_all ( )
    {
        
    } // END function test_all
    
} // END class DatabaseTest