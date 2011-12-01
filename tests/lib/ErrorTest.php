<?php
/**
 * Unit Test class for testing the Lib_Error functionality
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Tests
 * @since       File available since release 1.2.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Unit Test class for testing the Lib_Error functionality
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Tests
 * @since       File available since release 1.2.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_ErrorTest
extends PHPUnit_Framework_TestCase
{
    /**
     * setup hook to setup the error handling instance
     */
    public function setUp ( )
    {
        $this->fixture = Lib_Error::getInstance();
        
    } // END function setUp

    /**
     * Test the Lib_Error class's ability to handle errors
     * 
     * @param integer $errno
     * @param string $errstr
     * @param string|null $errfile
     * @param integer|null $errline
     * @param array|null $errcontext
     * @param boolean $isException
     * @dataProvider provide_handle
     */
    public function test_handle ($errno, $errstr, $errfile = null, 
        $errline = null,  $errcontext = array(), $isException = false)
    {
        if (in_array($errno, array(E_USER_ERROR, E_ERROR, E_WARNING ))) {
            $this->setExpectedException('ErrorException');
        }

        $result = $this->fixture->handle(
            $errno, $errstr, $errfile, $errline, $errcontext
        );

        $this->assertNull($result);
        
    } // END function test_handle

    /**
     * provide data to use to test the Lib_Error class's ability to handle errors
     *
     * @return array
     */
    public function provide_handle ( )
    {
        return array(
            array(
                E_USER_ERROR, 'fatal error',
            ),
            array(
                E_WARNING, 'fatal error',
            ),
            array(
                E_ERROR, 'fatal error',
            ),
            array(
                E_ERROR, 'fatal error',
            ),
        );
        
    } // END function provide_handle

    /**
     * Tests the getErrors method of the error handler
     *
     * @param array $expected
     * @dataProvider provide_getErrors
     */
    public function test_getErrors ($expected = array())
    {
        $property = new ReflectionProperty('Lib_Error', '_errors');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $expected);

        $this->assertSame($expected, $this->fixture->getErrors());
        
    } // END function test_getErrors

    /**
     * Provides data for testing the getErrors method of the error handler
     *
     * @return array
     */
    public function provide_getErrors ( )
    {
        return array(
            array(
                array(array(
                    'errno'         => E_ERROR,
                    'errstr'        => 'the error',
                    'errfile'       => 'file.php',
                    'errline'       => 104,
                )),
                array(array(
                    'errno'         => E_ERROR,
                    'errstr'        => 'the error',
                    'errfile'       => 'file.php',
                    'errline'       => 4,
                )),
                array(array(
                    'errno'         => E_WARNING,
                    'errstr'        => 'the error',
                    'errfile'       => 'file.php',
                    'errline'       => 104,
                )),
                array(array(
                    'errno'         => E_ERROR,
                    'errstr'        => 'the error',
                    'errfile'       => 'other.php',
                    'errline'       => 104,
                )),
            ),
        );
        
    } // END function provide_getErrors

} // END class Tests_Lib_ErrorTest