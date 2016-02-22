<?php

/**
 *  models/Db/Pays.php
 */

/**
 * Générateur version 2.0
 */
class Db_Pays extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Pays";
		$this->_myDbPrimary         = "id";
		$this->_myMetierClassName   = "Pays";
		$this->_myDbTableName       = "frontend_pays";
		$this->_myDbFieldPrefix     = "";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}