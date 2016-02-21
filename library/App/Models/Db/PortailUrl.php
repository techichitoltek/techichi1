<?php
class Db_PortailUrl extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_PortailUrl";
        $this->_myDbPrimary         = "portailurl_id";
        $this->_myMetierClassName   = "PortailUrl";
        $this->_myDbTableName       = "ztdf_portailurl";
        $this->_myDbFieldPrefix     = "portailurl";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}