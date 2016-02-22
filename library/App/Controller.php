<?php
/**
 * Default application wide controller parent class
 *
 * @category App
 * @package App_Controller
 * @copyright RCWEB
 */

abstract class App_Controller extends Zend_Controller_Action
{
    //Unique place to store the namespace keys
    protected $_requestNamespaceKey = 'FrontendRequest';

    //Store the namespaces
    protected $_session = array();

    /**
     * Holds the title for the controller
     *
     * @var string
     * @access public
     */
    public $title = '';

    /**
     * Store the available commands
     *
     * @var array
     */
    private $_commands = array();

    /**
     * PortailId courant
     * @var int
     */
    protected $_portailId;

    protected $_successMsg         =    array();
    protected $_warningMsg         =    array();
    protected $_errorMsg           =    array();
    protected $_noticeMsg          =    array();

    protected $_instantSuccessMsg         =    array();
    protected $_instantWarningMsg         =    array();
    protected $_instantErrorMsg           =    array();
    protected $_instantNoticeMsg          =    array();

    protected $_ajax_view = 'ajax.phtml';
    protected $_is_ajax   = false;

    /**
     * Overrides init() from App_Controller
     *
     * @access public
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->t = Zend_Registry::get('Zend_Translate');
    }

    /**
     * Get the session namespace we're using
     *
     * @return Zend_Session_Namespace
     */
    protected function _getSessionNamespace($key){
        if(!array_key_exists($key, $this->_session)){
            $this->_session[$key] = new Zend_Session_Namespace($key);
        }

        return $this->_session[$key];
    }

    /**
     * Add a new command to the chain
     *
     * @param object $cmd
     * @return void
     */
    protected function _addCommand($cmd){
        if(is_object($cmd) && !array_key_exists(get_class($cmd), $this->_commands)){
            $this->_commands[get_class($cmd)] = $cmd;
        }
    }

    /**
     * Run a command through the command chain
     *
     * @param string $name
     * @param mixed $args
     * @return void
     */
    protected function _runCommand($name, $args){
        foreach($this->_commands as $cmd){
            if($result = $cmd->onCommand($name, $args)){
                return $result;
            }
        }
    }

    /**
     * Queries the Flag and Flipper and redirects the user to a different
     * page if he/her doesn't have the required permissions for
     * accessing the current page
     *
     * @access protected
     * @return void
     */
    protected function _checkFlagFlippers(){
        $controllerName = Zend_Registry::get('controllerName');
        $actionName = Zend_Registry::get('actionName');

        $user = BaseUser::getSession();

        if(Zend_Registry::get('IS_DEVELOPMENT') && $controllerName != 'error'){
            $flagModel = new Flag();

            $flag = strtolower(CURRENT_MODULE) . '-' . $controllerName;

            if(!$flagModel->checkRegistered($flag, App_Inflector::camelCaseToDash($actionName))){
                $params = array(
                    'originalController' => $controllerName,
                    'originalAction' => $actionName
                );
                $this->_forward('flagflippers', 'error', NULL, $params);
                return;
            }
        }

        //Check the flag and flippers for ZFDebug
        /* TDTODO : A voir si ça sert encore
        if(!App_FlagFlippers_Manager::isAllowed($user->group->name, 'testing', 'zfdebug')){
            Zend_Controller_Front::getInstance()->unregisterPlugin('ZFDebug_Controller_Plugin_Debug');
        }
        /**/

        if(!App_FlagFlippers_Manager::isAllowed($user->group->name, $controllerName, $actionName)){
            if(empty($user->id)){
                // the user is a guest, save the request and redirect him to
                // the login page
                $session = new Zend_Session_Namespace('App.'.CURRENT_MODULE.'.Controller');
                $session->request = serialize($this->getRequest());
                $this->_redirect('/profile/login/');
            }else{

                // TDTODO : Logger les forbidden
                //$this->view->originalController = $controllerName;
                //$this->view->originalAction = $actionName;
                $this->_redirect('/error/forbidden/');
            }
        }
    }

    /**
     * Convenience method to get the paginator
     *
     * @param mixed $array
     * @return void
     */
    protected function _getPaginator($array){
        $paginator = Zend_Paginator::factory($array);
        $paginator->setCurrentPageNumber($this->_getPage());
        $paginator->setItemCountPerPage(App_DI_Container::get('ConfigObject')->paginator->items_per_page);

        return $paginator;
    }

    /**
     * Gets the current page. Convenience method for using
     * paginators
     *
     * @param int $default
     * @access protected
     * @return int
     */
    protected function _getPage($default = 1){
        $page = $this->_getParam('page');
        if (!$page || !is_numeric($page)) {
            return $default;
        }

        return $page;
    }

    function myPreDispatch()
    {
        //if  its an AJAX request stop here
        if ($this->_request->isXmlHttpRequest() || isset($_GET['ajax']))
        {
            //$this->_is_ajax = true;
        }

        ///// Partie Messages
        if(!$this->_is_ajax){
            $this->getMessagesFromSession();
        }

        if($this->_is_ajax){
            Zend_Controller_Action_HelperBroker::removeHelper('Layout');
            $this->getHelper('ViewRenderer')->setNoRender();
            return TRUE;
        }
    }

    function myPostDispatch()
    {
        if($this->_is_ajax){
            $this->renderScript( $this->_getAjaxView() );
            return TRUE;
        }

        $this->getInstantMessages();
    }

    protected function _setAjaxView($view)
    {
        $this->_ajax_view = $view;
        return TRUE;
    }
    protected function _getAjaxView()
    {
        return $this->_ajax_view;
    }

    function getMessagesFromSession(){
        // Gestion des messages applicatifs
        $this->view->hasSuccessMsg      =    false;
        $this->view->hasWarningMsg      =    false;
        $this->view->hasErrorMsg        =    false;
        $this->view->hasNoticeMsg       =    false;

        $msgDataSpace                   =    new Zend_Session_Namespace('msgDataSpace');
        if (count($msgDataSpace->successMsg)) {
            $this->view->hasSuccessMsg  =    true;
            $this->_instantSuccessMsg     =    $msgDataSpace->successMsg;
        }
        if (count($msgDataSpace->warningMsg)) {
            $this->view->hasWarningMsg  =    true;
            $this->_instantWarningMsg     =    $msgDataSpace->warningMsg;
        }
        if (count($msgDataSpace->errorMsg)) {
            $this->view->hasErrorMsg    =    true;
            $this->_instantErrorMsg       =    $msgDataSpace->errorMsg;
        }
        if (count($msgDataSpace->noticeMsg)) {
            $this->view->hasNoticeMsg   =    true;
            $this->_instantNoticeMsg      =    $msgDataSpace->noticeMsg;
        }
        $msgDataSpace->successMsg       =    array();
        $msgDataSpace->warningMsg       =    array();
        $msgDataSpace->errorMsg         =    array();
        $msgDataSpace->noticeMsg        =    array();
    }

    function getInstantMessages(){
        // Gestion des messages applicatifs
        if (count($this->_instantSuccessMsg)) {
            $this->view->hasSuccessMsg  =    true;
            $this->view->successMsg     =    $this->_instantSuccessMsg;
        }
        if (count($this->_instantWarningMsg)) {
            $this->view->hasWarningMsg  =    true;
            $this->view->warningMsg     =    $this->_instantWarningMsg;
        }
        if (count($this->_instantErrorMsg)) {
            $this->view->hasErrorMsg    =    true;
            $this->view->errorMsg       =    $this->_instantErrorMsg;
        }
        if (count($this->_instantNoticeMsg)) {
            $this->view->hasNoticeMsg   =    true;
            $this->view->noticeMsg      =    $this->_instantNoticeMsg;
        }
    }

    function saveInSession(){
        $msgDataSpace = new Zend_Session_Namespace('msgDataSpace');
        $msgDataSpace->successMsg = $this->_successMsg;
        $msgDataSpace->warningMsg = $this->_warningMsg;
        $msgDataSpace->errorMsg = $this->_errorMsg;
        $msgDataSpace->noticeMsg = $this->_noticeMsg;
    }

    public function addMsgSuccess($msg,$session=false){
        if($session == false){
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_instantSuccessMsg[] = $message;
                        }
                    }else{
                        $this->_instantSuccessMsg[] = $messages;
                    }
                }
            }else{
                $this->_instantSuccessMsg[] = $msg;
            }
        }else{
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_successMsg[] = $message;
                        }
                    }else{
                        $this->_successMsg[] = $messages;
                    }
                }
            }else{
                $this->_successMsg[] = $msg;
            }
            $this->saveInSession();
        }
    }
    public function addMsgWarning($msg,$session=false){
        if($session == false){
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_instantWarningMsg[] = $message;
                        }
                    }else{
                        $this->_instantWarningMsg[] = $messages;
                    }
                }
            }else{
                $this->_instantWarningMsg[] = $msg;
            }
        }else{
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_warningMsg[] = $message;
                        }
                    }else{
                        $this->_warningMsg[] = $messages;
                    }
                }
            }else{
                $this->_warningMsg[] = $msg;
            }
            $this->saveInSession();
        }
    }
    public function addMsgErrorMsg($msg,$session=false){
        if($session == false){
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_instantErrorMsg[] = $message;
                        }
                    }else{
                        $this->_instantErrorMsg[] = $messages;
                    }
                }
            }else{
                $this->_instantErrorMsg[] = $msg;
            }
        }else{
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_errorMsg[] = $message;
                        }
                    }else{
                        $this->_errorMsg[] = $messages;
                    }
                }
            }else{
                $this->_errorMsg[] = $msg;
            }
            $this->saveInSession();
        }
    }
    public function addMsgNotice($msg,$session=false){
        if($session == false){
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_instantNoticeMsg[] = $message;
                        }
                    }else{
                        $this->_instantNoticeMsg[] = $messages;
                    }
                }
            }else{
                $this->_instantNoticeMsg[] = $msg;
            }
        }else{
            if(is_array($msg)){
                foreach($msg as $elemName=>$messages) {
                    if(is_array($messages) && count($msg)){
                        foreach($messages as $message) {
                            $this->_noticeMsg[] = $message;
                        }
                    }else{
                        $this->_noticeMsg[] = $messages;
                    }
                }
            }else{
                $this->_noticeMsg[] = $msg;
            }
            $this->saveInSession();
        }
    }
}
