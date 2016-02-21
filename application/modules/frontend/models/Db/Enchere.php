<?php
/**
 *  models/Db/Enchere.php
 */

/**
 * Générateur version 2.0
 */
class Db_Enchere extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Enchere";
		$this->_myDbPrimary         = "enchere_id";
		$this->_myMetierClassName   = "Enchere";
		$this->_myDbTableName       = "frontend_enchere";
		$this->_myDbFieldPrefix     = "enchere";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}