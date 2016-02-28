<?php
/**
 *  models/Metier/TransactionSearch.php
 */


/**
 * Générateur version 2.0
 */
class TransactionSearch extends Transaction {

	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_TransactionSearch";
		$this->_myDbPrimary         = "transaction_id";
		$this->_myMetierClassName   = "TransactionSearch";
		$this->_myDbTableName       = "frontend_transaction_search";
		$this->_myDbFieldPrefix     = "transaction";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////



	public function prepareSearch(){
		$objDb = new $this->_myDbClassName; /* @var $objDb Db_TransactionSearch */
		$sql = 'DELETE FROM frontend_transaction_search WHERE (transaction_deleted = 1)';
		$objDb->Db_execute($sql);
		$sql = 'OPTIMIZE TABLE `frontend_transaction` , `frontend_transaction_search`;';
		$objDb->Db_execute($sql);
	}

}