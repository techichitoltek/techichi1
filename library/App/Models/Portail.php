<?php
class Portail extends App_Model_Std {


    /* Champs de la table */

    protected $portail_id = 0;
    protected $portail_code = "";
    protected $portail_libelle = "";
    protected $portail_commentaire = "";
    protected $portail_environnement = 'development';
    protected $portail_theme = 'default';
    protected $portail_dateAdded = null;
    protected $portail_dateUpdated = null;


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_Portail";
        $this->_myDbPrimary         = "portail_id";
        $this->_myMetierClassName   = "Portail";
        $this->_myDbTableName       = "zf_portails";
        $this->_myDbFieldPrefix     = "portail";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $portail_id
     */
    public function getPortail_id() {
        return $this->portail_id;
    }

    /**
     * @param number $portail_id
     */
    public function setPortail_id($portail_id) {
        $this->portail_id = $portail_id;
    }

    /**
     * @return the $portail_code
     */
    public function getPortail_code() {
        return $this->portail_code;
    }

    /**
     * @param string $portail_code
     */
    public function setPortail_code($portail_code) {
        $this->portail_code = $portail_code;
    }

    /**
     * @return the $portail_libelle
     */
    public function getPortail_libelle() {
        return $this->portail_libelle;
    }

    /**
     * @param string $portail_libelle
     */
    public function setPortail_libelle($portail_libelle) {
        $this->portail_libelle = $portail_libelle;
    }

    /**
     * @return the $portail_commentaire
     */
    public function getPortail_commentaire() {
        return $this->portail_commentaire;
    }

    /**
     * @param string $portail_commentaire
     */
    public function setPortail_commentaire($portail_commentaire) {
        $this->portail_commentaire = $portail_commentaire;
    }

    /**
     * @return the $portail_environnement
     */
    public function getPortail_environnement() {
        return $this->portail_environnement;
    }

    /**
     * @param string $portail_environnement
     */
    public function setPortail_environnement($portail_environnement) {
        $this->portail_environnement = $portail_environnement;
    }

    /**
     * @return the $portail_theme
     */
    public function getPortail_theme() {
        return $this->portail_theme;
    }

    /**
     * @param string $portail_theme
     */
    public function setPortail_theme($portail_theme) {
        $this->portail_theme = $portail_theme;
    }

    /**
     * @return the $portail_dateAdded
     */
    public function getPortail_dateAdded() {
        return $this->portail_dateAdded;
    }

    /**
     * @param field_type $portail_dateAdded
     */
    public function setPortail_dateAdded($portail_dateAdded) {
        $this->portail_dateAdded = $portail_dateAdded;
    }

    /**
     * @return the $portail_dateUpdated
     */
    public function getPortail_dateUpdated() {
        return $this->portail_dateUpdated;
    }

    /**
     * @param field_type $portail_dateUpdated
     */
    public function setPortail_dateUpdated($portail_dateUpdated) {
        $this->portail_dateUpdated = $portail_dateUpdated;
    }


}