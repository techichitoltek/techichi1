<?php
/**
 * Helper that will return the themed Url
 *
 *
 * @category App
 * @package App_View
 * @subpackage Helper
 * @copyright RCWEB
 */

class App_View_Helper_DesignUrl extends Zend_View_Helper_Abstract
{
    /**
     * Convenience method
     * call $this->designUrl() in the view to access
     * the helper
     *
     * @access public
     * @return string
     */
    public function designUrl(){
        $portail = Zend_Registry::get('Portail');
        return $this->view->baseUrl() . "/" . $portail->getPortail_theme();
    }
}