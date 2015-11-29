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

use \MvcLite\Traits\Singleton as SingletonTrait;

/**
 * Base Database adapter
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Database
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Database extends ObjectAbstract
{
    use SingletonTrait;

    const MSG_ERROR_CONN = 'Connection failure: %s';

    /**
     * property to store the Mysqli handle
     *
     * @param mysqli $_handle
     */
    protected $handle;

    /**
     * property to store the last mysqli result
     *
     * @param MySQLi_Result $_result
     */
    protected $result;

    /**
     * property to store the last query
     *
     * @var string
     */
    protected $query;

    /**
     * Start the database up.
     *
     * @param array $params An array of database parameters
     */
    public function init(array $params = array())
    {
        $defaults = Registry::getInstance()->get('database');
        $defaults = is_array($defaults) ? $defaults : array();
        $params = array_merge($defaults, $params);

        $this->handle = new \mysqli(
            $params['host'],
            $params['user'],
            $params['pass'],
            $params['name']
        );

        if (mysqli_connect_error()) {
            throw new Exception(sprintf(self::MSG_ERROR_CONN, mysqli_connect_error()));
        }

    }

    /**
     * Method to return the mysqli instance
     *
     * @return MySQLi
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * passthrough method for querying the database
     *
     * @param string $sql
     * @return Lib_Database
     */
    public function query($sql)
    {
        $this->query = $sql;

        $this->result = $this->getHandle()->query($this->query);

        return $this;
    }

    /**
     * Method to get data from the database
     *
     * @param string $table
     * @param array|string $fields
     * @param array|string $where
     * @param array|string $order
     * @param array $limit
     * @return Lib_Database $this for object-chaining.
     */
    public function fetch($table, $fields = '*', $where = '', $order = null, $limit = null)
    {
        $sql = "select !fields from !table !where !order !limit";

        $this->query = strtr($sql, array(
            '!table'    => $table,
            '!fields'   => $this->buildFields($fields),
            '!where'    => $this->buildWhere($where),
            '!order'    => $this->buildOrder($order),
            '!limit'    => $this->buildLimit($limit),
        ));

        $this->result = $this->getHandle()->query($this->query);

        return $this;
    }

    /**
     * Method to allow updates on a database
     *
     * @param string $table
     * @param array $fields
     * @param array|string $where
     * @return Lib_Database $this for object-chaining.
     */
    public function update($table, $fields = array(), $where = array())
    {
        $sql = "UPDATE !table SET !fields !where";

        $this->query = strtr($sql, array(
            '!table'    => $table,
            '!fields'   => $this->updateFields($fields),
            '!where'    => $this->buildWhere($where),
        ));

        if (! $this->getHandle()->query($this->query)) {
            $message = 'Query Failure: ' . $this->getHandle()->error;
            throw new Exception($message, $this->getHandle()->errno);
        }

        return $this;

    }

    /**
     *
     * Method to allow users to insert new data
     *
     * @param string $table
     * @param array $values
     */
    public function insert($table, $values = array())
    {
        if (! count($values)) {
            throw new Exception(
                'Empty dataset provided. Nothing created'
            );
        }

        $sql = "INSERT INTO !table \n(!fields)\n values \n(!values)";

        $this->query = strtr($sql, array(
            '!table'    => $table,
            '!fields'   => implode(', ', array_keys($values)),
            '!values'   => $this->insertValues($values),
        ));

        if (! $this->getHandle()->query($this->query)) {
            $message = 'Query Failure: ' . $this->getHandle()->error;
            throw new Exception($message, $this->getHandle()->errno);
        }

        return $this;
    }

    /**
     *
     * method to allow the deletion of records
     *
     * @param string $table
     * @param array $params
     * @return Lib_Database $this for object-chaining.
     */
    public function delete($table, $params = array())
    {
        $sql = "DELETE FROM !table !where";
        $this->query = strtr($sql, array(
            '!table'    => $table,
            '!where'    => $this->deleteWhere($params),
        ));

        // if the SQL failed, throw an exception
        if (! $this->getHandle()->query($this->query)) {
            $message = 'Query Failure: ' . $this->getHandle()->error;
            throw new Exception($message, $this->getHandle()->errno);
        }

        return $this;
    }

    /**
     * builds a where string to be used by the delete method
     *
     * @param array $params
     * @return string
     */
    protected function deleteWhere($params = array())
    {
        // use the _buildWhere method to get the initial where string
        $where = $this->buildWhere($params);

        // if there is no where string, throw an exception (dont delete all the data)
        if (! $where) {
            throw new Exception('The where clause of a delete statement is REQUIRED');
        }

        // return the where clause
        return $where;
    }

    /**
     *
     * Method to translate an array of values to an insert string
     *
     * @param array $values
     * @return string
     */
    protected function insertValues($values = array())
    {
        // iterate over the values provided
        foreach ($values as $i => $value) {
            $values[$i] = $this->getHandle()->escape_string($value);
        }

        return "'" .  implode("', '", $values) . "'";
    }

    /**
     * Method to build a setting string for update statements
     *
     * @param array $fields
     * @return string
     */
    protected function updateFields($fields = array())
    {
        // iterate over the fields array
        foreach ($fields as $column => $value) {
            unset($fields[$column]);

            $fields[$column] = strtr("{$column}='!value'", array(
                '!value'    => $this->getHandle()->escape_string($value),
            ));
        }

        return implode(', ', $fields);
    }

    /**
     * Retrieve all of the previously fetched database records.
     *
     * @return array
     */
    public function all()
    {
        $result = array();

        // if there is a valid result ....
        if ($this->result) {
            while ($obj = $this->result->fetch_object()) {
                $result[] = $obj;
            }
        }

        return $result;
    }

    /**
     * First record for a previously fetched database result.
     *
     * @return array
     */
    public function first()
    {
        if ($this->result) {
            while ($obj = $this->result->fetch_object()) {
                return array($obj);
            }
        }
    }

    /**
     * Returns a list of fields to gather.
     *
     * @param array|string $fields
     * @return string
     */
    protected function buildFields($fields = '*')
    {
        if (is_array($fields)) {
            $fields = implode(', ', $fields);
        }

        return $fields;
    }

    /**
     * Get a WHERE string from arbitrary params.
     *
     * @param array|string $params
     * @return string
     */
    protected function buildWhere($params = '')
    {
        // if the params aren't an array, just return them
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

            if ($value instanceof stdClass) {
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
     * Build an order by string.
     *
     * @param array|string
     * @return string
     */
    protected function buildOrder($order = null)
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
     * Builds a limit string.
     *
     * @param array|string $limit
     * @return string
     */
    protected function buildLimit($limit = null)
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
     * Last auto-increment id value from the previous query.
     *
     * @return integer
     */
    public function lastInsertId()
    {
        return $this->getHandle()->insert_id;
    }

    /**
     * Returns the last query executed.
     *
     * @return string
     */
    public function getLastQuery()
    {
        return $this->query;
    }
}
