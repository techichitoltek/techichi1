<?php
/**
 *  models/Metier/CatalogueProduitSearch.php
 */


/**
 * Générateur version 2.0
 */
class CatalogueProduitSearch extends CatalogueProduit {



	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_CatalogueProduitSearch";
		$this->_myDbPrimary         = "catalogue_produits_id";
		$this->_myMetierClassName   = "CatalogueProduitSearch";
		$this->_myDbTableName       = "frontend_catalogue_produits_search";
		$this->_myDbFieldPrefix     = "catalogue_produits";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	public function prepareSearch(){
		$objDb = new $this->_myDbClassName; /* @var $objDb Db_CatalogueProduitSearch */
		$sql = 'DELETE FROM frontend_catalogue_produits_search WHERE (catalogue_produits_deleted = 1) AND (catalogue_produits_used = 0)';
		$objDb->Db_execute($sql);
		$sql = 'OPTIMIZE TABLE `frontend_catalogue_produits` , `frontend_catalogue_produits_search`;';
		$objDb->Db_execute($sql);
	}


}