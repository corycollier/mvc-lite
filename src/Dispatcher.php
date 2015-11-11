<?php
/**
 * Base Dispatcher
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Dispatcher
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Base Dispatcher
 *
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Dispatcher
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Lib_Dispatcher
extends Lib_Object_Singleton
{
    /**
     * an overridable list of environments allowed for configuration
     *
     * @var array $_environments
     */
    protected $_environments = array(
        'production',
        'staging',
        'development',
        'testing',
    );

    /**
     * placeholder for the request object
     *
     * @var Lib_Request
     */
    protected $_request;

    /**
     * placeholder for the response object
     *
     * @var Lib_Response
     */
    protected $_response;

    /**
     * placeholder for the database object
     *
     * @var Lib_Database
     */
    protected $_database;
    
    /**
     * placeholder for the view object
     *
     * @var Lib_View
     */
    protected $_view;

    /**
     * placeholder for the controller object
     *
     * @var Lib_Controller
     */
    protected $_controller;


    public function init ( )
    {
        throw new Lib_Exception('This method must be implemented in the app');
    }

    /**
     * bootstrap the application before dispatching
     *
     * @return Lib_Dispatcher $this for a fluent interface
     */
    public function bootstrap ( )
    {
        // setup the singletons
        $this->_request = Lib_Request::getInstance();
        $this->_response = Lib_Response::getInstance();
        $this->_database = Lib_Database::getInstance();
        $this->_view = Lib_View::getInstance();

        try {
            $this->_request->init();
            $this->_database->init();
            $this->_response->init();
            $this->_view->init();
        }
        catch (Exception $exception) {
            $this->_request->setParams(array(
                'controller'    => 'error',
                'action'        => 'database',
            ));
        }

        return $this;

    } // END function bootstrap

    /**
     * dispatch
     *
     * This is the main entry point for dispatching a request
     */
    public function dispatch ( )
    {
        // if ( PHP_SAPI == 'cli' ) {
        //     return;
        // }

        $controller = $this->_translateControllerName(
            $this->_request->getParam('controller')
        );

        $action = strtolower(
            $this->_translateActionName($this->_request->getParam('action'))
        );

        // If the controller doesn't exist, or the action isn't callable,
        // use the error controller
        try {
            $this->_controller = new $controller;
            if (! method_exists($controller, $action)) {
                throw new Lib_Exception(
                    'Action not available'
                );
            }
        }
        catch (Exception $exception) {
            $this->_request->setParam('controller', 'error');
            $this->_request->setParam('action', 'error');
            $this->_controller = new App_Controller_Error;
            $action = 'errorAction';
        }

        // run the init hook
        $this->_controller->init();

        // run the preDispatch hook
        $this->_controller->preDispatch();

        // run the requested action on the requested controller
        call_user_func(array($this->_controller, $action));

        // run the postDispatch hook
        $this->_controller->postDispatch();

        // send the response
        $this->_response->setBody($this->_controller->getView()->render());

        // if this is an actual request, not a unit test, send headers
        if ( PHP_SAPI != 'cli' ) $this->_response->sendHeaders();

        // echo the body
        echo $this->_response->getBody();

    } // END function dispatch

    /**
     * Translates a raw request param for a controller into a class name
     *
     * @param string $controller
     * @return string
     */
    private function _translateControllerName ($controller = '')
    {
        // create a string of upper cased words by replacing hyphens
        $controller = ucwords(strtr($controller, array(
            '-' => ' ',
        )));

        // remove the spaces, creating a camelcased word
        $controller = strtr($controller, array(
            ' ' => '',
        ));

        // return the controller name, prefixed with App_Controller_
        return "App_Controller_{$controller}";

    } // END function _translateControllerName

    /**
     *
     * Translates a raw request param for an action into an action name
     *
     * @param string $action
     * @return string
     */
    private function _translateActionName ($action = '')
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

    } // END function _translateActionName

    /**
     * method to parse an array and create nested arrays where necessary
     *
     * @param array $config
     * @return array
     */
    public function parseConfiguration ($config = array())
    {
        $results = array();

        // iterate through the parsed INI file
        foreach ($config as $key => $values) {
            $parts = explode('.', $key);
            if (! array_key_exists($parts[0], $results)) {
                $results[$parts[0]] = array();
            }

            $results[$parts[0]][$parts[1]] = $values;
        }

        return $results;

    } // END function parseConfiguration

    /**
     * returns the provide value, if it's in the _environments list
     * 
     * @param string $value
     * @return string
     */
    public function getApplicationEnv ($value = null)
    {
        if (in_array($value, $this->_environments)) {
            return $value;
        } 

        return current($this->_environments);

    } // END function getApplicationEnv

} // END function dispatcher
