<?php
/**
 * Registry
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Config
 * @since       File available since release 3.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Singleton as SingletonTrait;

/**
 * Registry
 *
 * Data store for application level storage
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Config
 * @since       Class available since release 3.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Config extends ObjectAbstract
{
    use SingletonTrait;

    const MSG_ERR_BAD_CONFIG = 'Configuration not loaded. Bad file provided';

    /**
     * Where all the config stuff goes
     *
     * @var array $data
     */
    protected $data = [];

    /**
     * Init hook.
     *
     * @param string|array $config A filepath to an ini file, or an array of configuration options
     *
     * @return MvcLite\Config Returns $this, for object-chaining.
     */
    public function init($config)
    {
        if (!is_array($config)) {
            if (!file_exists($config)) {
                throw new Exception(self::MSG_ERR_BAD_CONFIG);
            }
            $config = parse_ini_file($config);
        }

        $this->setAll($config);
    }

    /**
     * Setter for data.
     *
     * @param string $name The name to store the value as.
     * @param mixed $value The value to store.
     *
     * @return MvcLite\Config Returns $this, for object-chaining.
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * Getter for data.
     *
     * @param string $name The name of what to get.
     *
     * @return MvcLite\Config Returns $this, for object-chaining.
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    /**
     * Assigns multiple values to the config in a single method call.
     *
     * @param array $values A key/value array of things to store.
     *
     * @return MvcLite\Config Returns $this, for object-chaining.
     */
    public function setAll($params = [])
    {
        // itereate through the built results, setting their values to registry
        foreach ($params as $setting => $values) {
            $this->set($setting, $values);
        }

        return $this;
    }
}
