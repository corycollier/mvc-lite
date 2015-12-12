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
     *
     * @dataProvider provideTest
     */
    public function testTest($expected, $filename)
    {
        $this->assertSame($this->sut->test($filename), $expected);
    }

    /**
     * provides data to use for testing the file class's ability to test a given
     * file existance
     *
     * @return array An array of data to use for testing.
     */
    public function provideTest()
    {
        return [
            'Bad path, should not exist' => [
                'expected' => false,
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'lib', 'file.php'
                ]),
            ],
            'Good path, should exist' => [
                'expected' => true,
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'tests', 'FileTest.php'
                ]),
            ],
            'Good path, bad file, should not exist' => [
                'expected' => false,
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'file.php'
                ]),
            ],
        ];
    }

    /**
     * tests the file class's abilty to load a file
     *
     * @param boolean $expected
     * @param string $filename
     *
     * @dataProvider provideLoad
     */
    public function testLoad($expected, $filename)
    {
        if (! $expected) {
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
     * @return array An array of data to use for testing.
     */
    public function provideLoad()
    {
        return [
            'Bad path, should not exist' => [
                'expected' => false,
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'lib', 'file.php'
                ]),
            ],
            'Good path, should exist' => [
                'expected' => true,
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'tests', 'FileTest.php'
                ]),
            ],
            'Good path, bad file, should not exist' => [
                'expected' => false,
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'file.php'
                ]),
            ],
        ];
    }

    /**
     * Tests the file class's ability to return it's contents property.
     *
     * @param string $contents
     *
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
     * @return array An array of data to use for testing.
     */
    public function provideGetContents()
    {
        return [
            'string contents' => [
                'contents' => 'test1',
            ],
            'whitespace contents' => [
                'contents' => ' ',
            ],
        ];
    }

    /**
     * Tests the file class's ability to save data
     *
     * @param string $filename
     * @param string $oldContents
     * @param string $newContents
     *
     * @dataProvider provideSave
     */
    public function testSave($exists, $contents, $filename)
    {
        // if the directory containing the file doesn't exist, expect an error
        if (! file_exists(dirname($filename))) {
            $this->setExpectedException('Exception');
        }

        $this->sut->setContents($contents);
        $this->sut->save($filename);
        $this->assertEquals($contents, file_get_contents($filename));
    }

    /**
     * Data provider for MvcLite\FileTest::testSave()
     *
     * Data to use for testing the file class's ability to save data
     *
     * @return array An array of data to use for testing the filter
     */
    public function provideSave()
    {
        return [
            'directory exists, expect save' => [
                'exists'   => true,
                'contents' => 'testing',
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'tests', '_file', '.empty',
                ]),
            ],

            'directory does not exist, do not expect save' => [
                'exists'   => false,
                'contents' => '',
                'filename' => implode(DIRECTORY_SEPARATOR, [
                    ROOT, 'baddir', '_file', '.empty',
                ]),
            ],
        ];
    }

    /**
     * Tests the file class's ability to delete files
     *
     * @param string $filename
     *
     * @dataProvider provideDelete
     */
    public function testDelete($exists, $filename)
    {
        // if the directory containing the file doesn't exist, expect an error
        if (! $exists) {
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
     * @return array An array of data to use for testing.
     */
    public function provideDelete()
    {
        return [
            'file exists' => [
                'exists' => true,
                'filename' => implode(DIRECTORY_SEPARATOR, [ROOT, 'tests', '_file', '.empty']),
            ],
            'file does not exist' => [
                'exists' => false,
                'filename' => implode(DIRECTORY_SEPARATOR, [ROOT, 'tests', '.nope']),
            ],
        ];
    }
}
