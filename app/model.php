<?php
/**
 * Base model
 * 
 * @category    MVCLite
 * @package     App
 * @subpackage  Model
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * User Model
 * 
 * Model to contain logic that other applications models inherit
 * 
 * @category    MVCLite
 * @package     App
 * @subpackage  Model
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class App_Model
extends Lib_Model
{

    protected $_adapter;

    protected $_fields = array();

    protected $_table = array();

    protected $_data = array();

    protected $_result;

    public function __construct ( )
    {
        $this->_adapter = Lib_Database::getInstance();
    }

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
        $this->_data = $this->_adapter->fetch(
            $this->_table,
            array_keys($this->_fields),
            $this->_filterParams($params)
        )->all();

        return $this->_data;

    } // END function find


    /**
     * (non-PHPdoc)
     * @see Lib_Model::read()
     */
    public function read ($params = array())
    {
        return $this->current();

    } // END function read

    /**
     * (non-PHPdoc)
     * @see Lib_Model::edit()
     */
    public function edit ($params = array())
    {
        $this->_adapter->update(
            $this->_table,
            $this->_filterParams($params),
            (array)$this->current()
        );
        
        return $this;
        

    } // END function edit

    /**
     * (non-PHPdoc)
     * @see Lib_Model::create()
     */
    public function create ($params = array())
    {
        $this->_adapter->insert(
            $this->_table, 
            $this->_filterParams($params)
        );
        
        return $this;

    } // END function create

    /**
     * (non-PHPdoc)
     * @see Lib_Model::delete()
     */
    public function delete ($params = array())
    {
        $this->_adapter->delete(
            $this->_table,
            $this->_filterParams($params)
        );
        
        return $this;

    } // END function delete

} // END class App_Model
