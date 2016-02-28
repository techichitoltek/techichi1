<?php
/**
 *  models/Metier/EnchereSearch.php
 */


/**
 * Générateur version 2.0
 */
class EnchereSearch extends Enchere {

	/**
	 *
	 * @var CatalogueProduitSearch
	 */
	protected $enchere_produit = null;

	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_EnchereSearch";
		$this->_myDbPrimary         = "enchere_id";
		$this->_myMetierClassName   = "EnchereSearch";
		$this->_myDbTableName       = "frontend_enchere_search";
		$this->_myDbFieldPrefix     = "enchere";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////

	public function prepareSearch(){
		$objDb = new $this->_myDbClassName; /* @var $objDb Db_EnchereSearch */
		$sql = 'DELETE FROM frontend_enchere_search WHERE (enchere_end < NOW() ) AND (enchere_statut_id = '.ParamCustom::param("FRONTEND.STATUT_CLEAR","FRONTEND").' )';
		$objDb->Db_execute($sql);
		$sql = 'OPTIMIZE TABLE `frontend_catalogue_produits` , `frontend_catalogue_produits_search`;';
		$objDb->Db_execute($sql);
	}


}
