<?php
/**
 * Default entry point in the application
 *
 * @package frontend_controllers
 * @copyright RCWEB
 */

class UserController extends App_Frontend_Controller
{
    /**
     * Overrides Zend_Controller_Action::init()
     *
     * @access public
     * @return void
     */
    public function init()
    {
        // init the parent
        parent::init();

        $this->_addCommand(new App_Command_SendEmail());
    }

    /**
     * Controller's entry point
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {

    }

    /**
     * Accueil entry point
     *
     * @return void
     */
    public function accueilAction()
    {
    	$user = $this->user; /* @var $user User */
    	$this->view->user = $user;
    	if($user->getId()){
    		//debug('utilisateur connecté: '.$this->user->getUserInfos()->getUserinfos_nom());
    	}
    }

    /**
     * Ajouter un compte utilisateur
     *
     * @return void
     */
    public function addaccountAction()
    {

    }

}