<?php
class PortailUrl extends App_Model_Std {


    /* Champs de la table */

    protected $portailurl_id = 0;
    protected $portailurl_portail_id = "";
    protected $portailurl_url = "";
    protected $portailurl_dateAdded = null;
    protected $portailurl_dateUpdated = null;


    /* /Champs de la table */

    /**
     * @var Portail
     */
    protected $_portail = null;

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_PortailUrl";
        $this->_myDbPrimary         = "portailurl_id";
        $this->_myMetierClassName   = "PortailUrl";
        $this->_myDbTableName       = "zf_portailurl";
        $this->_myDbFieldPrefix     = "portailurl";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $portailurl_id
     */
    public function getPortailurl_id() {
        return $this->portailurl_id;
    }

    /**
     * @param number $portailurl_id
     */
    public function setPortailurl_id($portailurl_id) {
        $this->portailurl_id = $portailurl_id;
    }

    /**
     * @return the $portailurl_portail_id
     */
    public function getPortailurl_portail_id() {
        return $this->portailurl_portail_id;
    }

    /**
     * @param string $portailurl_portail_id
     */
    public function setPortailurl_portail_id($portailurl_portail_id) {
        $this->portailurl_portail_id = $portailurl_portail_id;
    }

    /**
     * @return the $portailurl_url
     */
    public function getPortailurl_url() {
        return $this->portailurl_url;
    }

    /**
     * @param string $portailurl_url
     */
    public function setPortailurl_url($portailurl_url) {
        $this->portailurl_url = $portailurl_url;
    }

    /**
     * @return the $portailurl_dateAdded
     */
    public function getPortailurl_dateAdded() {
        return $this->portailurl_dateAdded;
    }

    /**
     * @param field_type $portailurl_dateAdded
     */
    public function setPortailurl_dateAdded($portailurl_dateAdded) {
        $this->portailurl_dateAdded = $portailurl_dateAdded;
    }

    /**
     * @return the $portailurl_dateUpdated
     */
    public function getPortailurl_dateUpdated() {
        return $this->portailurl_dateUpdated;
    }

    /**
     * @param field_type $portailurl_dateUpdated
     */
    public function setPortailurl_dateUpdated($portailurl_dateUpdated) {
        $this->portailurl_dateUpdated = $portailurl_dateUpdated;
    }

    /**
     * @return Portail Portail
     */
    public function getPortail() {
        if($this->_portail == null){
            $this->_portail = new Portail($this->portailurl_portail_id);
        }
        return $this->_portail;
    }

    /**
     * @param Portail $_portail
     */
    public function setPortail(Portail $_portail) {
        $this->_portail = $_portail;
        return $this;
    }


}