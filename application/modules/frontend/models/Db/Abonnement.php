<?php

/**
 *  models/Db/Abonnement.php
 */

/**
 * Générateur version 2.0
 */
class Db_Abonnement extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Abonnement";
		$this->_myDbPrimary         = "abo_id";
		$this->_myMetierClassName   = "Abonnement";
		$this->_myDbTableName       = "frontend_abonnement";
		$this->_myDbFieldPrefix     = "abo";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}