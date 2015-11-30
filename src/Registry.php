<?php
/**
 * Registry
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Registry
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Traits\Singleton as SingletonTrait;

/**
 * Registry
 *
 * Data store for application level storage
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Registry
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Registry extends ObjectAbstract
{
    use SingletonTrait;

    /**
     * Where all the registry stuff goes
     *
     * @var array $_data
     */
    protected $data = array();

    /**
     * method to store data in the registry
     *
     * @param string $name
     * @param unknown_type $value
     * @return Lib_Registry $this
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * getter for data stored
     *
     * @param string $name
     * @return Lib_Registry $this
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

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
    }
}
