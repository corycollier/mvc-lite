<?php

/**
 * 
 * Enter description here ...
 * @author corycollier
 *
 */
class Dispatcher
{
    /**
     * The instance of self used for the singleton pattern
     * 
     * @var Dispatcher
     */
    private static $_instance;
    
    /**
     * The request instance, managed by the dispatcher
     * 
     * @var Request
     */
    private $_request;
    
    /**
     * Privatize the constructor to enforce the singleton pattern
     */
    private function __construct ( ) 
    {
        
    } // END function __construct
    
    /**
     * Method to access the single instance of this class
     * 
     * @return Dispatcher
     */
    public static function getInstance ( )
    {   // if the instance property isn't already set, then set it
        if (! self::$_instance) {
            self::$_instance = new Dispatcher;
        }
        
        // return the instance property
        return self::$_instance;
        
    } // END function getInstance
    
    /**
     * Method to set the request.
     * 
     * this should be done prior to dispatching the request
     * 
     * @param array $params
     * @return Dispatcher $this for a fluent interface
     */
    public function setRequest (Request $request)
    {
        $this->_request = $request;
        
        return $this;
        
    } // END function setRequest
    
    /**
     * Accessor to get the request params
     * 
     * @return array
     */
    public function getRequest ( )
    {
        return $this->_request;
        
    } // END function getRequest
    
    /**
     * dispatch
     * 
     * This is the main entry point for dispatching a request
     * 
     * @return void
     */
    public function dispatch ( )
    {
        $controller = ucwords($this->getRequest()->getParam('controller'));
        $action = $this->getRequest()->getParam('action');
        
        $controller = "{$controller}_Controller";
        $action = "{$action}Action";
        
        // If the controller doesn't exist, use the error controller
        try {
            $controller = new $controller;
        }
        catch (Exception $exception) {
            $this->getRequest()->setParam('controller', 'error');
            $this->getRequest()->setParam('action', 'error');
            $controller = new Error_Controller;
            $action = 'errorAction';
        }
        
        // if the action requested isn't callable on the controller, 
        // use the error controller
        if (! method_exists($controller, $action)) {
            $this->getRequest()->setParam('controller', 'error');
            $this->getRequest()->setParam('action', 'error');
            $controller = new Error_Controller;
            $action = 'errorAction';
        }
        
        // run the init hook
        $controller->init();
        
        // run the preDispatch hook
        $controller->preDispatch();
        
        // run the requested action on the requested controller
        call_user_func(array($controller, $action));
        
        // run the postDispatch hook
        $controller->postDispatch();
        
        // send the response
        $response = $controller->getResponse();
        $response->setBody($controller->getView()->render());
        $response->sendHeaders();
        echo $response->getBody();
        
    } // END function dispatch
    
} // END function dispatcher