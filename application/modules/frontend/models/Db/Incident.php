<?php



/**
 *  models/Db/Incident.php
 */

/**
 * Générateur version 2.0
 */
class Db_Incident extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Incident";
		$this->_myDbPrimary         = "incident_id";
		$this->_myMetierClassName   = "Incident";
		$this->_myDbTableName       = "frontend_incident";
		$this->_myDbFieldPrefix     = "incident";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}