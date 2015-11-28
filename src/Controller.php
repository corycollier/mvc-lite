<?php
/**
 * Base Controller
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Controller
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Base Controller
 *
 * @category    MvcLite
 * @package     Lib
 * @subpackage  Controller
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Controller
    extends ObjectAbstract
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
     * Utility method to get the session instance
     *
     * @return Lib_Session
     */
    public function getSession ( )
    {
        return Lib_Session::getInstance();

    } // END function getSession

    /**
     * Hook run immediately after the constructing of a controller
     */
    public function init ( )
    {
        $request = $this->getRequest();
        $controller = $request->getParam('controller');
        $action = $request->getParam('action');

        // setup the view
        $this->getView()->addViewScriptPath(implode(DIRECTORY_SEPARATOR, array(
            APP_PATH, 'view', 'scripts', $controller,
        )));

        $this->getView()->setScript($action);

        // if the request is not ajax, then setup the layout
        if (!$request->isAjax()) {
            $this->getView()->setLayout('default');
        }

        $response = $this->getResponse();

        $session = $this->getSession();

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
