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
{
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


} // END class Model
