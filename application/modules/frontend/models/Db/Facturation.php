<?php



/**
 *  models/Db/Facturation.php
 */

/**
 * Générateur version 2.0
 */
class Db_Facturation extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Facturation";
		$this->_myDbPrimary         = "facturation_id";
		$this->_myMetierClassName   = "Facturation";
		$this->_myDbTableName       = "frontend_facturation";
		$this->_myDbFieldPrefix     = "facturation";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}