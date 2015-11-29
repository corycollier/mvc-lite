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

namespace MvcLite;

/**
 * Unit tests for the Lib_Database class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Database
 * @since       Class available since release 1.1.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
    protected $sut;

    /**
     * Hook to setup each unit test
     */
    public function setup()
    {
        $this->sut = Database::getInstance();
        $this->sut->init(array(
            'host' => '127.0.0.1',
            'user' => 'mvc_test_user',
            'pass' => 'mvc_test_pass',
            'name' => 'mvc_test_db',
        ));
    }

    /**
     * Tests the getHandle method of the Database class
     */
    public function testGetHandlet()
    {
        $this->assertInstanceOf('\mysqli', $this->sut->getHandle());
    }

    /**
     * tests the database's query method
     */
    public function testQuery()
    {
        $sql = 'SELECT * FROM users';
        $this->sut->query($sql);

        $queryProperty = new \ReflectionProperty('\MvcLite\Database', 'query');
        $queryProperty->setAccessible(true);
        $queryValue = $queryProperty->getValue($this->sut);
        $this->assertSame($sql, $queryValue);

        $resultProperty = new \ReflectionProperty('MvcLite\Database', 'result');
        $resultProperty->setAccessible(true);
        $resultValue = $resultProperty->getValue($this->sut);
        $this->assertInstanceOf('\MySQLi_Result', $resultValue);
    }

    /**
     * Method to test the update method of the database class
     *
     * @param string $table
     * @param array $params
     * @dataProvider provideUpdate
     */
    public function testUpdate(
        $table,
        $updateParams = array(),
        $existingParams = array()
    ) {

        if (! count($existingParams)) {
            $this->setExpectedException('MvcLite\Exception');
        }

        $result = $this->sut->update($table, $updateParams, $existingParams);

        $this->assertInstanceOf('MvcLite\Database', $result);
    }

    /**
     * method to provide parameters to test the update method of the database class
     *
     * @return array
     */
    public function provideUpdate()
    {
        return array(
            array(
                'users',
                array(
                    'email' => 'test@test.com',
                ),
                array(
                    'id' => '5',
                )
            ),
            // array(
            //     'users',
            //     array(
            //         'email' => 'test@test.com',
            //     ),
            //     array(
            //         'id' => '1',
            //     )
            // ),
        );

    }

    /**
     * tests the database object's ability to insert data into a table
     *
     * @param string $table
     * @param array $fields
     * @dataProvider provideInsert
     */
    public function testInsert($table, $fields = array())
    {
        if (! count($fields)) {
            $this->setExpectedException('MvcLite\Exception');
        }
        // delete any similar records first
        $this->sut->delete($table, $fields);
        $result = $this->sut->insert($table, $fields);

        $this->assertInstanceOf('MvcLite\Database', $result);

    }

    /**
     * provides parameters to test the database object's ability to insert data
     *
     * @return array
     */
    public function provideInsert()
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

    }

    /**
     * tests the database object's ability to fetch data
     *
     * @param string $table
     * @param array|string $fields
     * @param array|string $where
     * @param array|string $order
     * @param array $limit
     * @dataProvider provideFetch
     */
    public function testFetch($table, $fields = '*', $where = '', $order = null, $limit = null)
    {
        $result = $this->sut->fetch($table, $fields, $where, $order, $limit);

        $this->assertInstanceOf('MvcLite\Database', $result);

    }

    /**
     * Provides data to the fetch tester for testing the database object's
     * ability to fetch data
     *
     * @return array
     */
    public function provideFetch()
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

    }

    /**
     * tests the database object's ability to delete data
     * @param string $table
     * @param array $params
     * @dataProvider provideDelete
     */
    public function testDelete($table, $params = array())
    {
        $result = $this->sut->delete($table, $params);

        $this->assertInstanceOf('MvcLite\Database', $result);

    }

    /**
     * provides data to test the database object's ability to delete data
     *
     * @return array
     */
    public function provideDelete()
    {
        return array(
            array('users', array(
                'email' => 'test@test.com',
            )),
            array('users', array(
                'id' => range(1, 3),
            )),
        );

    }

    public function testAll()
    {

    }

    /**
     * tests the database's ability to return the last query it performed
     */
    public function testGetLastQuery()
    {
        $sql = 'SELECT * FROM users';
        $property = new \ReflectionProperty('MvcLite\Database', 'query');
        $property->setAccessible(true);
        $property->setValue($this->sut, $sql);

        $this->assertSame($sql, $this->sut->getLastQuery());

    }

    /**
     * tests the database class's ability to return the id of the last item
     * that it inserted
     */
    public function testLastInsertId()
    {
        $handle = $this->sut->getHandle();

        $this->assertSame($handle->insert_id, $this->sut->lastInsertId());

    }
}
