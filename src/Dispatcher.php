<?php
/**
 * Base Dispatcher
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Dispatcher
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Traits\Config as ConfigTrait;
use \MvcLite\Traits\Database as DatabaseTrait;
use \MvcLite\Traits\Request as RequestTrait;
use \MvcLite\Traits\Response as ResponseTrait;
use \MvcLite\Traits\Session as SessionTrait;
use \MvcLite\Traits\Singleton as SingletonTrait;
use \MvcLite\Traits\Filepath as FilepathTrait;

/**
 * Base Dispatcher
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Dispatcher
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Dispatcher extends \MvcLite\ObjectAbstract
{
    use ConfigTrait;
    use DatabaseTrait;
    use RequestTrait;
    use ResponseTrait;
    use SessionTrait;
    use SingletonTrait;
    use FilepathTrait;

    /**
     * placeholder for the controller object
     *
     * @var Lib_Controller
     */
    protected $controller;

    protected $loader;

    /**
     * an overridable list of environments allowed for configuration
     *
     * @var array $_environments
     */
    protected $environments = [
        'production',
        'staging',
        'development',
        'testing',
    ];

    /**
     * Initialize the dispatcher.
     *
     * @return \MvcLite\Dispatcher Returns $this for object-chaining.
     */
    public function init($loader)
    {
        try {
            $this->loader = $loader;
            $this->getConfig()->init($this->filepath(CONFIG_PATH . '/app.ini'));
            $this->getRequest()->init();
            $this->getDatabase()->init();
            $this->getResponse()->init();
        } catch (Exception $exception) {
            $this->getRequest()->setParams([
                'controller'    => 'error',
                'action'        => 'database',
            ]);
        }

        return $this;
    }

    /**
     * dispatch
     *
     * This is the main entry point for dispatching a request
     */
    public function dispatch()
    {
        $request    = $this->getRequest();
        $params     = $request->getParams();
        $controller = $this->translateControllerName($params['controller']);
        $action     = $this->translateActionName($params['action']);
        $response   = $this->getResponse();
        $request    = $this->getRequest();

        // If the controller doesn't exist, or the action isn't callable,
        // use the error controller
        try {
            // First, make sure the controller is callable.
            $result = $this->loader->loadClass($controller);
            if (is_null($result)) {
                throw new Exception('Invalid controller specified');
            }

            // Now, instantiate the controller and try to run it's action.
            $this->controller = new $controller;
            if (! method_exists($controller, $action)) {
                throw new Exception('Action not available');
            }
        } catch (Exception $exception) {
            $request->setParam('controller', 'error');
            $request->setParam('action', 'error');
            $request->setParam('error', $exception->getMessage());
            $this->controller = new \App\ErrorController;
            $action = 'errorAction';
        }

        // run the init hook
        $this->controller->init();

        // run the preDispatch hook
        $this->controller->preDispatch();

        // run the requested action on the requested controller
        call_user_func([$this->controller, $action]);

        // run the postDispatch hook
        $this->controller->postDispatch();

        // send the response
        $body = $this->controller->getView()->render();
        $response->setBody($body);

        // if this is an actual request, not a unit test, send headers
        if (PHP_SAPI != 'cli') {
            $response->sendHeaders();
        }

        // echo the body
        echo $response->getBody();
    }

    /**
     * Translates a raw request param for a controller into a class name
     *
     * @param string $controller
     * @return string
     */
    protected function translateControllerName($controller = '')
    {
        $filter = new FilterChain;
        $filter->addFilter(new Filter\DashtoCamelcase);
        $filter->addFilter(new Filter\StringToProper);

        $controller = $filter->filter($controller);

        // return the controller class name.
        return '\\App\\' . $controller . 'Controller';
    }

    /**
     *
     * Translates a raw request param for an action into an action name.
     *
     * @param string $action
     * @return string
     */
    protected function translateActionName($action = '')
    {
        $words = explode('-', $action);
        foreach ($words as $i => $word) {
            if (! $i) {
                $words[$i] = strtolower($word);
                continue;
            }
            $words[$i] = ucwords($word);
        }

        $action = implode('', $words);

        return "{$action}Action";

    }

    /**
     * method to parse an array and create nested arrays where necessary.
     *
     * @param array $config
     * @return array
     */
    public function parseConfiguration($config = [])
    {
        $results = [];

        // iterate through the parsed INI file
        foreach ($config as $key => $values) {
            $parts = explode('.', $key);
            if (! array_key_exists($parts[0], $results)) {
                $results[$parts[0]] = [];
            }

            $results[$parts[0]][$parts[1]] = $values;
        }

        return $results;

    }

    /**
     * returns the provide value, if it's in the environments list.
     *
     * @param string $value
     * @return string
     */
    public function getApplicationEnv($value = null)
    {
        if (in_array($value, $this->environments)) {
            return $value;
        }

        return current($this->environments);

    }
}
