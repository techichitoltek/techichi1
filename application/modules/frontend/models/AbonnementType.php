<?php
/**
 *  models/Metier/AbonnementType.php
 */


/**
 * Générateur version 2.0
 */
class AbonnementType extends App_Model_Std {


	/* Champs de la table */

	protected $abotype_id = 0;
	protected $abotype_libelle = "";
	protected $abotype_montant = "";
	protected $abotype_titre = null;
	protected $abotype_content = null;
	protected $abotype_img = null;
	protected $abotype_deleted = 0;
	protected $abotype_dateAdded = null;
	protected $abotype_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_AbonnementType";
		$this->_myDbPrimary         = "abotype_id";
		$this->_myMetierClassName   = "AbonnementType";
		$this->_myDbTableName       = "frontend_abonement_type";
		$this->_myDbFieldPrefix     = "abotype";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $abotype_id
	 */
	public function setAbotype_id($abotype_id)
	{
		$this->abotype_id = $abotype_id;
	}

	/**
	 * @return the  $abotype_id
	 */
	public function getAbotype_id()
	{
		return $this->abotype_id;
	}

	/**
	 * @param varchar $abotype_libelle
	 */
	public function setAbotype_libelle($abotype_libelle)
	{
		$this->abotype_libelle = $abotype_libelle;
	}

	/**
	 * @return the  $abotype_libelle
	 */
	public function getAbotype_libelle()
	{
		return $this->abotype_libelle;
	}

	/**
	 * @param float $abotype_montant
	 */
	public function setAbotype_montant($abotype_montant)
	{
		$this->abotype_montant = $abotype_montant;
	}

	/**
	 * @return the  $abotype_montant
	 */
	public function getAbotype_montant()
	{
		return $this->abotype_montant;
	}

	/**
	 * @param varchar $abotype_titre
	 */
	public function setAbotype_titre($abotype_titre)
	{
		$this->abotype_titre = $abotype_titre;
	}

	/**
	 * @return the  $abotype_titre
	 */
	public function getAbotype_titre()
	{
		return $this->abotype_titre;
	}

	/**
	 * @param varchar $abotype_content
	 */
	public function setAbotype_content($abotype_content)
	{
		$this->abotype_content = $abotype_content;
	}

	/**
	 * @return the  $abotype_content
	 */
	public function getAbotype_content()
	{
		return $this->abotype_content;
	}

	/**
	 * @param varchar $abotype_img
	 */
	public function setAbotype_img($abotype_img)
	{
		$this->abotype_img = $abotype_img;
	}

	/**
	 * @return the  $abotype_img
	 */
	public function getAbotype_img()
	{
		return $this->abotype_img;
	}

	/**
	 * @param int $abotype_deleted
	 */
	public function setAbotype_deleted($abotype_deleted)
	{
		$this->abotype_deleted = $abotype_deleted;
	}

	/**
	 * @return the  $abotype_deleted
	 */
	public function getAbotype_deleted()
	{
		return $this->abotype_deleted;
	}

	/**
	 * @param datetime $abotype_dateAdded
	 */
	public function setAbotype_dateAdded($abotype_dateAdded)
	{
		$this->abotype_dateAdded = $abotype_dateAdded;
	}

	/**
	 * @return the  $abotype_dateAdded
	 */
	public function getAbotype_dateAdded()
	{
		return $this->abotype_dateAdded;
	}

	/**
	 * @param timestamp $abotype_dateUpdated
	 */
	public function setAbotype_dateUpdated($abotype_dateUpdated)
	{
		$this->abotype_dateUpdated = $abotype_dateUpdated;
	}

	/**
	 * @return the  $abotype_dateUpdated
	 */
	public function getAbotype_dateUpdated()
	{
		return $this->abotype_dateUpdated;
	}


}