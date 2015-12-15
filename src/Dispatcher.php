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

use MvcLite\Traits\Config as ConfigTrait;
use MvcLite\Traits\Request as RequestTrait;
use MvcLite\Traits\Response as ResponseTrait;
use MvcLite\Traits\Session as SessionTrait;
use MvcLite\Traits\Singleton as SingletonTrait;
use MvcLite\Traits\Filepath as FilepathTrait;
use MvcLite\Traits\Loader as LoaderTrait;
use MvcLite\Traits\FilterChain as FilterChainTrait;

/**
 * Base Dispatcher
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Dispatcher
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Dispatcher extends ObjectAbstract
{
    use ConfigTrait;
    use RequestTrait;
    use ResponseTrait;
    use SessionTrait;
    use SingletonTrait;
    use FilepathTrait;
    use LoaderTrait;
    use FilterChainTrait;

    /**
     * Initialize the dispatcher.
     *
     * @return MvcLite\Dispatcher Returns $this for object-chaining.
     */
    public function init($loader)
    {
        $this->setLoader($loader);
        $this->getConfig()->init($this->filepath(CONFIG_PATH . '/app.ini'));
        $this->getRequest()->init();
        $this->getResponse()->init();
        // $this->getView()->setLoader($loader);

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
        $loader     = $this->getLoader();

        // If the controller doesn't exist, or the action isn't callable,
        // use the error controller
        try {
            // First, make sure the controller is callable.
            $result = $loader->loadClass($controller);

            if (is_null($result)) {
                throw new Exception('Invalid controller specified');
            }


            // Now, instantiate the controller and try to run it's action.
            $controller = new $controller;
            if (! method_exists($controller, $action)) {
                throw new Exception('Action not available');
            }
        } catch (Exception $exception) {
            $this->handleDispatchException($exception);
            $controller = new \App\ErrorController;
            $action = 'errorAction';
            $controller->getView()->set('error', $exception);
        }

        // run the init hook
        $controller->init()->preDispatch();

        // run the requested action on the requested controller
        call_user_func([$controller, $action]);

        // run the postDispatch hook
        $controller->postDispatch();

        // send the response
        $body = $controller->getView()->render();
        $response->setBody($body);

        // if this is an actual request, not a unit test, send headers
        $response->sendHeaders();

        // echo the body
        echo $response->getBody();
    }

    /**
     * Handle exceptions that occur during dispatch.
     *
     * @param  MvcLite\Exception $exception The exception that was thrown.
     */
    protected function handleDispatchException($exception)
    {
        $request = $this->getRequest();
        $request->setParam('controller', 'error');
        $request->setParam('action', 'error');
        $request->setParam('error', $exception->getMessage());
    }

    /**
     * Translates a raw request param for a controller into a class name.
     *
     * @param string $controller
     * @return string
     */
    protected function translateControllerName($controller = '')
    {
        $filter = $this->getFilterChain(['DashToCamelcase', 'StringToProper']);
        $controller = $filter->filter($controller);
        return '\\App\\' . $controller . 'Controller';
    }

    /**
     * Translates a raw request param for an action into an action name.
     *
     * @param string $action
     *
     * @return string
     */
    protected function translateActionName($action = '')
    {
        $filter = $this->getFilterChain(['DashToCamelcase']);
        $action = $filter->filter($action);
        return "{$action}Action";
    }
}
