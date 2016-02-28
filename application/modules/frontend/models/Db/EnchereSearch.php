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
		$this->_myDbPrimary         = "enchere_id";
		$this->_myMetierClassName   = "EnchereSearch";
		$this->_myDbTableName       = "frontend_enchere_search";
		$this->_myDbFieldPrefix     = "enchere";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}


	function SearchSelectBuild($limit=false,$from=false){
		$now = new Zend_Date();
		$select = $this->select()->setIntegrityCheck(false);
		$select->from(array('enchere'=>$this->_myDbTableName),array("*"));
		$select->join(array("produit"=>'frontend_catalogue_produits_search'),"`enchere`.`enchere_produit_id` = `produit`.`catalogue_produits_id`",array("*"));
		$select->where('enchere_end > NOW()');
		if($limit){
			$select->limit($limit);
		}
		return $select;
	}

}