<?php
/**
 * Test class to test the Lib_File class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  File
 * @since       File available since release 2.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Test class to test the Lib_File class
 *
 * @category    MVCLite
 * @package     Tests
 * @subpackage  File
 * @since       File available since release 2.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class FileTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Local implementation of the setup hook
     */
    public function setUp ( )
    {
        $this->fixture = new File;

    }

    /**
     * test the file class's ability to check if a file exists
     *
     * @param string $filename
     * @dataProvider provide_test
     */
    public function test_test ($filename, $expected = false)
    {
        $this->assertSame($this->fixture->test($filename), $expected);

    }

    /**
     * provides data to use for testing the file class's ability to test a given
     * file existance
     *
     * @return array
     */
    public function provide_test ( )
    {
        return array(
            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'lib', 'file.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', 'FileTest.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'bad-folder', 'file.php'
            )), false),
        );

    }

    /**
     * tests the file class's abilty to load a file
     *
     * @param string $filename
     * @param boolean $shouldExist
     * @dataProvider provide_load
     */
    public function test_load ($filename, $shouldExist = false)
    {
        if (! $shouldExist) {
            $this->setExpectedException('Exception');
        }

        $result = $this->fixture->load($filename);

        $this->assertInstanceOf('File', $result);

        $property = new \ReflectionProperty('File', '_contents');
        $property->setAccessible(true);
        $result = $property->getValue($this->fixture);

        $this->assertEquals(file_get_contents($filename), $result);

    }

    /**
     * provides data to use for testing the file class's ability to load files
     *
     * @return array
     */
    public function provide_load ( )
    {
        return array(
            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'lib', 'file.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', 'FileTest.php'
            )), true),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'bad-folder', 'file.php'
            )), false),
        );

    }

    /**
     * tests the file class's ability to return it's _contents property
     *
     * @param string $contents
     * @dataProvider provide_getContents
     */
    public function test_getContents ($contents)
    {
        $property = new \ReflectionProperty('File', '_contents');
        $property->setAccessible(true);
        $property->setValue($this->fixture, $contents);

        $this->assertSame($contents, $this->fixture->getContents());

    }

    /**
     * provides data to test the file class's ability to return it's _contents
     * property
     *
     * @return array
     */
    public function provide_getContents ( )
    {
        return array(
            array('test1'),
            array(" "),
        );

    }

    /**
     * Tests the file class's ability to save data
     *
     * @param string $filename
     * @param string $oldContents
     * @param string $newContents
     * @dataProvider provide_save
     */
    public function test_save ($filename, $oldContents = '', $newContents)
    {
        // if the directory containing the file doesn't exist, expect an error
        if (! file_exists(dirname($filename))) {
            $this->setExpectedException('Exception');
        } else {
            file_put_contents($filename, $oldContents);
        }

        $this->fixture->setContents($newContents);

        $this->fixture->save($filename);

        $this->assertEquals($newContents, file_get_contents($filename));

    } // END function

    /**
     * provides data to use for testing the file class's ability to save data
     *
     * @return array
     */
    public function provide_save ( )
    {
        return array(
            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', '_file', 'test1'
            )), '', 'test content'),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', '_file', 'test2'
            )), 'old content', 'new content'),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', '_file', '_test_', 'new-file'
            )), 'old content', 'new content'),

        );

    }

    /**
     * tests the file class's ability to delete files
     *
     * @param string $filename
     * @dataProvider provide_delete
     */
    public function test_delete ($filename)
    {
        // if the directory containing the file doesn't exist, expect an error
        if (! file_exists(dirname($filename))) {
            $this->setExpectedException('Exception');
        } else {
            file_put_contents($filename, '');
        }

        $this->fixture->delete($filename);

        $this->assertFalse(file_exists($filename));

    }

    /**
     * provides data to use for testing the file class's ability to delete files
     *
     * @return array
     */
    public function provide_delete ( )
    {
        return array(

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', '_file', 'test1'
            ))),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', '_file', 'test2'
            ))),

            array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'lib', '_file', '_test_', 'new-file'
            ))),
        );

    }

} // END class Tests_Lib_FileTest
