<?php
class Db_EmailLog extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_EmailLog";
        $this->_myDbPrimary         = "emailLog_id";
        $this->_myMetierClassName   = "EmailLog";
        $this->_myDbTableName       = "ztdf_emails_log";
        $this->_myDbFieldPrefix     = "emailLog";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}