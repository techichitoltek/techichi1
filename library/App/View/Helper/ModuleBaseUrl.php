<?php
/**
 * ModuleBaseUrl helper
 *
 * @category App
 * @package App_View
 * @subpackage Helper
 * @copyright RCWEB
 */
class App_View_Helper_ModuleBaseUrl extends Zend_View_Helper_Abstract {
	
	/**
	 * Retourne le base url du module en cours
	 * 
	 * @return string
	 */
	public function moduleBaseUrl() {
		// Initialisation du registre
		$registry = Zend_Registry::getInstance();
    	
		// Récupération des informations sur le module courant
    	$currentRequestInfo	=	Zend_Registry::get('currentRequestInfo');
    	$moduleName			=	$currentRequestInfo['requestModule'];
    			
		return $this->view->baseUrl().'/modules/'.$moduleName;
	}
}