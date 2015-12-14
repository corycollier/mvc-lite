<?php
/**
 * Base Controller
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Controller
 * @since       File available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

use \MvcLite\Traits\Request as RequestTrait;
use \MvcLite\Traits\Response as ResponseTrait;
use \MvcLite\Traits\Session as SessionTrait;
use \MvcLite\Traits\Filepath as FilepathTrait;
use \MvcLite\Traits\View as ViewTrait;

/**
 * Base Controller
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Controller
 * @since       Class available since release 1.0.1
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Controller extends ObjectAbstract
{
    use RequestTrait;
    use ResponseTrait;
    use SessionTrait;
    use FilepathTrait;
    use ViewTrait;

    /**
     * Hook run immediately after the constructing of a controller.
     *
     * @return MvcLite\Controller Returns $this, for object-chaining.
     */
    public function init()
    {
        $request    = $this->getRequest();
        $controller = $request->getParam('controller');
        $action     = $request->getParam('action');
        $view       = $this->getView();
        $path       = $this->filepath([APP_PATH, 'view', 'scripts', $controller]);

        // setup the view
        $view->addViewScriptPath($path);
        $view->setScript($action);

        // if the request is not ajax, then setup the layout
        if (!$request->isAjax()) {
            $view->setLayout('default');
        }

        return $this;
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
