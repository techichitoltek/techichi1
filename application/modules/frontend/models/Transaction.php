<?php
/**
 *  models/Metier/Transaction.php
 */


/**
 * Générateur version 2.0
 */
class Transaction extends App_Model_Std {


	/* Champs de la table */

	protected $transaction_id = 0;
	protected $transaction_enchere_id = "";
	protected $transaction_date = "";
	protected $transaction_acheteur_id = null;
	protected $transaction_vendeur_id = "";
	protected $transaction_montant = null;
	protected $transaction_incident_id = null;
	protected $transaction_paimeent_valide = 0;
	protected $transaction_annule = 0;
	protected $transaction_livraison_date = null;
	protected $transaction_reception_date = null;
	protected $transaction_evaluation_id = null;
	protected $transaction_dateAdded = null;
	protected $transaction_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Transaction";
		$this->_myDbPrimary         = "transaction_id";
		$this->_myMetierClassName   = "Transaction";
		$this->_myDbTableName       = "frontend_transaction";
		$this->_myDbFieldPrefix     = "transaction";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $transaction_id
	 */
	public function setTransaction_id($transaction_id)
	{
		$this->transaction_id = $transaction_id;
	}

	/**
	 * @return the  $transaction_id
	 */
	public function getTransaction_id()
	{
		return $this->transaction_id;
	}

	/**
	 * @param int $transaction_enchere_id
	 */
	public function setTransaction_enchere_id($transaction_enchere_id)
	{
		$this->transaction_enchere_id = $transaction_enchere_id;
	}

	/**
	 * @return the  $transaction_enchere_id
	 */
	public function getTransaction_enchere_id()
	{
		return $this->transaction_enchere_id;
	}

	/**
	 * @param datetime $transaction_date
	 */
	public function setTransaction_date($transaction_date)
	{
		$this->transaction_date = $transaction_date;
	}

	/**
	 * @return the  $transaction_date
	 */
	public function getTransaction_date()
	{
		return $this->transaction_date;
	}

	/**
	 * @param int $transaction_acheteur_id
	 */
	public function setTransaction_acheteur_id($transaction_acheteur_id)
	{
		$this->transaction_acheteur_id = $transaction_acheteur_id;
	}

	/**
	 * @return the  $transaction_acheteur_id
	 */
	public function getTransaction_acheteur_id()
	{
		return $this->transaction_acheteur_id;
	}

	/**
	 * @param int $transaction_vendeur_id
	 */
	public function setTransaction_vendeur_id($transaction_vendeur_id)
	{
		$this->transaction_vendeur_id = $transaction_vendeur_id;
	}

	/**
	 * @return the  $transaction_vendeur_id
	 */
	public function getTransaction_vendeur_id()
	{
		return $this->transaction_vendeur_id;
	}

	/**
	 * @param float $transaction_montant
	 */
	public function setTransaction_montant($transaction_montant)
	{
		$this->transaction_montant = $transaction_montant;
	}

	/**
	 * @return the  $transaction_montant
	 */
	public function getTransaction_montant()
	{
		return $this->transaction_montant;
	}

	/**
	 * @param int $transaction_incident_id
	 */
	public function setTransaction_incident_id($transaction_incident_id)
	{
		$this->transaction_incident_id = $transaction_incident_id;
	}

	/**
	 * @return the  $transaction_incident_id
	 */
	public function getTransaction_incident_id()
	{
		return $this->transaction_incident_id;
	}

	/**
	 * @param int $transaction_paimeent_valide
	 */
	public function setTransaction_paimeent_valide($transaction_paimeent_valide)
	{
		$this->transaction_paimeent_valide = $transaction_paimeent_valide;
	}

	/**
	 * @return the  $transaction_paimeent_valide
	 */
	public function getTransaction_paimeent_valide()
	{
		return $this->transaction_paimeent_valide;
	}

	/**
	 * @param int $transaction_annule
	 */
	public function setTransaction_annule($transaction_annule)
	{
		$this->transaction_annule = $transaction_annule;
	}

	/**
	 * @return the  $transaction_annule
	 */
	public function getTransaction_annule()
	{
		return $this->transaction_annule;
	}

	/**
	 * @param datetime $transaction_livraison_date
	 */
	public function setTransaction_livraison_date($transaction_livraison_date)
	{
		$this->transaction_livraison_date = $transaction_livraison_date;
	}

	/**
	 * @return the  $transaction_livraison_date
	 */
	public function getTransaction_livraison_date()
	{
		return $this->transaction_livraison_date;
	}

	/**
	 * @param datetime $transaction_reception_date
	 */
	public function setTransaction_reception_date($transaction_reception_date)
	{
		$this->transaction_reception_date = $transaction_reception_date;
	}

	/**
	 * @return the  $transaction_reception_date
	 */
	public function getTransaction_reception_date()
	{
		return $this->transaction_reception_date;
	}

	/**
	 * @param int $transaction_evaluation_id
	 */
	public function setTransaction_evaluation_id($transaction_evaluation_id)
	{
		$this->transaction_evaluation_id = $transaction_evaluation_id;
	}

	/**
	 * @return the  $transaction_evaluation_id
	 */
	public function getTransaction_evaluation_id()
	{
		return $this->transaction_evaluation_id;
	}

	/**
	 * @param datetime $transaction_dateAdded
	 */
	public function setTransaction_dateAdded($transaction_dateAdded)
	{
		$this->transaction_dateAdded = $transaction_dateAdded;
	}

	/**
	 * @return the  $transaction_dateAdded
	 */
	public function getTransaction_dateAdded()
	{
		return $this->transaction_dateAdded;
	}

	/**
	 * @param timestamp $transaction_dateUpdated
	 */
	public function setTransaction_dateUpdated($transaction_dateUpdated)
	{
		$this->transaction_dateUpdated = $transaction_dateUpdated;
	}

	/**
	 * @return the  $transaction_dateUpdated
	 */
	public function getTransaction_dateUpdated()
	{
		return $this->transaction_dateUpdated;
	}


}