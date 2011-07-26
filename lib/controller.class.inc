<?php

/**
 * 
 * Base controller
 * @author corycollier
 *
 */
class Controller
{
    
    /**
     * getter for the view property
     * 
     * @return View
     */
    public function getView ( )
    {
        return View::getInstance();
        
    } // END function getView
    
    /**
     * Utility method to get the response instance
     * 
     * @return Response
     */
    public function getResponse ( )
    {
        return Response::getInstance();
        
    } // END function getResponse
    
    /**
     * Utility method to get the request instance
     * 
     * @return Request
     */
    public function getRequest ( )
    {
        return Request::getInstance();
        
    } // END function getRequest
    
    /**
     * 
     * Hook run immediately after the constructing of a controller
     */
    public function init ( )
    {
        $controller = $this->getRequest()->getParam('controller');
        $action = $this->getRequest()->getParam('action');
        
        // setup the view
        $view = View::getInstance();
        $view->setScript(implode(DIRECTORY_SEPARATOR, array(
            $controller,
            $action,
        )));
        
        $view->setLayout('default');

        $response = $this->getResponse();
        
    } // END function init
    
    /**
     * 
     * Hook run before the dispatching of a request is started
     */
    public function preDispatch ( )
    {
        
    } // END function preDispatch
    
    /**
     * 
     * Hook run after the dispatching of a request is completed
     */
    public function postDispatch ( )
    {
        
    } // END function postDispatch
    
} // END class Controller