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
use MvcLite\Traits\Request as RequestTrait;
use MvcLite\Traits\Session as SessionTrait;
use MvcLite\Traits\Config as ConfigTrait;

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
    use RequestTrait;
    use SessionTrait;
    use ConfigTrait;

    /**
     * Constants
     */
    const DEFAULT_FORMAT = 'html';
    const ERR_BAD_HELPER_NAME = "Requested view helper [%s] could not be found";
    const ERR_BAD_FORMAT = "The format given [%s] is not supported";

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
     * The format type for the view
     *
     * @var string
     */
    protected $format = self::DEFAULT_FORMAT;

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
     * Getter for the format.
     *
     * @return string The format for the view.
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Setter for the format.
     *
     * @param string $format The format for the view.
     *
     * @return MvcLite\View Returns $this for object-chaining.
     */
    public function setFormat($format)
    {
        $formats = [
            'html', 'json', 'xml', 'text'
        ];

        if (!in_array($format, $formats)) {
            throw new Exception(sprintf(self::ERR_BAD_FORMAT, $format));
        }

        $this->format = $format;

        return $this;
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
        $format = $this->getFormat();
        // iterate through the view paths
        foreach ($paths as $path) {
            $path = $this->filepath([$path, $script . '.' . $format . '.php']);
            if (file_exists($path)) {
                return $path;
            }
        }
    }

    /**
     * Returns the layout script;
     * @return string The filename of the layout script.
     */
    public function getLayoutScript()
    {
        $format      = $this->getFormat();
        $layoutScript = $this->getLayout() . '.' . $format . '.php';
        return $this->filepath([
            APP_PATH, 'View', 'layouts', $layoutScript
        ]);
    }

    /**
     * Method to render the view
     *
     * @return string The result of the rendering
     */
    public function render()
    {
        $format       = $this->getFormat();
        $script       = $this->getScript();
        $viewScript   = $this->getViewScript();
        $layoutScript = $this->getLayoutScript();

        if (! $this->getScript() || ! $this->getViewScript()) {
            return null;
        }

        ob_start();
        include $viewScript;
        $content = ob_get_clean();
        $this->set('content', $content);

        // if there is no layout, then return the content
        if (! $layoutScript || $format !== 'html') {
            return $this->filter($content);
        }

        ob_start();
        include $layoutScript;
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
        $loader = $this->getLoader();
        // if the helper has already been loaded, just return the instance
        if (@$this->helpers[$name]) {
            return $this->helpers[$name];
        }

        foreach (['App', 'MvcLite'] as $library) {
            // create the full class name
            $className = "\\{$library}\\View\\Helper\\" . ucfirst("{$name}");

            if ($loader->loadClass($className)) {
                $this->helpers[$name] = new $className($this);
                return $this->helpers[$name];
            }
        }

        // throw an exception if we get this far
        throw new Exception(sprintf(self::ERR_BAD_HELPER_NAME, $name));
    }
}
