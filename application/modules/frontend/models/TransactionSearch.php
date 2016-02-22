<?php
/**
 *  models/Metier/TransactionSearch.php
 */


/**
 * Générateur version 2.0
 */
class TransactionSearch extends App_Model_Std {


	/* Champs de la table */

	protected $transaction_search_id = 0;
	protected $transaction_search_enchere_id = "";
	protected $transaction_search_date = "";
	protected $transaction_search_acheteur_id = null;
	protected $transaction_search_vendeur_id = "";
	protected $transaction_search_montant = null;
	protected $transaction_search_incident_id = null;
	protected $transaction_search_paimeent_valide = 0;
	protected $transaction_search_annule = 0;
	protected $transaction_search_livraison_date = null;
	protected $transaction_search_reception_date = null;
	protected $transaction_search_evaluation_id = null;
	protected $transaction_search_dateAdded = null;
	protected $transaction_search_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_TransactionSearch";
		$this->_myDbPrimary         = "transaction_search_id";
		$this->_myMetierClassName   = "TransactionSearch";
		$this->_myDbTableName       = "frontend_transaction_search";
		$this->_myDbFieldPrefix     = "transaction_search";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $transaction_search_id
	 */
	public function setTransaction_search_id($transaction_search_id)
	{
		$this->transaction_search_id = $transaction_search_id;
	}

	/**
	 * @return the  $transaction_search_id
	 */
	public function getTransaction_search_id()
	{
		return $this->transaction_search_id;
	}

	/**
	 * @param int $transaction_search_enchere_id
	 */
	public function setTransaction_search_enchere_id($transaction_search_enchere_id)
	{
		$this->transaction_search_enchere_id = $transaction_search_enchere_id;
	}

	/**
	 * @return the  $transaction_search_enchere_id
	 */
	public function getTransaction_search_enchere_id()
	{
		return $this->transaction_search_enchere_id;
	}

	/**
	 * @param datetime $transaction_search_date
	 */
	public function setTransaction_search_date($transaction_search_date)
	{
		$this->transaction_search_date = $transaction_search_date;
	}

	/**
	 * @return the  $transaction_search_date
	 */
	public function getTransaction_search_date()
	{
		return $this->transaction_search_date;
	}

	/**
	 * @param int $transaction_search_acheteur_id
	 */
	public function setTransaction_search_acheteur_id($transaction_search_acheteur_id)
	{
		$this->transaction_search_acheteur_id = $transaction_search_acheteur_id;
	}

	/**
	 * @return the  $transaction_search_acheteur_id
	 */
	public function getTransaction_search_acheteur_id()
	{
		return $this->transaction_search_acheteur_id;
	}

	/**
	 * @param int $transaction_search_vendeur_id
	 */
	public function setTransaction_search_vendeur_id($transaction_search_vendeur_id)
	{
		$this->transaction_search_vendeur_id = $transaction_search_vendeur_id;
	}

	/**
	 * @return the  $transaction_search_vendeur_id
	 */
	public function getTransaction_search_vendeur_id()
	{
		return $this->transaction_search_vendeur_id;
	}

	/**
	 * @param float $transaction_search_montant
	 */
	public function setTransaction_search_montant($transaction_search_montant)
	{
		$this->transaction_search_montant = $transaction_search_montant;
	}

	/**
	 * @return the  $transaction_search_montant
	 */
	public function getTransaction_search_montant()
	{
		return $this->transaction_search_montant;
	}

	/**
	 * @param int $transaction_search_incident_id
	 */
	public function setTransaction_search_incident_id($transaction_search_incident_id)
	{
		$this->transaction_search_incident_id = $transaction_search_incident_id;
	}

	/**
	 * @return the  $transaction_search_incident_id
	 */
	public function getTransaction_search_incident_id()
	{
		return $this->transaction_search_incident_id;
	}

	/**
	 * @param int $transaction_search_paimeent_valide
	 */
	public function setTransaction_search_paimeent_valide($transaction_search_paimeent_valide)
	{
		$this->transaction_search_paimeent_valide = $transaction_search_paimeent_valide;
	}

	/**
	 * @return the  $transaction_search_paimeent_valide
	 */
	public function getTransaction_search_paimeent_valide()
	{
		return $this->transaction_search_paimeent_valide;
	}

	/**
	 * @param int $transaction_search_annule
	 */
	public function setTransaction_search_annule($transaction_search_annule)
	{
		$this->transaction_search_annule = $transaction_search_annule;
	}

	/**
	 * @return the  $transaction_search_annule
	 */
	public function getTransaction_search_annule()
	{
		return $this->transaction_search_annule;
	}

	/**
	 * @param datetime $transaction_search_livraison_date
	 */
	public function setTransaction_search_livraison_date($transaction_search_livraison_date)
	{
		$this->transaction_search_livraison_date = $transaction_search_livraison_date;
	}

	/**
	 * @return the  $transaction_search_livraison_date
	 */
	public function getTransaction_search_livraison_date()
	{
		return $this->transaction_search_livraison_date;
	}

	/**
	 * @param datetime $transaction_search_reception_date
	 */
	public function setTransaction_search_reception_date($transaction_search_reception_date)
	{
		$this->transaction_search_reception_date = $transaction_search_reception_date;
	}

	/**
	 * @return the  $transaction_search_reception_date
	 */
	public function getTransaction_search_reception_date()
	{
		return $this->transaction_search_reception_date;
	}

	/**
	 * @param int $transaction_search_evaluation_id
	 */
	public function setTransaction_search_evaluation_id($transaction_search_evaluation_id)
	{
		$this->transaction_search_evaluation_id = $transaction_search_evaluation_id;
	}

	/**
	 * @return the  $transaction_search_evaluation_id
	 */
	public function getTransaction_search_evaluation_id()
	{
		return $this->transaction_search_evaluation_id;
	}

	/**
	 * @param datetime $transaction_search_dateAdded
	 */
	public function setTransaction_search_dateAdded($transaction_search_dateAdded)
	{
		$this->transaction_search_dateAdded = $transaction_search_dateAdded;
	}

	/**
	 * @return the  $transaction_search_dateAdded
	 */
	public function getTransaction_search_dateAdded()
	{
		return $this->transaction_search_dateAdded;
	}

	/**
	 * @param timestamp $transaction_search_dateUpdated
	 */
	public function setTransaction_search_dateUpdated($transaction_search_dateUpdated)
	{
		$this->transaction_search_dateUpdated = $transaction_search_dateUpdated;
	}

	/**
	 * @return the  $transaction_search_dateUpdated
	 */
	public function getTransaction_search_dateUpdated()
	{
		return $this->transaction_search_dateUpdated;
	}


}