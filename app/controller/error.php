<?php
/**
 * Error Controller
 * 
 * @category    MVCLite
 * @package     App
 * @subpackage  Controller
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Error Controller
 * 
 * This controller should display error messages
 * 
 * @category    MVCLite
 * @package     App
 * @subpackage  Controller
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class App_Controller_Error
extends Lib_Controller
{
    /**
     * Error Action
     */
    public function errorAction ( )
    {
        $this->getResponse()->setHeader('X-Test-Stuff', 'testing stuff');
        $this->getView()->set('test', 'value');
        
    } // END function errorAction
    
} // END class Error_Controller