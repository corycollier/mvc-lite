<?php
/**
 * Defines the caching mechanism
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Filter;
use \MvcLite\Traits\Singleton as SingletonTrait;
use \MvcLite\Traits\Filepath as FilepathTrait;

/**
 * Defines the caching mechanism
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Cache
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Cache extends ObjectAbstract
{
    use SingletonTrait;
    use FilepathTrait;

    /**
     * property to store the configuration of the cache object
     *
     * @var array $config
     */
    protected $config;

    /**
     * initialize the cache instance
     *
     * @return \MvcLite\Cache $this for object-chaining.
     */
    public function init(array $data = [])
    {
        $defaults = ['prefix' => 'cache'];
        $this->config = array_merge($defaults, $data);
        return $this;
    }

    /**
     * stores data from an object.
     *
     * The object is required, to determine the namespacing of the storage
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     * @param unknown_type $data
     *
     * @return \MvcLite\Cache $this for object-chaining.
     */
    public function set(ObjectAbstract $object, $name, $data)
    {
        $key = $this->getCacheKey($object, $name);
        $file = $this->getFilePath($key);
        file_put_contents($file, serialize($data));

        return $this;
    }

    /**
     * returns the relative filepath for a given filename
     *
     * @param string $filename
     * @return string
     */
    protected function getFilePath($filename)
    {
        $this->filepath($this->config['directory'] . '/' . $filename);
    }

    /**
     * gets data for an object, and a value
     *
     * The object is required, to determine the namespacing of the storage
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     *
     * @return mixed
     */
    public function get(ObjectAbstract $object, $name)
    {
        $key  = $this->getCacheKey($object, $name);
        $file = $this->getFilePath($key);
        $data = unserialize(file_get_contents($file));

        return $data;
    }

    /**
     * Returns a string to namespace a cache entry.
     *
     * @param \MvcLite\ObjectAbstract $object
     * @param string $name
     *
     * @return string
     */
    protected function getCacheKey(ObjectAbstract $object, $name)
    {
        static $filter;

        if (! $filter) {
            $filter = new FilterChain;
            $filter->addFilter(new Filter\UnderscoreToDash);
            $filter->addFilter(new Filter\StringToLower);
        }

        return $filter->filter(implode('_', [
            $this->config['prefix'],
            get_class($object),
            $name,
        ]));
    }
}
