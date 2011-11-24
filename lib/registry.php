<?php
/**
 * Registry
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Registry
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Registry
 * 
 * Data store for application level storage
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Registry
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Registry
extends Lib_Object_Singleton
{
    /**
     * Where all the registry stuff goes
     *
     * @var array $_data
     */
    protected $_data = array();

    /**
     * method to store data in the registry
     *
     * @param string $name
     * @param unknown_type $value
     * @return Lib_Registry $this
     */
    public function set ($name, $value)
    {
        $this->_data[$name] = $value;

        return $this;

    } // END function set

    /**
     * getter for data stored
     *
     * @param string $name
     * @return Lib_Registry $this
     */
    public function get ($name)
    {
        return @$this->_data[$name];

    } // END function get

} // END class Lib_Registry
