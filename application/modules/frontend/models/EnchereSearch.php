<?php
/**
 *  models/Metier/EnchereSearch.php
 */


/**
 * Générateur version 2.0
 */
class EnchereSearch extends App_Model_Std {


	/* Champs de la table */

	protected $enchere_search_id = 0;
	protected $enchere_search_statut_id = "";
	protected $enchere_search_vendeur_id = "";
	protected $enchere_search_acheteur_id = null;
	protected $enchere_search_transaction_id = null;
	protected $enchere_search_produit_id = "";
	protected $enchere_search_categorie_id = "";
	protected $enchere_search_offre_id = null;
	protected $enchere_search_offre_fin = null;
	protected $enchere_search_start = "";
	protected $enchere_search_end = "";
	protected $enchere_search_prix_depart = "";
	protected $enchere_search_prix_reserve = "";
	protected $enchere_search_code_insee = "";
	protected $enchere_search_code_pays = "";
	protected $enchere_search_indexation = null;
	protected $enchere_search_dateAdded = null;
	protected $enchere_search_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_EnchereSearch";
		$this->_myDbPrimary         = "enchere_search_id";
		$this->_myMetierClassName   = "EnchereSearch";
		$this->_myDbTableName       = "frontend_enchere_search";
		$this->_myDbFieldPrefix     = "enchere_search";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $enchere_search_id
	 */
	public function setEnchere_search_id($enchere_search_id)
	{
		$this->enchere_search_id = $enchere_search_id;
	}

	/**
	 * @return the  $enchere_search_id
	 */
	public function getEnchere_search_id()
	{
		return $this->enchere_search_id;
	}

	/**
	 * @param int $enchere_search_statut_id
	 */
	public function setEnchere_search_statut_id($enchere_search_statut_id)
	{
		$this->enchere_search_statut_id = $enchere_search_statut_id;
	}

	/**
	 * @return the  $enchere_search_statut_id
	 */
	public function getEnchere_search_statut_id()
	{
		return $this->enchere_search_statut_id;
	}

	/**
	 * @param int $enchere_search_vendeur_id
	 */
	public function setEnchere_search_vendeur_id($enchere_search_vendeur_id)
	{
		$this->enchere_search_vendeur_id = $enchere_search_vendeur_id;
	}

	/**
	 * @return the  $enchere_search_vendeur_id
	 */
	public function getEnchere_search_vendeur_id()
	{
		return $this->enchere_search_vendeur_id;
	}

	/**
	 * @param int $enchere_search_acheteur_id
	 */
	public function setEnchere_search_acheteur_id($enchere_search_acheteur_id)
	{
		$this->enchere_search_acheteur_id = $enchere_search_acheteur_id;
	}

	/**
	 * @return the  $enchere_search_acheteur_id
	 */
	public function getEnchere_search_acheteur_id()
	{
		return $this->enchere_search_acheteur_id;
	}

	/**
	 * @param int $enchere_search_transaction_id
	 */
	public function setEnchere_search_transaction_id($enchere_search_transaction_id)
	{
		$this->enchere_search_transaction_id = $enchere_search_transaction_id;
	}

	/**
	 * @return the  $enchere_search_transaction_id
	 */
	public function getEnchere_search_transaction_id()
	{
		return $this->enchere_search_transaction_id;
	}

	/**
	 * @param int $enchere_search_produit_id
	 */
	public function setEnchere_search_produit_id($enchere_search_produit_id)
	{
		$this->enchere_search_produit_id = $enchere_search_produit_id;
	}

	/**
	 * @return the  $enchere_search_produit_id
	 */
	public function getEnchere_search_produit_id()
	{
		return $this->enchere_search_produit_id;
	}

	/**
	 * @param int $enchere_search_categorie_id
	 */
	public function setEnchere_search_categorie_id($enchere_search_categorie_id)
	{
		$this->enchere_search_categorie_id = $enchere_search_categorie_id;
	}

	/**
	 * @return the  $enchere_search_categorie_id
	 */
	public function getEnchere_search_categorie_id()
	{
		return $this->enchere_search_categorie_id;
	}

	/**
	 * @param int $enchere_search_offre_id
	 */
	public function setEnchere_search_offre_id($enchere_search_offre_id)
	{
		$this->enchere_search_offre_id = $enchere_search_offre_id;
	}

	/**
	 * @return the  $enchere_search_offre_id
	 */
	public function getEnchere_search_offre_id()
	{
		return $this->enchere_search_offre_id;
	}

	/**
	 * @param int $enchere_search_offre_fin
	 */
	public function setEnchere_search_offre_fin($enchere_search_offre_fin)
	{
		$this->enchere_search_offre_fin = $enchere_search_offre_fin;
	}

	/**
	 * @return the  $enchere_search_offre_fin
	 */
	public function getEnchere_search_offre_fin()
	{
		return $this->enchere_search_offre_fin;
	}

	/**
	 * @param datetime $enchere_search_start
	 */
	public function setEnchere_search_start($enchere_search_start)
	{
		$this->enchere_search_start = $enchere_search_start;
	}

	/**
	 * @return the  $enchere_search_start
	 */
	public function getEnchere_search_start()
	{
		return $this->enchere_search_start;
	}

	/**
	 * @param datetime $enchere_search_end
	 */
	public function setEnchere_search_end($enchere_search_end)
	{
		$this->enchere_search_end = $enchere_search_end;
	}

	/**
	 * @return the  $enchere_search_end
	 */
	public function getEnchere_search_end()
	{
		return $this->enchere_search_end;
	}

	/**
	 * @param float $enchere_search_prix_depart
	 */
	public function setEnchere_search_prix_depart($enchere_search_prix_depart)
	{
		$this->enchere_search_prix_depart = $enchere_search_prix_depart;
	}

	/**
	 * @return the  $enchere_search_prix_depart
	 */
	public function getEnchere_search_prix_depart()
	{
		return $this->enchere_search_prix_depart;
	}

	/**
	 * @param float $enchere_search_prix_reserve
	 */
	public function setEnchere_search_prix_reserve($enchere_search_prix_reserve)
	{
		$this->enchere_search_prix_reserve = $enchere_search_prix_reserve;
	}

	/**
	 * @return the  $enchere_search_prix_reserve
	 */
	public function getEnchere_search_prix_reserve()
	{
		return $this->enchere_search_prix_reserve;
	}

	/**
	 * @param varchar $enchere_search_code_insee
	 */
	public function setEnchere_search_code_insee($enchere_search_code_insee)
	{
		$this->enchere_search_code_insee = $enchere_search_code_insee;
	}

	/**
	 * @return the  $enchere_search_code_insee
	 */
	public function getEnchere_search_code_insee()
	{
		return $this->enchere_search_code_insee;
	}

	/**
	 * @param int $enchere_search_code_pays
	 */
	public function setEnchere_search_code_pays($enchere_search_code_pays)
	{
		$this->enchere_search_code_pays = $enchere_search_code_pays;
	}

	/**
	 * @return the  $enchere_search_code_pays
	 */
	public function getEnchere_search_code_pays()
	{
		return $this->enchere_search_code_pays;
	}

	/**
	 * @param longtext $enchere_search_indexation
	 */
	public function setEnchere_search_indexation($enchere_search_indexation)
	{
		$this->enchere_search_indexation = $enchere_search_indexation;
	}

	/**
	 * @return the  $enchere_search_indexation
	 */
	public function getEnchere_search_indexation()
	{
		return $this->enchere_search_indexation;
	}

	/**
	 * @param datetime $enchere_search_dateAdded
	 */
	public function setEnchere_search_dateAdded($enchere_search_dateAdded)
	{
		$this->enchere_search_dateAdded = $enchere_search_dateAdded;
	}

	/**
	 * @return the  $enchere_search_dateAdded
	 */
	public function getEnchere_search_dateAdded()
	{
		return $this->enchere_search_dateAdded;
	}

	/**
	 * @param timestamp $enchere_search_dateUpdated
	 */
	public function setEnchere_search_dateUpdated($enchere_search_dateUpdated)
	{
		$this->enchere_search_dateUpdated = $enchere_search_dateUpdated;
	}

	/**
	 * @return the  $enchere_search_dateUpdated
	 */
	public function getEnchere_search_dateUpdated()
	{
		return $this->enchere_search_dateUpdated;
	}


}	