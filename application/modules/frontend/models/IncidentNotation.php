<?php
/**
 *  models/Metier/IncidentNotation.php
 */


/**
 * Générateur version 2.0
 */
class IncidentNotation extends App_Model_Std {


	/* Champs de la table */

	protected $incident_notation_id = 0;
	protected $incident_notation_notationId = "";
	protected $incident_notation_value = "";
	protected $incident_notation_dateAdded = null;
	protected $incident_notation_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_IncidentNotation";
		$this->_myDbPrimary         = "incident_notation_id";
		$this->_myMetierClassName   = "IncidentNotation";
		$this->_myDbTableName       = "frontend_incident_notation";
		$this->_myDbFieldPrefix     = "incident_notation";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $incident_notation_id
	 */
	public function setIncident_notation_id($incident_notation_id)
	{
		$this->incident_notation_id = $incident_notation_id;
	}

	/**
	 * @return the  $incident_notation_id
	 */
	public function getIncident_notation_id()
	{
		return $this->incident_notation_id;
	}

	/**
	 * @param int $incident_notation_notationId
	 */
	public function setIncident_notation_notationId($incident_notation_notationId)
	{
		$this->incident_notation_notationId = $incident_notation_notationId;
	}

	/**
	 * @return the  $incident_notation_notationId
	 */
	public function getIncident_notation_notationId()
	{
		return $this->incident_notation_notationId;
	}

	/**
	 * @param int $incident_notation_value
	 */
	public function setIncident_notation_value($incident_notation_value)
	{
		$this->incident_notation_value = $incident_notation_value;
	}

	/**
	 * @return the  $incident_notation_value
	 */
	public function getIncident_notation_value()
	{
		return $this->incident_notation_value;
	}

	/**
	 * @param datetime $incident_notation_dateAdded
	 */
	public function setIncident_notation_dateAdded($incident_notation_dateAdded)
	{
		$this->incident_notation_dateAdded = $incident_notation_dateAdded;
	}

	/**
	 * @return the  $incident_notation_dateAdded
	 */
	public function getIncident_notation_dateAdded()
	{
		return $this->incident_notation_dateAdded;
	}

	/**
	 * @param timestamp $incident_notation_dateUpdated
	 */
	public function setIncident_notation_dateUpdated($incident_notation_dateUpdated)
	{
		$this->incident_notation_dateUpdated = $incident_notation_dateUpdated;
	}

	/**
	 * @return the  $incident_notation_dateUpdated
	 */
	public function getIncident_notation_dateUpdated()
	{
		return $this->incident_notation_dateUpdated;
	}


}