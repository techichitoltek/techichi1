<?php



/**
 *  models/Db/TransactionSearch.php
 */

/**
 * Générateur version 2.0
 */
class Db_TransactionSearch extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_TransactionSearch";
		$this->_myDbPrimary         = "transaction_search_id";
		$this->_myMetierClassName   = "TransactionSearch";
		$this->_myDbTableName       = "frontend_transaction_search";
		$this->_myDbFieldPrefix     = "transaction_search";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}