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
class Controller extends ObjectAbstract
{
    protected $view;
    protected $response;
    protected $request;
    protected $session;

    /**
     * Constructor for the controller.
     */
    public function __construct()
    {
        $this->view     = View::getInstance();
        $this->response = Response::getInstance();
        $this->request  = Request::getInstance();
        $this->session  = Session::getInstance();
    }

    /**
     * Getter for the view property.
     *
     * @return \MvcLite\View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Getter for the response property.
     *
     * @return \MvcLite\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Utility method to get the request instance
     *
     * @return \MvcLite\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Utility method to get the session instance
     *
     * @return \MvcLite\Session
     */
    public function getSession()
    {
        if (! $this->session) {
            $this->session = Session::getInstance();
        }
        return $this->session;
    }

    /**
     * Hook run immediately after the constructing of a controller.
     */
    public function init()
    {
        $request    = $this->getRequest();
        $controller = $request->getParam('controller');
        $action     = $request->getParam('action');
        $view       = $this->getView();
        $path       = implode(DIRECTORY_SEPARATOR, array(
            APP_PATH, 'view', 'scripts', $controller,
        ));

        // setup the view
        $view->addViewScriptPath($path);
        $view->setScript($action);

        // if the request is not ajax, then setup the layout
        if (!$request->isAjax()) {
            $view->setLayout('default');
        }
    }

    /**
     * Hook run before the dispatching of a request is started.
     */
    public function preDispatch()
    {

    }

    /**
     * Hook run after the dispatching of a request is completed.
     */
    public function postDispatch()
    {

    }
}
