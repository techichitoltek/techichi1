<?php
class UserInfos extends App_Model_Std {


    /* Champs de la table */

    protected $userinfos_id = 0;
    protected $userinfos_userId = null;
    protected $userinfos_nom = null;
    protected $userinfos_prenom = null;
    protected $userinfos_telephone = null;
    protected $userinfos_mail = null;
    protected $userinfos_active = 1;
    protected $userinfos_isDel = null;
    protected $userinfos_dateAdded = null;
    protected $userinfos_dateUpdated = null;


    /* /Champs de la table */

    protected $user = null;

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_UserInfos";
        $this->_myDbPrimary         = "userinfos_id";
        $this->_myMetierClassName   = "UserInfos";
        $this->_myDbTableName       = "rcweb_users_infos";
        $this->_myDbFieldPrefix     = "userinfos";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
	 * @return the $userinfos_id
	 */
	public function getUserinfos_id() {
		return $this->userinfos_id;
	}

	/**
	 * @param number $userinfos_id
	 */
	public function setUserinfos_id($userinfos_id) {
		$this->userinfos_id = $userinfos_id;
	}

	/**
	 * @return the $userinfos_userId
	 */
	public function getUserinfos_userId() {
		return $this->userinfos_userId;
	}

	/**
	 * @param field_type $userinfos_userId
	 */
	public function setUserinfos_userId($userinfos_userId) {
		$this->userinfos_userId = $userinfos_userId;
	}

	/**
	 * @return the $userinfos_nom
	 */
	public function getUserinfos_nom() {
		return $this->userinfos_nom;
	}

	/**
	 * @param field_type $userinfos_nom
	 */
	public function setUserinfos_nom($userinfos_nom) {
		$this->userinfos_nom = $userinfos_nom;
	}

	/**
	 * @return the $userinfos_prenom
	 */
	public function getUserinfos_prenom() {
		return $this->userinfos_prenom;
	}

	/**
	 * @param field_type $userinfos_prenom
	 */
	public function setUserinfos_prenom($userinfos_prenom) {
		$this->userinfos_prenom = $userinfos_prenom;
	}

	/**
	 * @return the $userinfos_telephone
	 */
	public function getUserinfos_telephone() {
		return $this->userinfos_telephone;
	}

	/**
	 * @param field_type $userinfos_telephone
	 */
	public function setUserinfos_telephone($userinfos_telephone) {
		$this->userinfos_telephone = $userinfos_telephone;
	}

	/**
	 * @return the $userinfos_mail
	 */
	public function getUserinfos_mail() {
		return $this->userinfos_mail;
	}

	/**
	 * @param field_type $userinfos_mail
	 */
	public function setUserinfos_mail($userinfos_mail) {
		$this->userinfos_mail = $userinfos_mail;
	}

	/**
	 * @return the $userinfos_active
	 */
	public function getUserinfos_active() {
		return $this->userinfos_active;
	}

	/**
	 * @param field_type $userinfos_active
	 */
	public function setUserinfos_active($userinfos_active) {
		$this->userinfos_active = $userinfos_active;
	}

	/**
	 * @return the $userinfos_isDel
	 */
	public function getUserinfos_isDel() {
		return $this->userinfos_isDel;
	}

	/**
	 * @param field_type $userinfos_isDel
	 */
	public function setUserinfos_isDel($userinfos_isDel) {
		$this->userinfos_isDel = $userinfos_isDel;
	}

	/**
	 * @return the $userinfos_dateAdded
	 */
	public function getUserinfos_dateAdded() {
		return $this->userinfos_dateAdded;
	}

	/**
	 * @param field_type $userinfos_dateAdded
	 */
	public function setUserinfos_dateAdded($userinfos_dateAdded) {
		$this->userinfos_dateAdded = $userinfos_dateAdded;
	}

	/**
	 * @return the $userinfos_dateUpdated
	 */
	public function getUserinfos_dateUpdated() {
		return $this->userinfos_dateUpdated;
	}

	/**
	 * @param field_type $userinfos_dateUpdated
	 */
	public function setUserinfos_dateUpdated($userinfos_dateUpdated) {
		$this->userinfos_dateUpdated = $userinfos_dateUpdated;
	}

	/**
     * Check if a route is allowed for the user
     *
     * @param string $routeName
     * @param string $role
     * @return boolean
     */
    public function isRouteAllowed($routeName,$role=null){
        if($this->user == null){
            $this->user = new User($this->userinfos_userId);
        }

        $objRoute = Zend_Controller_Front::getInstance()->getRouter();
        $objRoute =  $objRoute->getRoute($routeName);

        $defaults = $objRoute->getDefaults();
        $controller = $defaults['controller'];
        $action = $defaults['action'];

        // On vérifie d'abord dans les ACL
        $role = $this->user->getRoles();
        //Zend_Debug::dump($role);exit();

        $allowed = App_FlagFlippers_Manager::isAllowed($role, $controller, $action);

        return $allowed;
    }

    public function IsAllowed($ressource=null,$action=null){
        if($this->user == null){
            $this->user = new User($this->userinfos_userId);
        }
        // On vérifie d'abord dans les ACL
        $role = $this->user->getRoles();

        $allowed = App_FlagFlippers_Manager::isAllowed($role, $ressource, $action);

        return $allowed;

    }

    public function IsRole($role){
        if($this->user == null){
            $this->user = new User($this->userinfos_userId);
        }
        // On vérifie d'abord dans les ACL
        $roles = $this->user->getRoles();

        foreach($roles as $r){
            if($r->name == $role){
                return true;
            }
        }
        return false;
    }

}