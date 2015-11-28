<?php
/**
 * Registry
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Registry
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Object\Singleton;

/**
 * Registry
 *
 * Data store for application level storage
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Registry
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Registry
    extends Object\Singleton
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
    public function set($name, $value)
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
    public function get($name)
    {
        return @$this->_data[$name];

    } // END function get

    /**
     * assigns multiple values to the registry in a single method call
     *
     * @param array $values
     * @return Lib_Registry $this
     */
    public function setAll($params = array())
    {
        // itereate through the built results, setting their values to registry
        foreach ($params as $setting => $values) {
            $this->set($setting, $values);
        }

        return $this;

    } // END function setAll

} // END class Lib_Registry
