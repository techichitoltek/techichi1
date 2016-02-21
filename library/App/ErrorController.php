<?php
/**
 * App Error Controller
 *
 * @category framework
 * @package framework_controllers
 * @copyright RCWEB
 */

class App_ErrorController extends App_Controller
{
    private $_notifier;
    private $_error;
    private $_environment;
    /**
     * List of Zend_Exceptions for which we display
     * the 404 page
     *
     * @var array
     * @access protected
     */
    protected $_dispatch404s = array(
        Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE,
        Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER,
        Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
    );

    /**
     * Overrides init() defined in App_Module_Controller
     *
     * @access public
     * @return void
     */
    public function init(){
        parent::init();

        $errorNamespace = new Zend_Session_Namespace("errorNamespace");
        $errorNamespace->test = "Erreur";

        $environment = Zend_Registry::get('Environment');

        $error = $this->_getParam('error_handler');
        $mailer = new App_Mail("FRAMEWORK.NOTIFICATION");
        $session = new Zend_Session_Namespace();
        $database = Zend_Registry::get('dbAdapter');
        $profiler = $database->getProfiler();
        $auth = App_Auth::getInstance();
        $webUser = Zend_Registry::get('WebUser');/* @var $webUser App_WebUser */


        // TDTODO : Gestion des erreurs !!!!
        //return;
        //Zend_Debug::dump($error,"error");
        //debug($error,"error");
        if($error instanceof ArrayObject){
            $this->_notifier = new App_Service_Notifier_Error(
                    $environment,
                    $error,
                    $mailer,
                    $session,
                    $profiler,
                    $_SERVER,
                    $auth,
                    $webUser
            );
        }

        $this->_error = $error;
        $this->_environment = $environment;
// TDTODO : Implémenter session dans débogage...
//Zend_Debug::dump($session);
    }

    /**
     * Handles all errors in the application
     *
     * @access public
     * @return void
     */
    public function errorAction(){
        $errorInfo = $this->_getParam('error_handler');

        if (in_array($errorInfo->type, $this->_dispatch404s)) {
            $this->_dispatch404();
            //return;
        }

        if($this->_notifier instanceof App_Service_Notifier_Error){
            $this->_applicationError();
        }

        $exception = $errorInfo->exception; /* @var $exception Exception */
        $this->view->exception = $exception;

        // Log exception, if logger available
        App_Logger::log(sprintf("%s\n\n%s", $exception->getMessage(), $exception->getTraceAsString()), Zend_Log::ERR);
        /*if ($log = $this->_getLog()) {
            $log->crit($this->view->message, $this->_error->exception);
        }*/
    }

    /**
     * Handles the Flag and Flipper errors
     *
     * @access public
     * @return void
     */
    public function flagflippersAction(){
        if (Zend_Registry::get('IS_DEVELOPMENT')) {
            $this->title = 'Flag and Flipper not found';

            $this->view->originalController = $this->_getParam('originalController');
            $this->view->originalAction = $this->_getParam('originalAction');
        } else {
            $this->_dispatch404();
        }
    }

    /**
     * Displays the forbidden page
     *
     * @access public
     * @return void
     */
    public function forbiddenAction(){
        $this->title = 'Forbidden';
    }

    /**
     * Dispatches the 404 error page as it should be seen
     * by the end user.
     *
     * @access protected
     * @return void
     */
    protected function _dispatch404(){
        $this->title = 'Page not found';
        $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');

        $this->render('error-404');
    }

    private function _applicationError()
    {
        $fullMessage = $this->_notifier->getFullErrorMessage();
        $shortMessage = $this->_notifier->getShortErrorMessage();

        switch ($this->_environment) {
            case APP_STATE_PRODUCTION:
                $this->view->message = $shortMessage;
                break;
            case APP_STATE_STAGING:
            case APP_STATE_DEVELOPMENT:
                //$this->_helper->viewRenderer->setNoRender();
                //$this->getResponse()->appendBody($shortMessage);
                break;
            default:
                $this->view->message = nl2br($fullMessage);
        }

        $this->_notifier->notify();
    }

    private function _getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasPluginResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

    /**
     * Overrides preDispatch() from App_Controller
     *
     * @access public
     * @return void
     */
    public function preDispatch(){
        parent::preDispatch();

        $controllerName = $this->getRequest()->getControllerName();
        $actionName = $this->getRequest()->getActionName();

        Zend_Registry::set('controllerName', $controllerName);
        Zend_Registry::set('actionName', $actionName);
        // check the Flag and Flippers

        $this->_checkFlagFlippers();
    }

    /**
     * Overrides postDispatch() from App_Controller
     *
     * @access public
     * @return void
     */
    public function postDispatch(){
        parent::postDispatch();

        //$this->_helper->layout()->getView()->headTitle($this->title);
    }
}