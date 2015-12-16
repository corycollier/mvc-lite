<?php
/**
 * Base View Class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use MvcLite\Traits\Singleton as SingletonTrait;
use MvcLite\Traits\Filepath as FilepathTrait;
use MvcLite\Traits\Loader as LoaderTrait;

/**
 * Base View Class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  View
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class View extends ObjectAbstract
{
    use SingletonTrait;
    use FilepathTrait;
    use LoaderTrait;

    /**
     * Variables assigned to the view
     *
     * @var array
     */
    protected $vars = [];

    /**
     * a list of previously loaded view helpers
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * The name of the view script to be used
     *
     * @var string
     */
    protected $script;

    /**
     * The name of the layout script to be used
     *
     * @var string
     */
    protected $layout;

    /**
     * The list of paths used to search for view scripts.
     *
     * @var array
     */
    protected $viewScriptPaths = [];

    /**
     * method to start the view.
     */
    public function init()
    {
    }

    /**
     * Method to add a path to the list of paths used to search for view scripts
     *
     * @param string $path
     * @return MvcLite\View $this for object-chaining.
     */
    public function addViewScriptPath($path)
    {
        if (strpos($path, APP_PATH) === false) {
            $path = $this->filepath([APP_PATH, $path]);
        }

        $this->viewScriptPaths[] = $path;

        return $this;
    }

    /**
     * return the view script paths, reversed to enforce LIFO
     *
     * @return array
     */
    public function getViewScriptPaths()
    {
        return array_reverse($this->viewScriptPaths);
    }

    /**
     * Method to set the script attrubute
     *
     * @param string $path
     *
     * @return MvcLite\View $this for object-chaining.
     */
    public function setScript($path)
    {
        $this->script = (string)$path;

        return $this;
    }

    /**
     * Method to get the script attribute
     *
     * @return string the name of the view script to use
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Method to set the layout attribute
     *
     * @param string $path
     *
     * @return MvcLite\View $this for object-chaining.
     */
    public function setLayout($path)
    {
        $this->layout = (string)$path;

        return $this;
    }

    /**
     * Returns the layout script name
     *
     * @return string The name of the layout script to use
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Gets the view script
     *
     * @return string The path to the view script.
     */
    public function getViewScript()
    {
        $paths = $this->getViewScriptPaths();
        $script = $this->getScript();
        // iterate through the view paths
        foreach ($paths as $path) {
            $path = $this->filepath([$path, $script . '.phtml']);
            if (file_exists($path)) {
                return $path;
            }
        }
    }

    /**
     * Method to render the view
     *
     * @return string The result of the rendering
     */
    public function render()
    {
        $script       = $this->getScript();
        $viewScript   = $this->getViewScript();
        $layoutScript = $this->getLayout() . '.phtml';

        if (! $this->getScript() || ! $this->getViewScript()) {
            return null;
        }

        ob_start();
        extract($this->vars);
        include $viewScript;
        $content = ob_get_clean();

        // if there is no layout, then return the content
        if (! $this->getLayout()) {
            return $this->filter($content);
        }

        ob_start();
        $layout = $this->filepath([APP_PATH, 'View', 'layouts', $layoutScript]);
        include($layout);
        $contents = ob_get_clean();

        return $this->filter($contents);
    }

    /**
     * Method to filter string input
     *
     * @param $string the unfiltered output
     *
     * @return string the filtered output
     */
    public function filter($string)
    {
        return $string;
    }

    /**
     * Setter for the _vars property.
     *
     * @param string $var
     * @param unknown_type $value
     *
     * @return MvcLite\View $this for object-chaining.
     */
    public function set($var, $value = '')
    {
        $this->vars[$var] = $value;
        return $this;
    }

    /**
     * getter for the _vars property
     *
     * @param string $var
     *
     * @return mixed
     */
    public function get($var)
    {
        if (array_key_exists($var, $this->vars)) {
            return $this->vars[$var];
        }
    }

    /**
     * getter for a view helper instance
     *
     * @param string $name
     *
     * @return MvcLite\View_Helper
     */
    public function getHelper($name)
    {
        // if the helper has already been loaded, just return the instance
        if (@$this->helpers[$name]) {
            return $this->helpers[$name];
        }

        foreach (['App', 'MvcLite'] as $library) {
            // create the full class name
            $className = "\\{$library}\\View\\Helper\\" . ucfirst("{$name}");

            // set the local instance of the class
            $this->helpers[$name] = new $className($this);

            // return the stored instance of the class
            return $this->helpers[$name];
        }

        // throw an exception if we get this far
        throw new Exception("Requested view helper [$name] could not be found");
    }
}
