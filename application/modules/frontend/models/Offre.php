<?php
/**
 *  models/Metier/Offre.php
 */


/**
 * Générateur version 2.0
 */
class Offre extends App_Model_Std {


	/* Champs de la table */

	protected $offre_id = 0;
	protected $offre_libelle = "";
	protected $offre_montant = "";
	protected $offre_titre = null;
	protected $offre_content = null;
	protected $offre_img = null;
	protected $offre_deleted = 0;
	protected $offre_dateAdded = null;
	protected $offre_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Offre";
		$this->_myDbPrimary         = "offre_id";
		$this->_myMetierClassName   = "Offre";
		$this->_myDbTableName       = "frontend_offre";
		$this->_myDbFieldPrefix     = "offre";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $offre_id
	 */
	public function setOffre_id($offre_id)
	{
		$this->offre_id = $offre_id;
	}

	/**
	 * @return the  $offre_id
	 */
	public function getOffre_id()
	{
		return $this->offre_id;
	}

	/**
	 * @param varchar $offre_libelle
	 */
	public function setOffre_libelle($offre_libelle)
	{
		$this->offre_libelle = $offre_libelle;
	}

	/**
	 * @return the  $offre_libelle
	 */
	public function getOffre_libelle()
	{
		return $this->offre_libelle;
	}

	/**
	 * @param float $offre_montant
	 */
	public function setOffre_montant($offre_montant)
	{
		$this->offre_montant = $offre_montant;
	}

	/**
	 * @return the  $offre_montant
	 */
	public function getOffre_montant()
	{
		return $this->offre_montant;
	}

	/**
	 * @param varchar $offre_titre
	 */
	public function setOffre_titre($offre_titre)
	{
		$this->offre_titre = $offre_titre;
	}

	/**
	 * @return the  $offre_titre
	 */
	public function getOffre_titre()
	{
		return $this->offre_titre;
	}

	/**
	 * @param varchar $offre_content
	 */
	public function setOffre_content($offre_content)
	{
		$this->offre_content = $offre_content;
	}

	/**
	 * @return the  $offre_content
	 */
	public function getOffre_content()
	{
		return $this->offre_content;
	}

	/**
	 * @param varchar $offre_img
	 */
	public function setOffre_img($offre_img)
	{
		$this->offre_img = $offre_img;
	}

	/**
	 * @return the  $offre_img
	 */
	public function getOffre_img()
	{
		return $this->offre_img;
	}

	/**
	 * @param int $offre_deleted
	 */
	public function setOffre_deleted($offre_deleted)
	{
		$this->offre_deleted = $offre_deleted;
	}

	/**
	 * @return the  $offre_deleted
	 */
	public function getOffre_deleted()
	{
		return $this->offre_deleted;
	}

	/**
	 * @param datetime $offre_dateAdded
	 */
	public function setOffre_dateAdded($offre_dateAdded)
	{
		$this->offre_dateAdded = $offre_dateAdded;
	}

	/**
	 * @return the  $offre_dateAdded
	 */
	public function getOffre_dateAdded()
	{
		return $this->offre_dateAdded;
	}

	/**
	 * @param timestamp $offre_dateUpdated
	 */
	public function setOffre_dateUpdated($offre_dateUpdated)
	{
		$this->offre_dateUpdated = $offre_dateUpdated;
	}

	/**
	 * @return the  $offre_dateUpdated
	 */
	public function getOffre_dateUpdated()
	{
		return $this->offre_dateUpdated;
	}


}