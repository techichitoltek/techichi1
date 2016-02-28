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
		$this->_myDbPrimary         = "transaction_id";
		$this->_myMetierClassName   = "TransactionSearch";
		$this->_myDbTableName       = "frontend_transaction_search";
		$this->_myDbFieldPrefix     = "transaction";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

	function GuestSearchSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		$select->from(array('transaction'=>$this->_myDbTableName),array("transaction_montant"));
		//$select->join(array("enchere"=>'frontend_enchere_search'),"`transaction`.`transaction_enchere_id` = `enchere`.`enchere_id`",array("*"));
/*		if($limit){
			$select->limit($limit);
		}*/
		return $select;
	}
}