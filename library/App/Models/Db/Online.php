<?php
class Db_Online extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_Online";
        $this->_myDbPrimary         = "online_id";
        $this->_myMetierClassName   = "Online";
        $this->_myDbTableName       = "zf_online";
        $this->_myDbFieldPrefix     = "online";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}