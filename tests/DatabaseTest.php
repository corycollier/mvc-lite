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

class DatabaseTest extends TestCase
{
    protected $sut;

    /**
     * Hook to setup each unit test
     */
    public function setup()
    {
        $this->sut = Database::getInstance();
        $this->sut->init([
            'host' => '127.0.0.1',
            'user' => 'mvc_test_user',
            'pass' => 'mvc_test_pass',
            'name' => 'mvc_test_db',
        ]);
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
    public function testUpdate($table, $updateParams = [], $existingParams = [])
    {

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
        return [
            'simple update test' => [
                'table'          => 'users',
                'updateParams'   => ['email' => 'test@test.com'],
                'existingParams' => ['id' => '5']
            ],
        ];
    }

    /**
     * tests the database object's ability to insert data into a table
     *
     * @param string $table
     * @param array $fields
     * @dataProvider provideInsert
     */
    public function testInsert($table, $fields = [])
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
        return [
            'users insert test' => [
                'table' => 'users',
                'fields' => ['email' => 'test1@test.com'],
            ]
        ];
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
        return [
            'table fetch' => [
                'table' => 'users',
            ],
            'fable fetch, with fields' => [
                'table' => 'users',
                'fields' => ['email'],
            ],
            'fable fetch, with 2 fields' => [
                'table' => 'users',
                'fields' => ['id', 'email'],
            ],
            'fable fetch, with 2 fields and where clause' => [
                'table' => 'users',
                'fields' => ['id', 'email'],
                'where' => ['id' => 5, 'email' => 'test@test.com'],
            ],
            'fable fetch, with 2 fields, and order clause' => [
                'table' => 'users',
                'fields' => ['id', 'email'],
                'where' => null,
                'order' => 'id',
            ],
            'fable fetch, with 2 fields, and 2 order clauses' => [
                'table' => 'users',
                'fields' => ['id', 'email'],
                'where' => null,
                'order' => ['id', 'email'],
            ],
        ];
    }

    /**
     * tests the database object's ability to delete data
     * @param string $table
     * @param array $params
     * @dataProvider provideDelete
     */
    public function testDelete($table, $params = [])
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
        return [
            'test users by email' => [
                'table' => 'users',
                'params'=> ['email' => 'test@test.com'],
            ],
            'test users by array of ids' => [
                'table' => 'users',
                'params' => ['id' => range(1,3)],
            ],
        ];
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
