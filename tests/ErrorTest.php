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

namespace MvcLite;

/**
 * Unit Test class for testing the Lib_Error functionality
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Tests
 * @since       File available since release 1.2.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class ErrorTest extends TestCase
{
    /**
     * setup hook to setup the error handling instance
     */
    public function setUp()
    {
        $this->sut = Error::getInstance();
    }

    /**
     * Test the Lib_Error class's ability to handle errors
     *
     * @param integer $errno
     * @param string $errstr
     * @param string|null $errfile
     * @param integer|null $errline
     * @param array|null $errcontext
     * @param boolean $isException
     * @dataProvider provideHandle
     */
    public function testHandle(
        $errno,
        $errstr,
        $errfile = null,
        $errline = null,
        $errcontext = array(),
        $isException = false
    ) {
        if (in_array($errno, array(E_USER_ERROR, E_ERROR, E_WARNING ))) {
            $this->setExpectedException('\ErrorException');
        }

        $result = $this->sut->handle($errno, $errstr, $errfile, $errline, $errcontext);

        $this->assertNull($result);
    }

    /**
     * provide data to use to test the Lib_Error class's ability to handle errors
     *
     * @return array
     */
    public function provideHandle()
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
    }

    /**
     * Tests the getErrors method of the error handler
     *
     * @param array $expected
     * @dataProvider provideGetErrors
     */
    public function testGetErrors($expected = array())
    {
        $this->getReflectedProperty('\MvcLite\Error', 'errors')
            ->setValue($this->sut, $expected);

        $this->assertSame($expected, $this->sut->getErrors());
    }

    /**
     * Provides data for testing the getErrors method of the error handler
     *
     * @return array
     */
    public function provideGetErrors()
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
    }
}
