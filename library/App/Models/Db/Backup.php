<?php
class Db_Backup extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_Backup";
        $this->_myDbPrimary         = "backup_id";
        $this->_myMetierClassName   = "Backup";
        $this->_myDbTableName       = "ztdf_backup";
        $this->_myDbFieldPrefix     = "backup";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}