<?php
/**
 * @category    MVCLite
 * @package     App
 * @subpackage  Controller
 * @since       File available since release 1.0.1
 */
/**
 * @category    MVCLite
 * @package     App
 * @subpackage  Controller
 * @since       Class available since release 1.0.1
 */

class App_Controller_Error
extends Lib_Controller
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