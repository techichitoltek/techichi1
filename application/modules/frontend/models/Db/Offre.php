<?php



/**
 *  models/Db/Offre.php
 */

/**
 * Générateur version 2.0
 */
class Db_Offre extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Offre";
		$this->_myDbPrimary         = "offre_id";
		$this->_myMetierClassName   = "Offre";
		$this->_myDbTableName       = "frontend_offre";
		$this->_myDbFieldPrefix     = "offre";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}