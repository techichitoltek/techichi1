<?php
/**
 * ModulePublicUrl helper
 *
 * @category App
 * @package App_View
 * @subpackage Helper
 * @copyright RCWEB
 */
class App_View_Helper_ModulePublicUrl extends Zend_View_Helper_Abstract {
	
	/**
	 * Retourne le base url du répertoire public du module en cours
	 * 
	 * @return string
	 */
	public function modulePublicUrl() {
		return $this->view->moduleBaseUrl().'/public';
	}
}