<?php
/**
 * TestCase Class.
 *
 * @category   PHP
 * @package    MVCLite
 * @subpackage Tests
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * TestCase Class.
 *
 * @category   PHP
 * @package    MVCLite
 * @subpackage Tests
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Subject Under Testing.
     *
     * @var mixed
     */
    protected $sut;

    /**
     * Gets an instance of \ReflectionProperty, for a given class and property.
     *
     * @param string $class The class to perform reflection on.
     * @param string $property The property to reflect on.
     *
     * @return \ReflectionProperty
     */
    protected function getReflectedProperty($class, $property)
    {
        $property = new \ReflectionProperty($class, $property);
        $property->setAccessible(true);
        return $property;
    }

    /**
     * Gets an instance of \ReflectionMethod, for a given class and method.
     *
     * @param string $class The class to perform reflection on.
     * @param string $method The method to reflect on.
     *
     * @return \ReflectionMethod
     */
    protected function getReflectedMethod($class, $method)
    {
        $method = new \ReflectionMethod($class, $method);
        $method->setAccessible(true);
        return $method;
    }
}
