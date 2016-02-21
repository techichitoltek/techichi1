<?php
class FrontendUserGroups extends App_Model_Std {

    /* Champs de la table */

    protected $id = 0;
    protected $group_id = "";
    protected $user_id = "";


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_FrontendUserGroups";
        $this->_myDbPrimary         = "id";
        $this->_myMetierClassName   = "FrontendUserGroups";
        $this->_myDbTableName       = "frontend_users_groups";
        $this->_myDbFieldPrefix     = "";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return the $group_id
     */
    public function getGroup_id() {
        return $this->group_id;
    }

    /**
     * @param string $group_id
     */
    public function setGroup_id($group_id) {
        $this->group_id = $group_id;
    }

    /**
     * @return the $user_id
     */
    public function getUser_id() {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }


}