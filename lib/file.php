<?php
/**
 * Class to contain logic for accessing files
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  File
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Class to contain logic for accessing files
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  File
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Lib_File
extends Lib_Object
{
    /**
     * property to contain the contents of the instance's file contents
     *
     * @var string $_contents
     */
    protected $_contents = '';

    /**
     * tests the existance of a given filename
     *
     * @param string $filename
     * @return boolean
     */
    public function test ($filename)
    {
        if (file_exists($filename)) {
            return true;
        }

        return false;
        
    } // END function test

    /**
     * saves the content of the file to a provided filename
     *
     * @param string filename
     * @return Lib_File $this for a fluent interface
     */
    public function save ($filename)
    {
        
    } // END function save

    /**
     * loads file information to the file instance
     * 
     * @param string $filename
     * @return Lib_File $this for a fluent interface
     */
    public function load ($filename)
    {
        $this->_checkFileExists($filename);

        $this->_contents = file_get_contents($filename);
        
    } // END function load

    /**
     * deletes a file by filename
     *
     * @param string $filename
     * @return Lib_File $this for a fluent interface
     */
    public function delete ($filename)
    {
        $this->__checkFileExists($filename);
        
    } // END function delete

    /**
     * getter for the _contents property
     *
     * @return string
     */
    public function getContents ( )
    {
        return $this->_contents;
        
    } // END function getContents

    /**
     * method to throw an exception if a given filename doesn't exist
     *
     * @param string $filename
     */
    protected function _checkFileExists ($filename)
    {
        if (! file_exists($filename)) {
            throw new Lib_Exception(
                "File doesn't exist"
            );
        }

    } // END function _checkFileExists

} // END class Lib_File