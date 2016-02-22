<?php
class Db_Email extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_Email";
        $this->_myDbPrimary         = "email_id";
        $this->_myMetierClassName   = "Email";
        $this->_myDbTableName       = "zf_emails";
        $this->_myDbFieldPrefix     = "email";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}