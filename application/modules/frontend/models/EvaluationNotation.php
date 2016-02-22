<?php
/**
 *  models/Metier/EvaluationNotation.php
 */


/**
 * Générateur version 2.0
 */
class EvaluationNotation extends App_Model_Std {


	/* Champs de la table */

	protected $notation_id = 0;
	protected $notation_value = "";
	protected $notation_libelle = null;
	protected $notation_dateAdded = null;
	protected $notation_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_EvaluationNotation";
		$this->_myDbPrimary         = "notation_id";
		$this->_myMetierClassName   = "EvaluationNotation";
		$this->_myDbTableName       = "frontend_evaluation_notation";
		$this->_myDbFieldPrefix     = "notation";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $notation_id
	 */
	public function setNotation_id($notation_id)
	{
		$this->notation_id = $notation_id;
	}

	/**
	 * @return the  $notation_id
	 */
	public function getNotation_id()
	{
		return $this->notation_id;
	}

	/**
	 * @param int $notation_value
	 */
	public function setNotation_value($notation_value)
	{
		$this->notation_value = $notation_value;
	}

	/**
	 * @return the  $notation_value
	 */
	public function getNotation_value()
	{
		return $this->notation_value;
	}

	/**
	 * @param varchar $notation_libelle
	 */
	public function setNotation_libelle($notation_libelle)
	{
		$this->notation_libelle = $notation_libelle;
	}

	/**
	 * @return the  $notation_libelle
	 */
	public function getNotation_libelle()
	{
		return $this->notation_libelle;
	}

	/**
	 * @param datetime $notation_dateAdded
	 */
	public function setNotation_dateAdded($notation_dateAdded)
	{
		$this->notation_dateAdded = $notation_dateAdded;
	}

	/**
	 * @return the  $notation_dateAdded
	 */
	public function getNotation_dateAdded()
	{
		return $this->notation_dateAdded;
	}

	/**
	 * @param timestamp $notation_dateUpdated
	 */
	public function setNotation_dateUpdated($notation_dateUpdated)
	{
		$this->notation_dateUpdated = $notation_dateUpdated;
	}

	/**
	 * @return the  $notation_dateUpdated
	 */
	public function getNotation_dateUpdated()
	{
		return $this->notation_dateUpdated;
	}


}