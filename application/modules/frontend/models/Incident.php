<?php
/**
 *  models/Metier/Incident.php
 */


/**
 * Générateur version 2.0
 */
class Incident extends App_Model_Std {


	/* Champs de la table */

	protected $incident_id = 0;
	protected $incident_transaction_id = "";
	protected $incident_enchere_id = "";
	protected $incident_origine_userId = null;
	protected $incident_impacte_userId = null;
	protected $incident_index_id = "";
	protected $incident_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Incident";
		$this->_myDbPrimary         = "incident_id";
		$this->_myMetierClassName   = "Incident";
		$this->_myDbTableName       = "frontend_incident";
		$this->_myDbFieldPrefix     = "incident";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $incident_id
	 */
	public function setIncident_id($incident_id)
	{
		$this->incident_id = $incident_id;
	}

	/**
	 * @return the  $incident_id
	 */
	public function getIncident_id()
	{
		return $this->incident_id;
	}

	/**
	 * @param int $incident_transaction_id
	 */
	public function setIncident_transaction_id($incident_transaction_id)
	{
		$this->incident_transaction_id = $incident_transaction_id;
	}

	/**
	 * @return the  $incident_transaction_id
	 */
	public function getIncident_transaction_id()
	{
		return $this->incident_transaction_id;
	}

	/**
	 * @param int $incident_enchere_id
	 */
	public function setIncident_enchere_id($incident_enchere_id)
	{
		$this->incident_enchere_id = $incident_enchere_id;
	}

	/**
	 * @return the  $incident_enchere_id
	 */
	public function getIncident_enchere_id()
	{
		return $this->incident_enchere_id;
	}

	/**
	 * @param int $incident_origine_userId
	 */
	public function setIncident_origine_userId($incident_origine_userId)
	{
		$this->incident_origine_userId = $incident_origine_userId;
	}

	/**
	 * @return the  $incident_origine_userId
	 */
	public function getIncident_origine_userId()
	{
		return $this->incident_origine_userId;
	}

	/**
	 * @param int $incident_impacte_userId
	 */
	public function setIncident_impacte_userId($incident_impacte_userId)
	{
		$this->incident_impacte_userId = $incident_impacte_userId;
	}

	/**
	 * @return the  $incident_impacte_userId
	 */
	public function getIncident_impacte_userId()
	{
		return $this->incident_impacte_userId;
	}

	/**
	 * @param int $incident_index_id
	 */
	public function setIncident_index_id($incident_index_id)
	{
		$this->incident_index_id = $incident_index_id;
	}

	/**
	 * @return the  $incident_index_id
	 */
	public function getIncident_index_id()
	{
		return $this->incident_index_id;
	}

	/**
	 * @param timestamp $incident_dateAdded
	 */
	public function setIncident_dateAdded($incident_dateAdded)
	{
		$this->incident_dateAdded = $incident_dateAdded;
	}

	/**
	 * @return the  $incident_dateAdded
	 */
	public function getIncident_dateAdded()
	{
		return $this->incident_dateAdded;
	}


}