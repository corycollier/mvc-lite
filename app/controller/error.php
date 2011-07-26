<?php
/**
 * @file error.php
 * @package App
 * @subpackage Controller
 * @category MVCLite
 */
/**
 * @package App
 * @subpackage Controller
 * @category MVCLite 
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