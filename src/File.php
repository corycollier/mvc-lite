<?php
/**
 * Class to contain logic for accessing files
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  File
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Filepath as FilepathTrait;

/**
 * Class to contain logic for accessing files
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  File
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class File extends ObjectAbstract
{
    use FilepathTrait;

    /**
     * The contents of the instance's file.
     *
     * @var string $_contents
     */
    protected $contents = '';

    /**
     * tests the existance of a given filename
     *
     * @param string $filename
     * @return boolean
     */
    public function test($filename)
    {
        if (file_exists($filename)) {
            return true;
        }

        return false;
    }

    /**
     * Saves the content of the file to a provided filename.
     *
     * @param string $filename The full path and name of the file.
     *
     * @return MvcLite\File $this for object-chaining.
     */
    public function save($filename)
    {
        if (! file_exists(dirname($filename))) {
            throw new Exception(
                "Directory [{$filename}] does not exist. Cannot save file"
            );
        }

        file_put_contents($filename, $this->getContents());

        return $this;
    }

    /**
     * loads file information to the file instance
     *
     * @param string $filename The full path and name of the file.
     *
     * @return MvcLite\File $this for object-chaining.
     */
    public function load($filename)
    {
        $this->checkFileExists($filename);

        $this->setContents(file_get_contents($filename));

        return $this;

    }

    /**
     * Deletes a file by filename.
     *
     * @param string $filename The full path and name of the file.
     *
     * @return MvcLite\File $this for object-chaining.
     */
    public function delete($filename)
    {
        $this->checkFileExists($filename);

        unlink($filename);

        return $this;
    }

    /**
     * Getter for the _contents property
     *
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Setter for the contents property.
     *
     * @param string|null $contents
     *
     * @return MvcLite\File $this for object-chaining.
     */
    public function setContents($contents = null)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * method to throw an exception if a given filename doesn't exist
     *
     * @param string $filename
     */
    protected function checkFileExists($filename)
    {
        if (! $this->test($filename)) {
            throw new Exception("File doesn't exist");
        }
    }
}
