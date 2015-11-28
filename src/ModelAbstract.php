<?php
/**
 * Base Model
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Base Model
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Model
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
abstract class ModelAbstract
    extends ObjectAbstract
    implements Iterator
{
    protected $_database;

    protected $_fields = array();

    protected $_table = array();

    protected $_result;

    protected $_collections = array();

    /**
     * Associative array listing data about the model
     *
     * @var array
     */
    protected $_data = array();

    /**
     * Cursor to indicate the position of the _data property
     *
     * @var integer
     */
    protected $_cursor = 0;

    /**
     * constructor
     *
     * @param array $data
     */
    public function __construct ($data = array())
    {
        $this->_database = Lib_Database::getInstance();

        if (! is_array($data)) {
            $data = array($data);
        }
        $this->_data = $data;
    }

    /**
     * implementation of the __toString method to force decendants to implement
     * this method locally
     */
    public function __toString ( )
    {
        return get_class($this);

    } // END function __toString

    /**
     * returns if this model has data loaded or not
     *
     * @return boolean
     */
    public function isLoaded ( )
    {
        if (!is_array($this->_data)) {
            return false;
        }

        if (count($this->_data)) {
            return true;
        }

        return false;

    } // END function isLoaded

    /**
     * method to filter out params that aren't in the fields of this model instance
     *
     * @param array $params
     * @return array
     */
    protected function _filterParams ($params = array())
    {
        return array_intersect_key($params, $this->_fields);
    }

    /**
     * (non-PHPdoc)
     * @see Lib_Model::find()
     */
    public function find ($params = array())
    {   // iterate over the _data property, looking for a match to the params
        $this->_data = $this->getDatabase()->fetch(
            $this->_table,
            array_keys($this->_fields),
            $this->_filterParams($params),
            @$params['sort']
        )->all();

        return $this;

    } // END function find

    /**
     * method to load a single record by filtering parameters
     *
     * @param array $params
     * @return Lib_Model $this for a fluent interface
     */
    public function load ($params = array())
    {
        $this->_data = $this->getDatabase()->fetch(
            $this->_table,
            array_keys($this->_fields),
            $this->_filterParams($params)
        )->first();

        $this->loadReferences($this->_data[$this->_cursor]);
        $this->loadCollections($this->_data[$this->_cursor]);

        return $this;

    } // END function load

    /**
     * method to load collections of information onto a single model record
     *
     * @var array $params
     * @return Lib_Model $this for a fluent interface
     */
    public function loadCollections ($params = array())
    {   // iterate through the collections property, loading collections
        foreach ($this->_collections as $collection => $definition) {
            if ($definition['type'] != 'many-to-many') {
                continue;
            }

            $this->loadCollection($collection, $definition);
        }

        return $this;

    } // END function loadCollections

    /**
     * Loads a single collection by provided collection information
     *
     * @param string $collection
     * @param array $definition
     * @return Lib_Model $this
     */
    public function loadCollection ($collection, $definition = array())
    {
        $referenceModel = new $definition['reference']['model'];
        $referenceModel->find(array(
            $definition['reference']['remote_key'] => $this->get(
                $definition['reference']['local_key']
            ),
        ));

        $model = new $definition['model'];
        $this->{$collection} = $model->find(array(
            $definition['foreign_key'] => $referenceModel->values(
                $definition['reference']['foreign_key']
            )
        ));

        return $this;

    } // END function loadCollection

    /**
     * direct query access
     *
     * @param string $sql
     * @return Lib_Model $this for a fluent interface
     */
    public function query ($sql)
    {
        // iterate over the _data property, looking for a match to the params
        $this->_data = $this->getDatabase()->query($sql)->all();

        return $this;

    } // END function query

    /**
     * method to check the fields property for references, and load them as defined
     *
     * @param array $params
     * @throws Lib_Exception
     * @return Lib_Model $this
     */
    public function loadReferences ($params = array())
    {   // iterate through the fields, and load references as required
        foreach ($this->_fields as $column => $field) {
            if (!@$field['reference']) {
                continue;
            }

            $property   = $field['reference']['property'];
            $model      = $field['reference']['model'];
            $foreignKey = $field['reference']['foreign_key'];

            if (!property_exists($this, $property)) {
                throw new Lib_Exception(
                    "Referenced model [{$model}] has no local property"
                );
            }

            $this->{$property} = self::factory($model, array(
                $foreignKey => $this->get($column),
            ));
        }

        return $this;

    } // END function loadReferences

    /**
     * A quick way to create a model and load it
     *
     * @param string $class
     * @param array $params
     * @return Lib_Model
     */
    public static function factory ($class, $params = array())
    {
        $model = new $class;
        $model->load($params);
        return $model;

    } // END function factory

    /**
     * method to get the value of a requested property
     *
     * @param string $property
     * @return string|integer
     */
    public function get ($property)
    {
        return @$this->_data[$this->_cursor]->{$property};

    } // END function get

    /**
     *
     * returns the database object for the model
     *
     */
    public function getDatabase ( )
    {
        return $this->_database;

    } // END function getDatabase

    /**
     * (non-PHPdoc)
     * @see Lib_Model::edit()
     */
    public function edit ($params = array())
    {
        $this->getDatabase()->update(
            $this->_table,
            $this->_filterParams($params),
            (array)$this->_data[$this->_cursor]
        );

        $this->load(array(
            'id'    => $this->get('id'),
        ));

        return $this;

    } // END function edit

    /**
     * (non-PHPdoc)
     * @see Lib_Model::create()
     */
    public function create ($params = array())
    {
        $this->getDatabase()->insert(
            $this->_table,
            $this->_filterParams($params)
        );

        $this->load(array(
            'id'    => $this->getDatabase()->lastInsertId(),
        ));

        return $this;

    } // END function create

    /**
     * (non-PHPdoc)
     * @see Lib_Model::delete()
     */
    public function delete ($params = array())
    {
        $this->getDatabase()->delete(
            $this->_table,
            $this->_filterParams($params)
        );

        return $this;

    } // END function delete

    /**
     * returns the parameters that apply to this model, filtered out
     *
     * @param array $params
     * @return array
     */
    public function filter ($params = array())
    {
        $params = $this->_filterParams($params);

        return $params;

    } // END function filter

    /**
     * getter for the _fields property
     *
     * @return array
     */
    public function getFields ( )
    {
        return $this->_fields;

    } // END function getFields

    /**
     * getter for the _data property
     *
     * @return array
     */
    public function getData ( )
    {
        return $this->_data;

    } // END function getData

    /**
     * (non-PHPdoc)
     * @see Iterator::current()
     */
    public function current ( )
    {
        $class = get_called_class();

        // return the data at the current cursor value
        $model = new $class($this->_data[$this->_cursor]);

        $model->loadReferences();

        return $model;

    } // END function current

    /**
     * returns the current data as an array
     *
     * @return array
     */
    public function toArray ( )
    {
        return (array)$this->_data[$this->_cursor];

    } // END function toArray

    /**
     * (non-PHPdoc)
     * @see Iterator::key()
     */
    public function key ( )
    {
        return $this->_cursor;

    } // END function key

    /**
     * (non-PHPdoc)
     * @see Iterator::next()
     */
    public function next ( )
    {
        ++$this->_cursor;

    } // END function next

    /**
     * (non-PHPdoc)
     * @see Iterator::rewind()
     */
    public function rewind ( )
    {
        $this->_cursor = 0;

    } // END function rewind

    /**
     * (non-PHPdoc)
     * @see Iterator::valid()
     */
    public function valid ( )
    {
        if (! @$this->_data[$this->_cursor]) {
            return false;
        }
        return (bool)current($this->_data[$this->_cursor]);

    } // END function valid

    /**
     * returns just property values for a given properties
     *
     * @param array $properties
     * @return array
     */
    public function values ($property)
    {
        $results = array();

        foreach ($this->_data as $datum) {
            $results[]  = $datum->{$property};
        }

        return $results;

    } // END function values

} // END class Model
