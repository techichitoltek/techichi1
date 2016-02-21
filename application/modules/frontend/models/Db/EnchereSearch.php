<?php



/**
 *  models/Db/EnchereSearch.php
 */

/**
 * Générateur version 2.0
 */
class Db_EnchereSearch extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_EnchereSearch";
		$this->_myDbPrimary         = "enchere_search_id";
		$this->_myMetierClassName   = "EnchereSearch";
		$this->_myDbTableName       = "frontend_enchere_search";
		$this->_myDbFieldPrefix     = "enchere_search";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}