<?php
class Db_Portail extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_Portail";
        $this->_myDbPrimary         = "portail_id";
        $this->_myMetierClassName   = "Portail";
        $this->_myDbTableName       = "zf_portails";
        $this->_myDbFieldPrefix     = "portail";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}