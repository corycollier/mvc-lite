<?php
/**
 * Base Model
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base Model
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

abstract class Lib_Model
extends Lib_Object
implements Iterator
{
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
     * Defining a read method required to be implemented by children
     * 
     * @param array $params
     */
    abstract public function read ($params = array());

    /**
     * Defining a create method required to be implemented by children
     * 
     * @param array $params
     */
    abstract public function create ($params = array());

    /**
     * Defining a delete method required to be implemented by children
     * 
     * @param array $params
     */
    abstract public function edit ($params = array());

    /**
     * Defining a edit method required to be implemented by children
     * 
     * @param array $params
     */
    abstract public function delete ($params = array());
    
    /**
     * Defining a create method required to be implemented by children
     * 
     * @param array $params
     */
    abstract public function find ($params = array());

    /**
     * (non-PHPdoc)
     * @see Iterator::current()
     */
    public function current ( )
    {   // return the data at the current cursor value
        return $this->_data[$this->_cursor];
        
    } // END function current
    
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
        return valid($this->_data[$this->_cursor]);
        
    } // END function valid

} // END class Model
