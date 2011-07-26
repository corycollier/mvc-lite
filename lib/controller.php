<?php
/**
 * @file controller.php
 * @package Lib
 * @subpackage Controller
 * @category MVCLite
 */
/**
 * @package Lib
 * @subpackage Controller
 * @category MVCLite 
 */

class Lib_Controller
extends Lib_Object
{
    
    /**
     * getter for the view property
     * 
     * @return Lib_View
     */
    public function getView ( )
    {
        return Lib_View::getInstance();
        
    } // END function getView
    
    /**
     * Utility method to get the response instance
     * 
     * @return Lib_Response
     */
    public function getResponse ( )
    {
        return Lib_Response::getInstance();
        
    } // END function getResponse
    
    /**
     * Utility method to get the request instance
     * 
     * @return Lib_Request
     */
    public function getRequest ( )
    {
        return Lib_Request::getInstance();
        
    } // END function getRequest
    
    /**
     * Hook run immediately after the constructing of a controller
     */
    public function init ( )
    {
        $controller = $this->getRequest()->getParam('controller');
        $action = $this->getRequest()->getParam('action');
        
        // setup the view
        $this->getView()->setScript(implode(DIRECTORY_SEPARATOR, array(
            $controller,
            $action,
        )));
        
        $this->getView()->setLayout('default');

        $response = $this->getResponse();
        
    } // END function init
    
    /**
     * Hook run before the dispatching of a request is started
     */
    public function preDispatch ( )
    {
        
    } // END function preDispatch
    
    /**
     * Hook run after the dispatching of a request is completed
     */
    public function postDispatch ( )
    {
        
    } // END function postDispatch
    
} // END class Controller