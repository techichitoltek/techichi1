<?php
/**
 *  models/Metier/Facturation.php
 */


/**
 * Générateur version 2.0
 */
class Facturation extends App_Model_Std {


	/* Champs de la table */

	protected $facturation_id = 0;
	protected $facturation_prix = "";
	protected $facturation_libelle = "";
	protected $facturation_user_id = "";
	protected $facturation_offre_id = null;
	protected $facturation_abo_id = null;
	protected $facturation_debut_facturation = null;
	protected $facturation_fin_facturation = null;
	protected $facturation_deleted = 0;
	protected $facturation_dateAdded = null;
	protected $facturation_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Facturation";
		$this->_myDbPrimary         = "facturation_id";
		$this->_myMetierClassName   = "Facturation";
		$this->_myDbTableName       = "frontend_facturation";
		$this->_myDbFieldPrefix     = "facturation";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $facturation_id
	 */
	public function setFacturation_id($facturation_id)
	{
		$this->facturation_id = $facturation_id;
	}

	/**
	 * @return the  $facturation_id
	 */
	public function getFacturation_id()
	{
		return $this->facturation_id;
	}

	/**
	 * @param int $facturation_prix
	 */
	public function setFacturation_prix($facturation_prix)
	{
		$this->facturation_prix = $facturation_prix;
	}

	/**
	 * @return the  $facturation_prix
	 */
	public function getFacturation_prix()
	{
		return $this->facturation_prix;
	}

	/**
	 * @param varchar $facturation_libelle
	 */
	public function setFacturation_libelle($facturation_libelle)
	{
		$this->facturation_libelle = $facturation_libelle;
	}

	/**
	 * @return the  $facturation_libelle
	 */
	public function getFacturation_libelle()
	{
		return $this->facturation_libelle;
	}

	/**
	 * @param int $facturation_user_id
	 */
	public function setFacturation_user_id($facturation_user_id)
	{
		$this->facturation_user_id = $facturation_user_id;
	}

	/**
	 * @return the  $facturation_user_id
	 */
	public function getFacturation_user_id()
	{
		return $this->facturation_user_id;
	}

	/**
	 * @param int $facturation_offre_id
	 */
	public function setFacturation_offre_id($facturation_offre_id)
	{
		$this->facturation_offre_id = $facturation_offre_id;
	}

	/**
	 * @return the  $facturation_offre_id
	 */
	public function getFacturation_offre_id()
	{
		return $this->facturation_offre_id;
	}

	/**
	 * @param int $facturation_abo_id
	 */
	public function setFacturation_abo_id($facturation_abo_id)
	{
		$this->facturation_abo_id = $facturation_abo_id;
	}

	/**
	 * @return the  $facturation_abo_id
	 */
	public function getFacturation_abo_id()
	{
		return $this->facturation_abo_id;
	}

	/**
	 * @param date $facturation_debut_facturation
	 */
	public function setFacturation_debut_facturation($facturation_debut_facturation)
	{
		$this->facturation_debut_facturation = $facturation_debut_facturation;
	}

	/**
	 * @return the  $facturation_debut_facturation
	 */
	public function getFacturation_debut_facturation()
	{
		return $this->facturation_debut_facturation;
	}

	/**
	 * @param date $facturation_fin_facturation
	 */
	public function setFacturation_fin_facturation($facturation_fin_facturation)
	{
		$this->facturation_fin_facturation = $facturation_fin_facturation;
	}

	/**
	 * @return the  $facturation_fin_facturation
	 */
	public function getFacturation_fin_facturation()
	{
		return $this->facturation_fin_facturation;
	}

	/**
	 * @param int $facturation_deleted
	 */
	public function setFacturation_deleted($facturation_deleted)
	{
		$this->facturation_deleted = $facturation_deleted;
	}

	/**
	 * @return the  $facturation_deleted
	 */
	public function getFacturation_deleted()
	{
		return $this->facturation_deleted;
	}

	/**
	 * @param datetime $facturation_dateAdded
	 */
	public function setFacturation_dateAdded($facturation_dateAdded)
	{
		$this->facturation_dateAdded = $facturation_dateAdded;
	}

	/**
	 * @return the  $facturation_dateAdded
	 */
	public function getFacturation_dateAdded()
	{
		return $this->facturation_dateAdded;
	}

	/**
	 * @param timestamp $facturation_dateUpdated
	 */
	public function setFacturation_dateUpdated($facturation_dateUpdated)
	{
		$this->facturation_dateUpdated = $facturation_dateUpdated;
	}

	/**
	 * @return the  $facturation_dateUpdated
	 */
	public function getFacturation_dateUpdated()
	{
		return $this->facturation_dateUpdated;
	}


}