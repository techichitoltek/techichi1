<?php



/**
 *  models/Db/IncidentIndex.php
 */

/**
 * Générateur version 2.0
 */
class Db_IncidentIndex extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_IncidentIndex";
		$this->_myDbPrimary         = "index_id";
		$this->_myMetierClassName   = "IncidentIndex";
		$this->_myDbTableName       = "frontend_incident_index";
		$this->_myDbFieldPrefix     = "index";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}