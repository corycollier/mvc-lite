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
    public function test_handle ($errno, $errstr, $errfile = null, $errline = null, 
        $errcontext = array(), $isException = false)
    {
        
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
                E_ERROR, 'fatal error',
            )
        );
        
    } // END function provide_handle


} // END class Tests_Lib_ErrorTest