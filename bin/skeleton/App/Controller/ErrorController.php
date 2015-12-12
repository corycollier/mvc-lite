<?php
/**
 * Application Error Controller
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  App
 */

namespace App;

use MvcLite\Controller;

/**
 * Application Error Controller
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  App
 */
class ErrorController extends Controller
{
    /**
     * Action to handle generic errors.
     */
    public function errorAction()
    {
        $view = $this->getView();
        $request = $this->getRequest();
        $view->set('error', $request->getParam('error'));
    }

}
