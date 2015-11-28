<?php
/**
 * Base Database adapter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Database
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Object\Singleton;

/**
 * Base Database adapter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Database
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Database
    extends Object\Singleton
{
    /**
     * property to store the Mysqli handle
     *
     * @param mysqli $_handle
     */
    protected $_handle;

    /**
     * property to store the last mysqli result
     *
     * @param MySQLi_Result $_result
     */
    protected $_result;

    /**
     * property to store the last query
     *
     * @var string
     */
    protected $_query;

    /**
     * method to start the database up
     */
    public function init ( )
    {
        $database = App_Registry::getInstance()->get('database');

        $this->_handle = new mysqli(
            $database['host'],
            $database['user'],
            $database['pass'],
            $database['name']
        );

        if (mysqli_connect_error()) {
            throw new Lib_Exception(
                'Connection failure: ' . mysqli_connect_error()
            );
        }

    } // END function init

    /**
     * Method to return the mysqli instance
     *
     * @return MySQLi
     */
    public function getHandle ( )
    {
        return $this->_handle;
    }

    /**
     * passthrough method for querying the database
     *
     * @param string $sql
     * @return Lib_Database
     */
    public function query ($sql)
    {
        $this->_query = $sql;

        $this->_result = $this->getHandle()->query($this->_query);

        return $this;

    } // END function query

    /**
     * Method to get data from the database
     *
     * @param string $table
     * @param array|string $fields
     * @param array|string $where
     * @param array|string $order
     * @param array $limit
     * @return Lib_Database $this for a fluent interface
     */
    public function fetch ($table, $fields = '*', $where = '', $order = null, $limit = null)
    {
        $sql = "select !fields from !table !where !order !limit";

        $this->_query = strtr($sql, array(
            '!table'    => $table,
            '!fields'   => $this->_buildFields($fields),
            '!where'    => $this->_buildWhere($where),
            '!order'    => $this->_buildOrder($order),
            '!limit'    => $this->_buildLimit($limit),
        ));

        $this->_result = $this->getHandle()->query($this->_query);

        return $this;
    }

    /**
     * Method to allow updates on a database
     *
     * @param string $table
     * @param array $fields
     * @param array|string $where
     * @return Lib_Database $this for a fluent interface
     */
    public function update ($table, $fields = array(), $where = array())
    {
        $sql = "UPDATE !table SET !fields !where";

        $this->_query = strtr($sql, array(
            '!table'    => $table,
            '!fields'   => $this->_updateFields($fields),
            '!where'    => $this->_buildWhere($where),
        ));

        if (! $this->getHandle()->query($this->_query)) {
            throw new Lib_Exception(
                'Query Failure: ' . $this->getHandle()->error
                , $this->getHandle()->errno
            );
        }

        return $this;

    } // END function update

    /**
     *
     * Method to allow users to insert new data
     *
     * @param string $table
     * @param array $values
     */
    public function insert ($table, $values = array())
    {
        if (! count($values)) {
            throw new Lib_Exception(
                'Empty dataset provided. Nothing created'
            );
        }

        $sql = "INSERT INTO !table \n(!fields)\n values \n(!values)";

        $this->_query = strtr($sql, array(
            '!table'    => $table,
            '!fields'   => implode(', ', array_keys($values)),
            '!values'   => $this->_insertValues($values),
        ));

        if (! $this->getHandle()->query($this->_query)) {
            throw new Lib_Exception(
                'Query Failure: ' . $this->getHandle()->error
                , $this->getHandle()->errno
            );
        }

        return $this;

    } // END function insert

    /**
     *
     * method to allow the deletion of records
     *
     * @param string $table
     * @param array $params
     * @return Lib_Database $this for a fluent interface
     */
    public function delete ($table, $params = array())
    {
        $sql = "DELETE FROM !table !where";
        $this->_query = strtr($sql, array(
            '!table'    => $table,
            '!where'    => $this->_deleteWhere($params),
        ));

        // if the SQL failed, throw an exception
        if (! $this->getHandle()->query($this->_query)) {
            throw new Lib_Exception(
                'Query Failure: ' . $this->getHandle()->error
                , $this->getHandle()->errno
            );
        }

        return $this;

    } // END function delete

    /**
     * builds a where string to be used by the delete method
     *
     * @param array $params
     * @return string
     */
    protected function _deleteWhere ($params = array())
    {   // use the _buildWhere method to get the initial where string
        $where = $this->_buildWhere($params);

        // if there is no where string, throw an exception (dont delete all the data)
        if (! $where) {
            throw new Lib_Exception(
                'The where clause of a delete statement is REQUIRED'
            );
        }

        // return the where clause
        return $where;

    } // END function _deleteWhere

    /**
     *
     * Method to translate an array of values to an insert string
     *
     * @param array $values
     * @return string
     */
    protected function _insertValues ($values = array())
    {   // iterate over the values provided
        foreach ($values as $i => $value) {
            $values[$i] = $this->getHandle()->escape_string($value);
        }

        return "'" .  implode("', '", $values) . "'";

    } // END function _insertValues

    /**
     * Method to build a setting string for update statements
     *
     * @param array $fields
     * @return string
     */
    protected function _updateFields ($fields = array())
    {   // iterate over the fields array
        foreach ($fields as $column => $value) {
            unset($fields[$column]);

            $fields[$column] = strtr("{$column}='!value'", array(
                '!value'    => $this->getHandle()->escape_string($value),
            ));
        }

        return implode(', ', $fields);
    }

    /**
     * method to retrieve all of the previously fetched database records
     *
     * @return array
     */
    public function all ( )
    {
        $result = array();

        // if there is a valid result ....
        if ($this->_result) {
            while($obj = $this->_result->fetch_object()) {
                $result[] = $obj;
            }
        }

        return $result;

    } // END function all

    /**
     * returns the first record for a previously fetched database result
     *
     * @return array
     */
    public function first ( )
    {
        if ($this->_result) {
            while($obj = $this->_result->fetch_object()) {
                return array($obj);
            }
        }

    } // END function first

    /**
     * Returns a list of fields to gather
     *
     * @param array|string $fields
     * @return string
     */
    protected function _buildFields ($fields = '*')
    {
        if (is_array($fields)) {
            $fields = implode(', ', $fields);
        }

        return $fields;
    }

    /**
     * Method to get a WHERE string from arbitrary params
     *
     * @param array|string $params
     * @return string
     */
    protected function _buildWhere ($params = '')
    {   // if the params aren't an array, just return them
        if (! is_array($params)) {
            return $params;
        }

        if (!count($params)) {
            return '';
        }

        // iterate over the provided params as key/value pairs
        foreach ($params as $column => $value) {
            unset($params[$column]);
            if (! $value) {
                continue;
            }
            if ($value instanceOf stdClass) {
                continue;
            }

            if (is_array($value)) {
                foreach ($value as $i => $childValue) {
                    $value[$i] = $this->getHandle()->escape_string($childValue);
                }
                $params[$column] = "{$column} IN ('" . implode("','", $value) . "')";
                continue;
            }

            $params[$column] = "{$column}='" . $this->getHandle()->escape_string($value) . "'";
        }

        if (! $params) {
            return '';
        }

        return ' WHERE ' . implode(' AND ', $params);
    }


    /**
     * method to build an order by string
     *
     * @param array|string
     * @return string
     */
    protected function _buildOrder ($order = null)
    {
        if (is_array($order)) {
           $order = implode(', ', $order);
        }

        if ($order) {
            $order = " ORDER BY {$order} ";
        }

        return $order;
    }

    /**
     * builds a limit string
     *
     * @param array|string $limit
     * @return string
     */
    protected function _buildLimit ($limit = null)
    {
        if (is_array($limit)) {
            $limit = "{$limit[0]}, {$limit[1]}";
        }

        if ($limit) {
            $limit = " LIMIT {$limit}";
        }

        return $limit;
    }

    /**
     * returns the last auto-increment id value from the previous query
     *
     * @return integer
     */
    public function lastInsertId ( )
    {
        return $this->getHandle()->insert_id;

    } // END function lastInsertId

    /**
     * Returns the last query executed
     *
     * @return string
     */
    public function getLastQuery ( )
    {
        return $this->_query;

    } // END function getLastQuery

} // END class Lib_Database
