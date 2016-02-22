<?php



/**
 *  models/Db/EvaluationTransaction.php
 */

/**
 * Générateur version 2.0
 */
class Db_EvaluationTransaction extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_EvaluationTransaction";
		$this->_myDbPrimary         = "evaltransaction_id";
		$this->_myMetierClassName   = "EvaluationTransaction";
		$this->_myDbTableName       = "frontend_evaluation_transaction";
		$this->_myDbFieldPrefix     = "evaltransaction";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}