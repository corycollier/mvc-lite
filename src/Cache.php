<?php
/**
 * Defines the caching mechanism
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Object\Singleton;

/**
 * Defines the caching mechanism
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Cache
    extends Object\Singleton
{
    /**
     * property to store the configuration of the cache object
     *
     * @var array $_config
     */
    protected $_config;

    /**
     * initialize the cache instance
     *
     * @return Lib_Cache $this for a fluent interface
     */
    public function init (array $data = array())
    {
        $data = array_merge(array(
            'prefix'    => 'cache',
        ), $data);

        $this->_config = $data;

        return $this;

    } // END function init

    /**
     * stores data from an object.
     *
     * The object is required, to determine the namespacing of the storage
     *
     * @param Lib_Object $object
     * @param string $name
     * @param unknown_type $data
     * @return Lib_Cache $this for a fluent interface
     */
    public function set (Lib_Object $object, $name, $data)
    {
        $key = $this->_getCacheKey($object, $name);

        $file = $this->_getFilePath($key);

        file_put_contents($file, serialize($data));

        return $this;

    } // END function store

    /**
     * returns the relative filepath for a given filename
     *
     * @param string $filename
     * @return string
     */
    protected function _getFilePath ($filename)
    {
        return implode(DIRECTORY_SEPARATOR, array(
            $this->_config['directory'],
            $filename,
        ));

    } // END function _getFilePath

    /**
     * gets data for an object, and a value
     *
     * The object is required, to determine the namespacing of the storage
     *
     * @param Lib_Object $object
     * @param string $name
     * @return unknown_type
     */
    public function get (Lib_Object $object, $name)
    {
        $key = $this->_getCacheKey($object, $name);

        $file = $this->_getFilePath($key);

        $data = unserialize(file_get_contents($file));

        return $data;

    } // END function get

    /**
     * returns a string to namespace a cache entry
     *
     * @param Lib_Object $object
     * @param string $name
     * @return string
     */
    protected function _getCacheKey (Lib_Object $object, $name)
    {
        static $filter;

        if (! $filter) {
            $filter = new Lib_Filter;
            $filter->addFilter(new Lib_Filter_UnderscoreToDash);
            $filter->addFilter(new Lib_Filter_StringToLower);
        }

        return $filter->filter(implode('_', array(
            @$this->_config['prefix'],
            get_class($object),
            $name,
        )));

    } // END function _getNamespace

} // END class Lib_Cache
