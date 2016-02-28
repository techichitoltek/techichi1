<?php
/**
 *  models/Metier/EnchereStatut.php
 */


/**
 * Générateur version 2.0
 */
class EnchereStatut extends App_Model_Std {


	/* Champs de la table */

	protected $enchere_statut_id = 0;
	protected $enchere_statut_libelle = "";
	protected $enchere_statut_desc = null;
	protected $enchere_statut_desactive = 0;
	protected $enchere_statut_dateAdded = null;
	protected $enchere_statut_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_EnchereStatut";
		$this->_myDbPrimary         = "enchere_statut_id";
		$this->_myMetierClassName   = "EnchereStatut";
		$this->_myDbTableName       = "frontend_enchere_statut";
		$this->_myDbFieldPrefix     = "enchere_statut";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


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
	 * @param varchar $enchere_statut_libelle
	 */
	public function setEnchere_statut_libelle($enchere_statut_libelle)
	{
		$this->enchere_statut_libelle = $enchere_statut_libelle;
	}

	/**
	 * @return the  $enchere_statut_libelle
	 */
	public function getEnchere_statut_libelle()
	{
		return $this->enchere_statut_libelle;
	}

	/**
	 * @param varchar $enchere_statut_desc
	 */
	public function setEnchere_statut_desc($enchere_statut_desc)
	{
		$this->enchere_statut_desc = $enchere_statut_desc;
	}

	/**
	 * @return the  $enchere_statut_desc
	 */
	public function getEnchere_statut_desc()
	{
		return $this->enchere_statut_desc;
	}

	/**
	 * @param int $enchere_statut_desactive
	 */
	public function setEnchere_statut_desactive($enchere_statut_desactive)
	{
		$this->enchere_statut_desactive = $enchere_statut_desactive;
	}

	/**
	 * @return the  $enchere_statut_desactive
	 */
	public function getEnchere_statut_desactive()
	{
		return $this->enchere_statut_desactive;
	}

	/**
	 * @param datetime $enchere_statut_dateAdded
	 */
	public function setEnchere_statut_dateAdded($enchere_statut_dateAdded)
	{
		$this->enchere_statut_dateAdded = $enchere_statut_dateAdded;
	}

	/**
	 * @return the  $enchere_statut_dateAdded
	 */
	public function getEnchere_statut_dateAdded()
	{
		return $this->enchere_statut_dateAdded;
	}

	/**
	 * @param timestamp $enchere_statut_dateUpdated
	 */
	public function setEnchere_statut_dateUpdated($enchere_statut_dateUpdated)
	{
		$this->enchere_statut_dateUpdated = $enchere_statut_dateUpdated;
	}

	/**
	 * @return the  $enchere_statut_dateUpdated
	 */
	public function getEnchere_statut_dateUpdated()
	{
		return $this->enchere_statut_dateUpdated;
	}


}