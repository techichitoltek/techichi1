<?php



/**
 *  models/Db/CatalogueProduit.php
 */

/**
 * Générateur version 2.0
 */
class Db_CatalogueProduit extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_CatalogueProduit";
		$this->_myDbPrimary         = "catalogue_produits_id";
		$this->_myMetierClassName   = "CatalogueProduit";
		$this->_myDbTableName       = "frontend_catalogue_produits";
		$this->_myDbFieldPrefix     = "catalogue_produits";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}