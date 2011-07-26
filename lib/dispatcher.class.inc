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
     * dispatch
     * 
     * This is the main entry point for dispatching a request
     * 
     * @return void
     */
    public function dispatch ( )
    {
        $request = Request::getInstance();
        $controller = ucwords($request->getParam('controller'));
        $action = $request->getParam('action');
        
        $controller = "{$controller}_Controller";
        $action = "{$action}Action";
        
        // If the controller doesn't exist, use the error controller
        try {
            $controller = new $controller;
        }
        catch (Exception $exception) {
            $request->setParam('controller', 'error');
            $request->setParam('action', 'error');
            $controller = new Error_Controller;
            $action = 'errorAction';
        }
        
        // if the action requested isn't callable on the controller, 
        // use the error controller
        if (! method_exists($controller, $action)) {
            $request->setParam('controller', 'error');
            $request->setParam('action', 'error');
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
        $response = Response::getInstance();
        $response->setBody($controller->getView()->render());
        
        // if this is an actual request, not a unit test, send headers
        if ( PHP_SAPI != 'cli' ) $response->sendHeaders();
        
        // echo the body
        echo $response->getBody();
        
    } // END function dispatch
    
} // END function dispatcher