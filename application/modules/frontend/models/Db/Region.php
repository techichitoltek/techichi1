<?php



/**
 *  models/Db/Region.php
 */

/**
 * Générateur version 2.0
 */
class Db_Region extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Region";
		$this->_myDbPrimary         = "reg_code";
		$this->_myMetierClassName   = "Region";
		$this->_myDbTableName       = "frontend_region";
		$this->_myDbFieldPrefix     = "reg";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}