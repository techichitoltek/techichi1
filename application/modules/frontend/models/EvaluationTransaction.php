<?php
/**
 *  models/Metier/EvaluationTransaction.php
 */


/**
 * Générateur version 2.0
 */
class EvaluationTransaction extends App_Model_Std {


	/* Champs de la table */

	protected $evaltransaction_id = 0;
	protected $evaltransaction_transaction_id = "";
	protected $evaltransaction_acheteur_id = "";
	protected $evaltransaction_vendeur_id = "";
	protected $evaltransaction_notation_id = null;
	protected $evaltransaction_note = null;
	protected $evaltransaction_commentaire = null;
	protected $evaltransaction_desactive = 0;
	protected $evaltransaction_dateAdded = null;
	protected $evaltransaction_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_EvaluationTransaction";
		$this->_myDbPrimary         = "evaltransaction_id";
		$this->_myMetierClassName   = "EvaluationTransaction";
		$this->_myDbTableName       = "frontend_evaluation_transaction";
		$this->_myDbFieldPrefix     = "evaltransaction";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $evaltransaction_id
	 */
	public function setEvaltransaction_id($evaltransaction_id)
	{
		$this->evaltransaction_id = $evaltransaction_id;
	}

	/**
	 * @return the  $evaltransaction_id
	 */
	public function getEvaltransaction_id()
	{
		return $this->evaltransaction_id;
	}

	/**
	 * @param int $evaltransaction_transaction_id
	 */
	public function setEvaltransaction_transaction_id($evaltransaction_transaction_id)
	{
		$this->evaltransaction_transaction_id = $evaltransaction_transaction_id;
	}

	/**
	 * @return the  $evaltransaction_transaction_id
	 */
	public function getEvaltransaction_transaction_id()
	{
		return $this->evaltransaction_transaction_id;
	}

	/**
	 * @param int $evaltransaction_acheteur_id
	 */
	public function setEvaltransaction_acheteur_id($evaltransaction_acheteur_id)
	{
		$this->evaltransaction_acheteur_id = $evaltransaction_acheteur_id;
	}

	/**
	 * @return the  $evaltransaction_acheteur_id
	 */
	public function getEvaltransaction_acheteur_id()
	{
		return $this->evaltransaction_acheteur_id;
	}

	/**
	 * @param int $evaltransaction_vendeur_id
	 */
	public function setEvaltransaction_vendeur_id($evaltransaction_vendeur_id)
	{
		$this->evaltransaction_vendeur_id = $evaltransaction_vendeur_id;
	}

	/**
	 * @return the  $evaltransaction_vendeur_id
	 */
	public function getEvaltransaction_vendeur_id()
	{
		return $this->evaltransaction_vendeur_id;
	}

	/**
	 * @param int $evaltransaction_notation_id
	 */
	public function setEvaltransaction_notation_id($evaltransaction_notation_id)
	{
		$this->evaltransaction_notation_id = $evaltransaction_notation_id;
	}

	/**
	 * @return the  $evaltransaction_notation_id
	 */
	public function getEvaltransaction_notation_id()
	{
		return $this->evaltransaction_notation_id;
	}

	/**
	 * @param int $evaltransaction_note
	 */
	public function setEvaltransaction_note($evaltransaction_note)
	{
		$this->evaltransaction_note = $evaltransaction_note;
	}

	/**
	 * @return the  $evaltransaction_note
	 */
	public function getEvaltransaction_note()
	{
		return $this->evaltransaction_note;
	}

	/**
	 * @param varchar $evaltransaction_commentaire
	 */
	public function setEvaltransaction_commentaire($evaltransaction_commentaire)
	{
		$this->evaltransaction_commentaire = $evaltransaction_commentaire;
	}

	/**
	 * @return the  $evaltransaction_commentaire
	 */
	public function getEvaltransaction_commentaire()
	{
		return $this->evaltransaction_commentaire;
	}

	/**
	 * @param int $evaltransaction_desactive
	 */
	public function setEvaltransaction_desactive($evaltransaction_desactive)
	{
		$this->evaltransaction_desactive = $evaltransaction_desactive;
	}

	/**
	 * @return the  $evaltransaction_desactive
	 */
	public function getEvaltransaction_desactive()
	{
		return $this->evaltransaction_desactive;
	}

	/**
	 * @param datetime $evaltransaction_dateAdded
	 */
	public function setEvaltransaction_dateAdded($evaltransaction_dateAdded)
	{
		$this->evaltransaction_dateAdded = $evaltransaction_dateAdded;
	}

	/**
	 * @return the  $evaltransaction_dateAdded
	 */
	public function getEvaltransaction_dateAdded()
	{
		return $this->evaltransaction_dateAdded;
	}

	/**
	 * @param timestamp $evaltransaction_dateUpdated
	 */
	public function setEvaltransaction_dateUpdated($evaltransaction_dateUpdated)
	{
		$this->evaltransaction_dateUpdated = $evaltransaction_dateUpdated;
	}

	/**
	 * @return the  $evaltransaction_dateUpdated
	 */
	public function getEvaltransaction_dateUpdated()
	{
		return $this->evaltransaction_dateUpdated;
	}


}