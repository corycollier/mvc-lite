<?php
/**
 * Base View Class
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base View Class
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  View
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_View
extends Lib_Object_Singleton
{
    /**
     * Variables assigned to the view
     *
     * @var array
     */
    protected $_vars = array();

    /**
     * a list of previously loaded view helpers
     *
     * @var array
     */
    protected $_helpers = array();

    /**
     * The name of the view script to be used
     *
     * @var string
     */
    protected $_script;

    /**
     * The name of the layout script to be used
     *
     * @var string
     */
    protected $_layout;

    /**
     * the list of paths used to search for view scripts
     * @var unknown_type
     */
    protected $_viewScriptPaths = array();

    /**
     * method to start the database up
     */
    public function init ( )
    {
        $this->addViewScriptPath(implode(DIRECTORY_SEPARATOR, array(
            APP_PATH,
            'view',
            'scripts',
            'default',
        )));

    } // END function init

    /**
     * Method to add a path to the list of paths used to search for view scripts
     *
     * @param string $path
     * @return Lib_View $this for a fluent interface
     */
    public function addViewScriptPath ($path)
    {
        if (strpos($path, APP_PATH) === false) {
            $path = implode(DIRECTORY_SEPARATOR, array(
                APP_PATH, $path
            ));
        }

        $this->_viewScriptPaths[] = $path;
    }

    /**
     * return the view script paths, reversed to enforce LIFO
     *
     * @return array
     */
    public function getViewScriptPaths ( )
    {
        return array_reverse($this->_viewScriptPaths);
    }

    /**
     * Method to set the script attrubute
     *
     * @param string $path
     * @return Lib_View $this for a fluent interface
     */
    public function setScript ($path)
    {
        $this->_script = (string)$path;

        return $this;

    } // END function setScript

    /**
     * Method to get the script attribute
     *
     * @return string the name of the view script to use
     */
    public function getScript ( )
    {
        return $this->_script;

    } // END function getScript

    /**
     * Method to set the layout attribute
     *
     * @param string $path
     * @return Lib_View $this for a fluent interface
     */
    public function setLayout ($path)
    {
        $this->_layout = (string)$path;

        return $this;

    } // END function setLayout

    /**
     * Returns the layout script name
     *
     * @return string The name of the layout script to use
     */
    public function getLayout ( )
    {
        return $this->_layout;

    } // END function getLayout

    public function getViewScript()
    {
        // iterate through the view paths
        foreach ($this->getViewScriptPaths() as $path) {
            $path = implode(DIRECTORY_SEPARATOR, array(
                $path, $this->getScript() . '.phtml',
            ));
            if (file_exists($path)) {
                return $path;
            }
        }

    } // END function getViewScriptPath

    /**
     * Method to render the view
     */
    public function render ( )
    {
        if (! $this->getScript()) {
            return null;
        }

        ob_start();

        extract($this->_vars);
        include $this->getViewScript();
        $content = ob_get_clean();

        // if there is no layout, then return the content
        if (! $this->getLayout()) {
            return $this->filter($content);
        }

        ob_start();
        include(implode(DIRECTORY_SEPARATOR, array(
            APP_PATH,
            'view',
            'layouts',
            $this->getLayout() . ".phtml",
        )));
        $contents = ob_get_clean();

        return $this->filter($contents);

    } // END function render

    /**
     * Method to filter string input
     *
     * @param $string the unfiltered output
     * @return string the filtered output
     */
    public function filter ($string)
    {
        return $string;

    } // END function filter

    /**
     * setter for the _vars property
     *
     * @param string $var
     * @param unknown_type $value
     * @return Lib_View $this for a fluent interface
     */
    public function set ($var, $value = '')
    {
        $this->_vars[$var] = $value;

        return $this;

    } // END function set

    /**
     * getter for the _vars property
     *
     * @param string $var
     * @return unknown_type
     */
    public function get ($var)
    {
        return @$this->_vars[$var];

    } // END function get

    /**
     * getter for a view helper instance
     *
     * @param string $name
     * @return Lib_View_Helper
     */
    public function getHelper ($name)
    {   // if the helper has already been loaded, just return the instance
        if (@$this->_helpers[$name]) {
            return $this->_helpers[$name];
        }

        foreach (array('App', 'Lib') as $library) {
            // create the full class name
            $className = "{$library}_View_Helper_" . ucfirst("{$name}");

            if (! Lib_Loader::getInstance()->findPath($className)) {
                continue;
            }

            // set the local instance of the class
            $this->_helpers[$name] = new $className($this);

            // return the stored instance of the class
            return $this->_helpers[$name];
        }

        // throw an exception if we get this far
        throw new Lib_Exception(
            "Requested view helper [$name] could not be found"
        );

    } // END function getHelper

} // END class View
