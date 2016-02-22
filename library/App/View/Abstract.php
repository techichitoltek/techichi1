<?php
class App_View_Abstract extends Zend_View {

	/**
	 *
	 * @var App_WebUser
	 */
	public $webUser;

	/**
	 *
	 * @var User
	 */
	public $user;

	/*
     * @param   String  $imagePath  Le chemin vers l'image
     * @param   int     $width      La largeur en pixel de la vignette
     * @param   int     $height     La largeur en pixel de la vignette
     * @param   String  $destPath   Le chemin de destination de la vignette
     * @param   String  $urlPath    L'url pour l'affichage de la vignette
     */
    public function thumb($imagePath, $width, $height, $destPath, $urlPath) {}

    /**
     * Convenience method
     * call $this->designUrl() in the view to access
     * the helper
     *
     * @access public
     * @return string
     */
    public function designUrl(){}


    /**
     * Retourne le base url du répertoire public du module en cours
     *
     * @return string
     */
    public function modulePublicUrl() {}

}