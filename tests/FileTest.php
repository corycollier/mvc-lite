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
class FileTest extends TestCase
{
    /**
     * Local implementation of the setup hook
     */
    public function setUp()
    {
        $this->sut = new File;
    }

    /**
     * test the file class's ability to check if a file exists
     *
     * @param string $filename
     * @dataProvider provideTest
     */
    public function testTest($filename, $expected = false)
    {
        $this->assertSame($this->sut->test($filename), $expected);
    }

    /**
     * provides data to use for testing the file class's ability to test a given
     * file existance
     *
     * @return array
     */
    public function provideTest()
    {
        return array(
            'Bad path, should not exist' => array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'lib', 'file.php'
            )), false),

            'Good path, should exist' => array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'FileTest.php'
            )), true),

            'Good path, bad file, should not exist' => array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'file.php'
            )), false),
        );
    }

    /**
     * tests the file class's abilty to load a file
     *
     * @param string $filename
     * @param boolean $shouldExist
     * @dataProvider provideLoad
     */
    public function testLoad($filename, $shouldExist = false)
    {
        if (! $shouldExist) {
            $this->setExpectedException('Exception');
        }

        $result = $this->sut->load($filename);

        $this->assertInstanceOf('\MvcLite\File', $result);

        $result = $this->getReflectedProperty('\MvcLite\File', 'contents')
            ->getValue($this->sut);

        $this->assertEquals(file_get_contents($filename), $result);
    }

    /**
     * Data provider for MvcLite\FileTest::testLoad().
     *
     * provides data to use for testing the file class's ability to load files
     *
     * @return array
     */
    public function provideLoad()
    {
        return array(
            'Bad path, should not exist' => array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'lib', 'file.php'
            )), false),

            'Good path, should exist' => array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'tests', 'FileTest.php'
            )), true),

            'Good path, bad file, should not exist' => array(implode(DIRECTORY_SEPARATOR, array(
                ROOT, 'file.php'
            )), false),
        );
    }

    /**
     * tests the file class's ability to return it's _contents property
     *
     * @param string $contents
     * @dataProvider provideGetContents
     */
    public function testGetContents($contents)
    {
        $this->getReflectedProperty('\MvcLite\File', 'contents')
            ->setValue($this->sut, $contents);

        $this->assertSame($contents, $this->sut->getContents());
    }

    /**
     * Data provider for MvcLite\FileTest::testGetContents().
     *
     * Data to test the file class's ability to return $contents.
     *
     * @return array
     */
    public function provideGetContents()
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
     * @dataProvider provideSave
     */
    public function testSave($filename, $oldContents = '', $newContents = '')
    {
        // if the directory containing the file doesn't exist, expect an error
        if (! file_exists(dirname($filename))) {
            $this->setExpectedException('Exception');
        } else {
            file_put_contents($filename, $oldContents);
        }

        $this->sut->setContents($newContents);

        $this->sut->save($filename);

        $this->assertEquals($newContents, file_get_contents($filename));

    }

    /**
     * Data provider for MvcLite\FileTest::testSave()
     *
     * Data to use for testing the file class's ability to save data
     *
     * @return array
     */
    public function provideSave()
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
     * Tests the file class's ability to delete files
     *
     * @param string $filename
     *
     * @dataProvider provideDelete
     */
    public function testDelete($filename)
    {
        // if the directory containing the file doesn't exist, expect an error
        if (! file_exists(dirname($filename))) {
            $this->setExpectedException('Exception');
        } else {
            file_put_contents($filename, '');
        }

        $this->sut->delete($filename);

        $this->assertFalse(file_exists($filename));
    }

    /**
     * Data provider for MvcLite\FileTest::testDelete().
     *
     * Data to use for testing the file class's ability to delete files
     *
     * @return array
     */
    public function provideDelete()
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
}
