<?php
/**
 *  models/Db/AbonnementType.php
 */

/**
 * Générateur version 2.0
 */
class Db_AbonnementType extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_AbonnementType";
		$this->_myDbPrimary         = "abotype_id";
		$this->_myMetierClassName   = "AbonnementType";
		$this->_myDbTableName       = "frontend_abonement_type";
		$this->_myDbFieldPrefix     = "abotype";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}