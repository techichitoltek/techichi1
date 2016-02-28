<?php
/**
 *  models/Metier/IncidentIndex.php
 */


/**
 * Générateur version 2.0
 */
class IncidentIndex extends App_Model_Std {


	/* Champs de la table */

	protected $index_id = 0;
	protected $index_enchere_statut_id = null;
	protected $index_origine = 0;
	protected $index_note = "";
	protected $index_libelle = "";
	protected $index_libelle_show = null;
	protected $index_dateAdded = null;
	protected $index_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_IncidentIndex";
		$this->_myDbPrimary         = "index_id";
		$this->_myMetierClassName   = "IncidentIndex";
		$this->_myDbTableName       = "frontend_incident_index";
		$this->_myDbFieldPrefix     = "index";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $index_id
	 */
	public function setIndex_id($index_id)
	{
		$this->index_id = $index_id;
	}

	/**
	 * @return the  $index_id
	 */
	public function getIndex_id()
	{
		return $this->index_id;
	}

	/**
	 * @param int $index_enchere_statut_id
	 */
	public function setIndex_enchere_statut_id($index_enchere_statut_id)
	{
		$this->index_enchere_statut_id = $index_enchere_statut_id;
	}

	/**
	 * @return the  $index_enchere_statut_id
	 */
	public function getIndex_enchere_statut_id()
	{
		return $this->index_enchere_statut_id;
	}

	/**
	 * @param int $index_origine
	 */
	public function setIndex_origine($index_origine)
	{
		$this->index_origine = $index_origine;
	}

	/**
	 * @return the  $index_origine
	 */
	public function getIndex_origine()
	{
		return $this->index_origine;
	}

	/**
	 * @param int $index_note
	 */
	public function setIndex_note($index_note)
	{
		$this->index_note = $index_note;
	}

	/**
	 * @return the  $index_note
	 */
	public function getIndex_note()
	{
		return $this->index_note;
	}

	/**
	 * @param varchar $index_libelle
	 */
	public function setIndex_libelle($index_libelle)
	{
		$this->index_libelle = $index_libelle;
	}

	/**
	 * @return the  $index_libelle
	 */
	public function getIndex_libelle()
	{
		return $this->index_libelle;
	}

	/**
	 * @param varchar $index_libelle_show
	 */
	public function setIndex_libelle_show($index_libelle_show)
	{
		$this->index_libelle_show = $index_libelle_show;
	}

	/**
	 * @return the  $index_libelle_show
	 */
	public function getIndex_libelle_show()
	{
		return $this->index_libelle_show;
	}

	/**
	 * @param datetime $index_dateAdded
	 */
	public function setIndex_dateAdded($index_dateAdded)
	{
		$this->index_dateAdded = $index_dateAdded;
	}

	/**
	 * @return the  $index_dateAdded
	 */
	public function getIndex_dateAdded()
	{
		return $this->index_dateAdded;
	}

	/**
	 * @param timestamp $index_dateUpdated
	 */
	public function setIndex_dateUpdated($index_dateUpdated)
	{
		$this->index_dateUpdated = $index_dateUpdated;
	}

	/**
	 * @return the  $index_dateUpdated
	 */
	public function getIndex_dateUpdated()
	{
		return $this->index_dateUpdated;
	}


}