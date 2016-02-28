<?php
/**
 *  models/Metier/Enchere.php
 */


/**
 * Générateur version 2.0
 */
class Enchere extends App_Model_Std {


	/* Champs de la table */

	protected $enchere_id = 0;
	protected $enchere_statut_id = "";
	protected $enchere_incident_id = null;
	protected $enchere_vendeur_id = "";
	protected $enchere_acheteur_id = null;
	protected $enchere_transaction_id = null;
	protected $enchere_produit_id = "";
	protected $enchere_categorie_id = "";
	protected $enchere_offre_id = null;
	protected $enchere_offre_fin = null;
	protected $enchere_start = "";
	protected $enchere_end = "";
	protected $enchere_prix_depart = "";
	protected $enchere_prix_reserve = "";
	protected $enchere_code_insee = "";
	protected $enchere_code_pays = "";
	protected $enchere_indexation = null;
	protected $enchere_dateAdded = null;
	protected $enchere_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Enchere";
		$this->_myDbPrimary         = "enchere_id";
		$this->_myMetierClassName   = "Enchere";
		$this->_myDbTableName       = "frontend_enchere";
		$this->_myDbFieldPrefix     = "enchere";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $enchere_id
	 */
	public function setEnchere_id($enchere_id)
	{
		$this->enchere_id = $enchere_id;
	}

	/**
	 * @return the  $enchere_id
	 */
	public function getEnchere_id()
	{
		return $this->enchere_id;
	}

	/**
	 * @param int $enchere_incident_id
	 */
	public function setEnchere_incident_id($enchere_incident_id)
	{
		$this->enchere_incident_id = $enchere_incident_id;
	}

	/**
	 * @return the  $enchere_incident_id
	 */
	public function getEnchere_incident_id()
	{
		return $this->enchere_incident_id;
	}

	/**
	 * @param int $enchere_statut_id
	 */
	public function setEnchere_statut_id($enchere_statut_id)
	{
		$this->enchere_statut_id = $enchere_statut_id;
	}

	/**
	 * @return the  $enchere_statut_id
	 */
	public function getEnchere_statut_id()
	{
		return $this->enchere_statut_id;
	}

	/**
	 * @param int $enchere_vendeur_id
	 */
	public function setEnchere_vendeur_id($enchere_vendeur_id)
	{
		$this->enchere_vendeur_id = $enchere_vendeur_id;
	}

	/**
	 * @return the  $enchere_vendeur_id
	 */
	public function getEnchere_vendeur_id()
	{
		return $this->enchere_vendeur_id;
	}

	/**
	 * @param int $enchere_acheteur_id
	 */
	public function setEnchere_acheteur_id($enchere_acheteur_id)
	{
		$this->enchere_acheteur_id = $enchere_acheteur_id;
	}

	/**
	 * @return the  $enchere_acheteur_id
	 */
	public function getEnchere_acheteur_id()
	{
		return $this->enchere_acheteur_id;
	}

	/**
	 * @param int $enchere_transaction_id
	 */
	public function setEnchere_transaction_id($enchere_transaction_id)
	{
		$this->enchere_transaction_id = $enchere_transaction_id;
	}

	/**
	 * @return the  $enchere_transaction_id
	 */
	public function getEnchere_transaction_id()
	{
		return $this->enchere_transaction_id;
	}

	/**
	 * @param int $enchere_produit_id
	 */
	public function setEnchere_produit_id($enchere_produit_id)
	{
		$this->enchere_produit_id = $enchere_produit_id;
	}

	/**
	 * @return the  $enchere_produit_id
	 */
	public function getEnchere_produit_id()
	{
		return $this->enchere_produit_id;
	}

	/**
	 * @param int $enchere_categorie_id
	 */
	public function setEnchere_categorie_id($enchere_categorie_id)
	{
		$this->enchere_categorie_id = $enchere_categorie_id;
	}

	/**
	 * @return the  $enchere_categorie_id
	 */
	public function getEnchere_categorie_id()
	{
		return $this->enchere_categorie_id;
	}

	/**
	 * @param int $enchere_offre_id
	 */
	public function setEnchere_offre_id($enchere_offre_id)
	{
		$this->enchere_offre_id = $enchere_offre_id;
	}

	/**
	 * @return the  $enchere_offre_id
	 */
	public function getEnchere_offre_id()
	{
		return $this->enchere_offre_id;
	}

	/**
	 * @param int $enchere_offre_fin
	 */
	public function setEnchere_offre_fin($enchere_offre_fin)
	{
		$this->enchere_offre_fin = $enchere_offre_fin;
	}

	/**
	 * @return the  $enchere_offre_fin
	 */
	public function getEnchere_offre_fin()
	{
		return $this->enchere_offre_fin;
	}

	/**
	 * @param datetime $enchere_start
	 */
	public function setEnchere_start($enchere_start)
	{
		$this->enchere_start = $enchere_start;
	}

	/**
	 * @return the  $enchere_start
	 */
	public function getEnchere_start()
	{
		return $this->enchere_start;
	}

	/**
	 * @param datetime $enchere_end
	 */
	public function setEnchere_end($enchere_end)
	{
		$this->enchere_end = $enchere_end;
	}

	/**
	 * @return the  $enchere_end
	 */
	public function getEnchere_end()
	{
		return $this->enchere_end;
	}

	/**
	 * @param float $enchere_prix_depart
	 */
	public function setEnchere_prix_depart($enchere_prix_depart)
	{
		$this->enchere_prix_depart = $enchere_prix_depart;
	}

	/**
	 * @return the  $enchere_prix_depart
	 */
	public function getEnchere_prix_depart()
	{
		return $this->enchere_prix_depart;
	}

	/**
	 * @param float $enchere_prix_reserve
	 */
	public function setEnchere_prix_reserve($enchere_prix_reserve)
	{
		$this->enchere_prix_reserve = $enchere_prix_reserve;
	}

	/**
	 * @return the  $enchere_prix_reserve
	 */
	public function getEnchere_prix_reserve()
	{
		return $this->enchere_prix_reserve;
	}

	/**
	 * @param varchar $enchere_code_insee
	 */
	public function setEnchere_code_insee($enchere_code_insee)
	{
		$this->enchere_code_insee = $enchere_code_insee;
	}

	/**
	 * @return the  $enchere_code_insee
	 */
	public function getEnchere_code_insee()
	{
		return $this->enchere_code_insee;
	}

	/**
	 * @param int $enchere_code_pays
	 */
	public function setEnchere_code_pays($enchere_code_pays)
	{
		$this->enchere_code_pays = $enchere_code_pays;
	}

	/**
	 * @return the  $enchere_code_pays
	 */
	public function getEnchere_code_pays()
	{
		return $this->enchere_code_pays;
	}

	/**
	 * @param longtext $enchere_indexation
	 */
	public function setEnchere_indexation($enchere_indexation)
	{
		$this->enchere_indexation = $enchere_indexation;
	}

	/**
	 * @return the  $enchere_indexation
	 */
	public function getEnchere_indexation()
	{
		return $this->enchere_indexation;
	}

	/**
	 * @param datetime $enchere_dateAdded
	 */
	public function setEnchere_dateAdded($enchere_dateAdded)
	{
		$this->enchere_dateAdded = $enchere_dateAdded;
	}

	/**
	 * @return the  $enchere_dateAdded
	 */
	public function getEnchere_dateAdded()
	{
		return $this->enchere_dateAdded;
	}

	/**
	 * @param timestamp $enchere_dateUpdated
	 */
	public function setEnchere_dateUpdated($enchere_dateUpdated)
	{
		$this->enchere_dateUpdated = $enchere_dateUpdated;
	}

	/**
	 * @return the  $enchere_dateUpdated
	 */
	public function getEnchere_dateUpdated()
	{
		return $this->enchere_dateUpdated;
	}

	/**
	 *
	 * @return Produit
	 */
	public function getProduit(){
		if(!$this->enchere_produit){
			$this->enchere_produit = new CatalogueProduitSearch($this->enchere_produit_id);
		}
		return $this->enchere_produit;
	}

	public function getActiveEnchereListe(){
		$objDB = new $this->_myDbClassName(); /* @var $objDB Db_EnchereSearch */
		$select = $objDB->SearchSelectBuild();
		return $this->getListe(false,$select);
	}

	public function getLastTransactionBid(){
		$mod_transaction = new TransactionSearch();
		return $mod_transaction->getLastTransactionBidObject($this->enchere_id);
	}

}