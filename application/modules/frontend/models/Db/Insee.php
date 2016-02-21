<?php
/**
 * Générateur version 2.0
 */
class Db_Insee extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Insee";
		$this->_myDbPrimary         = "INSEE";
		$this->_myMetierClassName   = "Insee";
		$this->_myDbTableName       = "frontend_insee";
		$this->_myDbFieldPrefix     = "";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}
