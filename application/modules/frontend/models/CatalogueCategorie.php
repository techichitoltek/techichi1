<?php
/**
 *  models/Metier/CatalogueCategorie.php
 */


/**
 * Générateur version 2.0
 */
class CatalogueCategorie extends App_Model_Std {


	/* Champs de la table */

	protected $catalogue_categorie_id = 0;
	protected $catalogue_categorie_libelle = "";
	protected $catalogue_categorie_desactive = 0;
	protected $catalogue_categorie_dateAdded = null;
	protected $catalogue_categorie_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_CatalogueCategorie";
		$this->_myDbPrimary         = "catalogue_categorie_id";
		$this->_myMetierClassName   = "CatalogueCategorie";
		$this->_myDbTableName       = "frontend_catalogue_categorie";
		$this->_myDbFieldPrefix     = "catalogue_categorie";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $catalogue_categorie_id
	 */
	public function setCatalogue_categorie_id($catalogue_categorie_id)
	{
		$this->catalogue_categorie_id = $catalogue_categorie_id;
	}

	/**
	 * @return the  $catalogue_categorie_id
	 */
	public function getCatalogue_categorie_id()
	{
		return $this->catalogue_categorie_id;
	}

	/**
	 * @param varchar $catalogue_categorie_libelle
	 */
	public function setCatalogue_categorie_libelle($catalogue_categorie_libelle)
	{
		$this->catalogue_categorie_libelle = $catalogue_categorie_libelle;
	}

	/**
	 * @return the  $catalogue_categorie_libelle
	 */
	public function getCatalogue_categorie_libelle()
	{
		return $this->catalogue_categorie_libelle;
	}

	/**
	 * @param int $catalogue_categorie_desactive
	 */
	public function setCatalogue_categorie_desactive($catalogue_categorie_desactive)
	{
		$this->catalogue_categorie_desactive = $catalogue_categorie_desactive;
	}

	/**
	 * @return the  $catalogue_categorie_desactive
	 */
	public function getCatalogue_categorie_desactive()
	{
		return $this->catalogue_categorie_desactive;
	}

	/**
	 * @param datetime $catalogue_categorie_dateAdded
	 */
	public function setCatalogue_categorie_dateAdded($catalogue_categorie_dateAdded)
	{
		$this->catalogue_categorie_dateAdded = $catalogue_categorie_dateAdded;
	}

	/**
	 * @return the  $catalogue_categorie_dateAdded
	 */
	public function getCatalogue_categorie_dateAdded()
	{
		return $this->catalogue_categorie_dateAdded;
	}

	/**
	 * @param timestamp $catalogue_categorie_dateUpdated
	 */
	public function setCatalogue_categorie_dateUpdated($catalogue_categorie_dateUpdated)
	{
		$this->catalogue_categorie_dateUpdated = $catalogue_categorie_dateUpdated;
	}

	/**
	 * @return the  $catalogue_categorie_dateUpdated
	 */
	public function getCatalogue_categorie_dateUpdated()
	{
		return $this->catalogue_categorie_dateUpdated;
	}


}