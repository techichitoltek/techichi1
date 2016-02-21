<?php



/**
 *  models/Db/EvaluationNotation.php
 */

/**
 * Générateur version 2.0
 */
class Db_EvaluationNotation extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_EvaluationNotation";
		$this->_myDbPrimary         = "notation_id";
		$this->_myMetierClassName   = "EvaluationNotation";
		$this->_myDbTableName       = "frontend_evaluation_notation";
		$this->_myDbFieldPrefix     = "notation";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}