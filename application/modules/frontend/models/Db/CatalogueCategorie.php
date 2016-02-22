<?php

/**
 *  models/Db/CatalogueCategorie.php
 */

/**
 * Générateur version 2.0
 */
class Db_CatalogueCategorie extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_CatalogueCategorie";
		$this->_myDbPrimary         = "catalogue_categorie_id";
		$this->_myMetierClassName   = "CatalogueCategorie";
		$this->_myDbTableName       = "frontend_catalogue_categorie";
		$this->_myDbFieldPrefix     = "catalogue_categorie";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}