<?php

/**
 *  models/Db/CatalogueBibliotheque.php
 */

/**
 * Générateur version 2.0
 */
class Db_CatalogueBibliotheque extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_CatalogueBibliotheque";
		$this->_myDbPrimary         = "catalogue_bibliotheque_id";
		$this->_myMetierClassName   = "CatalogueBibliotheque";
		$this->_myDbTableName       = "frontend_catalogue_bibliotheque";
		$this->_myDbFieldPrefix     = "catalogue_bibliotheque";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}