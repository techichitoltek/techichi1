<?php
class Db_LogPerf extends App_Model_Db {

    public function __construct()
    {
        $this->_myDbClassName       = "Db_LogPerf";
        $this->_myDbPrimary         = "logperf_id";
        $this->_myMetierClassName   = "LogPerf";
        $this->_myDbTableName       = "zf_logperf";
        $this->_myDbFieldPrefix     = "logperf";

        parent::__construct();
    }

    function myFullSelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

}