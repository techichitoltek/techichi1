<?php
/**
 *  models/Db/FrontendDepartement.php
 */

/**
 * Générateur version 2.0
 */
class Db_FrontendDepartement extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_FrontendDepartement";
		$this->_myDbPrimary         = "dep_code";
		$this->_myMetierClassName   = "FrontendDepartement";
		$this->_myDbTableName       = "frontend_departement";
		$this->_myDbFieldPrefix     = "dep";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}