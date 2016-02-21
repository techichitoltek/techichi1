<?php
class Email extends App_Model_Std {


    /* Champs de la table */

    protected $email_id = 0;
    protected $email_module = "";
    protected $email_name = "";
    protected $email_layout = null;
    protected $email_template = "";
    protected $email_vars = "";
    protected $email_fromName = null;
    protected $email_fromMail = null;
    protected $email_replyToName = null;
    protected $email_replyToMail = null;
    protected $email_ccMail = null;
    protected $email_bccMail = null;
    protected $email_dateAdded = null;
    protected $email_dateUpdated = null;


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_Email";
        $this->_myDbPrimary         = "email_id";
        $this->_myMetierClassName   = "Email";
        $this->_myDbTableName       = "ztdf_emails";
        $this->_myDbFieldPrefix     = "email";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $email_id
     */
    public function getEmail_id() {
        return $this->email_id;
    }

    /**
     * @param number $email_id
     */
    public function setEmail_id($email_id) {
        $this->email_id = $email_id;
    }

    /**
     * @return the $email_module
     */
    public function getEmail_module() {
        return $this->email_module;
    }

    /**
     * @param string $email_module
     */
    public function setEmail_module($email_module) {
        $this->email_module = $email_module;
    }

    /**
     * @return the $email_name
     */
    public function getEmail_name() {
        return $this->email_name;
    }

    /**
     * @param string $email_name
     */
    public function setEmail_name($email_name) {
        $this->email_name = $email_name;
    }

    /**
     * @return the $email_layout
     */
    public function getEmail_layout() {
        return $this->email_layout;
    }

    /**
     * @param string $email_layout
     */
    public function setEmail_layout($email_layout) {
        $this->email_layout = $email_layout;
    }

    /**
     * @return the $email_template
     */
    public function getEmail_template() {
        return $this->email_template;
    }

    /**
     * @param string $email_template
     */
    public function setEmail_template($email_template) {
        $this->email_template = $email_template;
    }

    /**
     * @return the $email_vars
     */
    public function getEmail_vars() {
        return $this->email_vars;
    }

    /**
     * @param string $email_vars
     */
    public function setEmail_vars($email_vars) {
        $this->email_vars = $email_vars;
    }

    /**
     * @return the $email_fromName
     */
    public function getEmail_fromName() {
        return $this->email_fromName;
    }

    /**
     * @param string $email_fromName
     */
    public function setEmail_fromName($email_fromName) {
        $this->email_fromName = $email_fromName;
    }

    /**
     * @return the $email_fromMail
     */
    public function getEmail_fromMail() {
        return $this->email_fromMail;
    }

    /**
     * @param string $email_fromMail
     */
    public function setEmail_fromMail($email_fromMail) {
        $this->email_fromMail = $email_fromMail;
    }

    /**
     * @return the $email_replyToName
     */
    public function getEmail_replyToName() {
        return $this->email_replyToName;
    }

    /**
     * @param field_type $email_replyToName
     */
    public function setEmail_replyToName($email_replyToName) {
        $this->email_replyToName = $email_replyToName;
    }

    /**
     * @return the $email_replyToMail
     */
    public function getEmail_replyToMail() {
        return $this->email_replyToMail;
    }

    /**
     * @param field_type $email_replyToMail
     */
    public function setEmail_replyToMail($email_replyToMail) {
        $this->email_replyToMail = $email_replyToMail;
    }

    /**
     * @return the $email_ccMail
     */
    public function getEmail_ccMail() {
        return $this->email_ccMail;
    }

    /**
     * @param field_type $email_ccMail
     */
    public function setEmail_ccMail($email_ccMail) {
        $this->email_ccMail = $email_ccMail;
    }

    /**
     * @return the $email_bccMail
     */
    public function getEmail_bccMail() {
        return $this->email_bccMail;
    }

    /**
     * @param field_type $email_bccMail
     */
    public function setEmail_bccMail($email_bccMail) {
        $this->email_bccMail = $email_bccMail;
    }

    /**
     * @return the $email_dateAdded
     */
    public function getEmail_dateAdded() {
        return $this->email_dateAdded;
    }

    /**
     * @param field_type $email_dateAdded
     */
    public function setEmail_dateAdded($email_dateAdded) {
        $this->email_dateAdded = $email_dateAdded;
    }

    /**
     * @return the $email_dateUpdated
     */
    public function getEmail_dateUpdated() {
        return $this->email_dateUpdated;
    }

    /**
     * @param field_type $email_dateUpdated
     */
    public function setEmail_dateUpdated($email_dateUpdated) {
        $this->email_dateUpdated = $email_dateUpdated;
    }

    /**
     * @return the $email_vars
     */
    public function getVars() {
        try {
            return @eval("return ".$this->email_vars.";");
        } catch (Exception $e) {
        }
        return array();
    }

    public function checkVars(){
        $checked = false;
        try {
            $vars = $this->getVars();
            if(is_array($vars)){
                $checked = true;
            }
        } catch (Exception $e) {
        }
        return $checked;
    }


    // TDTODO : Faire une fonction qui check les templates pour savoir s'ils existent ou pas

}