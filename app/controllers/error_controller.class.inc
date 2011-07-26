<?php
/**
 * 
 * Enter description here ...
 * @author corycollier
 *
 */
class Error_Controller
extends Controller
{
    /**
     * 
     * Enter description here ...
     */
    public function errorAction ( )
    {
        $this->getResponse()->setHeader('X-Test-Stuff', 'testing stuff');
        $this->getView()->set('test', 'value');
        
    } // END function errorAction
    
} // END class Error_Controller