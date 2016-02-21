<?php



/**
 *  models/Db/Transaction.php
 */

/**
 * Générateur version 2.0
 */
class Db_Transaction extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_Transaction";
		$this->_myDbPrimary         = "transaction_id";
		$this->_myMetierClassName   = "Transaction";
		$this->_myDbTableName       = "frontend_transaction";
		$this->_myDbFieldPrefix     = "transaction";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}