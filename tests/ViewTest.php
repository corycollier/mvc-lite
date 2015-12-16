<?php
/**
 * Unit tests for the \MvcLite\View class
 *
 * @category    PHP
 * @package     MVCLite
 * @subpackage  Tests
 * @since       File available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Unit tests for the \MvcLite\View class
 *
 * @category    PHP
 * @package     MVCLite
 * @subpackage  Tests
 * @since       Class available since release 1.0.6
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class ViewTest extends TestCase
{

    /**
     * The setup method, called before each test
     */
    public function setUp()
    {
        $this->sut = View::getInstance();
    }

    /**
     * Tests MvcLite\View::init.
     */
    public function testInit()
    {
        $this->sut->init();
    }

    /**
     * tests the filter method of the view object
     */
    public function testFilter()
    {
        $unfiltered = 'asdasdfads';
        $expected   = 'asdasdfads';
        $result     = $this->sut->filter($unfiltered);

        $this->assertSame($expected, $result);
    }

    /**
     * test the setting and getting of variables to the view.
     *
     * @param array $variables The variables to use for testing.
     *
     * @dataProvider provideVariables
     */
    public function testSetAndGet($variables = [])
    {
        foreach ($variables as $name => $value) {
            $this->sut->set($name, $value);
        }

        foreach ($variables as $name => $value) {
            $result = $this->sut->get($name);
            $this->assertSame($result, $value);
        }

        $this->assertNull($this->sut->get('bad-value'));
    }

    /**
     * method to provide data for test methods
     *
     * @return array
     */
    public function provideVariables()
    {
        return [
            'first test' => [
                'variables' => [
                    'var1'  => 'val1',
                    'var2'  => 'val2',
                    'var3'  => 'val3',
                ],
            ]
        ];
    }

    /**
     * Tests the MvcLite\View::getViewScript method.
     *
     * @dataProvider provideGetViewScript
     */
    public function testGetViewScript($expected, $script, $filepath, $paths)
    {
        $sut = $this->getMockBuilder('\MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(['getViewScriptPaths', 'getScript', 'filepath'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getViewScriptPaths')
            ->will($this->returnValue($paths));

        $sut->expects($this->once())
            ->method('getScript')
            ->will($this->returnValue($script));

        $sut->expects($this->exactly(count($paths)))
            ->method('filepath')
            ->will($this->returnValue($filepath));

        $result = $sut->getViewScript();
        $this->assertEquals($expected, $result);
    }

    /**
     * Data Provider for testGetViewScript.
     *
     * @return array An array of data to use for testing.
     */
    public function provideGetViewScript()
    {
        return [
            'file does not exist' => [
                'expected'  => '',
                'script'    => '',
                'filepaths' => '',
                'paths'     => [''],
            ],

            'file does exist' => [
                'expected'  => __FILE__,
                'script'    => '',
                'filepaths' => __FILE__,
                'paths'     => [''],
            ],
        ];
    }

    /**
     * Tests MvcLite\View::addViewScriptPath
     *
     * @dataProvider provideAddViewScriptPath
     */
    public function testAddViewScriptPath($path)
    {
        $sut = $this->getMockBuilder('MvcLite\View')
            ->disableOriginalConstructor()
            ->setMethods(['filepath'])
            ->getMock();

        $sut->expects($this->any())
            ->method('filepath')
            ->will($this->returnValue($path));

        $result = $sut->addViewScriptPath($path);
        $this->assertSame($sut, $result);

    }

    /**
     * Data Provider for testAddViewScriptPath.
     *
     * @return array An array of data to use for testing.
     */
    public function provideAddViewScriptPath()
    {
        return [
            'path not in APP_PATH' => [
                'path'     => '/some/path',
            ],

            'path in APP_PATH' => [
                'path'     => APP_PATH . '/some/path',
            ]
        ];
    }
}
