<?php
/**
 *  models/Metier/CatalogueProduit.php
 */


/**
 * Générateur version 2.0
 */
class CatalogueProduit extends App_Model_Std {


	/* Champs de la table */

	protected $catalogue_produits_id = 0;
	protected $catalogue_produits_vendeur_id = "";
	protected $catalogue_produits_categorie_id = null;
	protected $catalogue_produits_indexation = null;
	protected $catalogue_produits_titre = null;
	protected $catalogue_produits_description = null;
	protected $catalogue_produits_prix_depart = null;
	protected $catalogue_produits_prix_reserve = null;
	protected $catalogue_produits_prix_fp = null;
	protected $catalogue_produits_fp_delai = null;
	protected $catalogue_produits_fp = 0;
	protected $catalogue_produits_hasBibliothèque = 0;
	protected $catalogue_produits_used = 0;
	protected $catalogue_produits_deleted = 0;
	protected $catalogue_produits_dateAdded = null;
	protected $catalogue_produits_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_CatalogueProduit";
		$this->_myDbPrimary         = "catalogue_produits_id";
		$this->_myMetierClassName   = "CatalogueProduit";
		$this->_myDbTableName       = "frontend_catalogue_produits";
		$this->_myDbFieldPrefix     = "catalogue_produits";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $catalogue_produits_id
	 */
	public function setCatalogue_produits_id($catalogue_produits_id)
	{
		$this->catalogue_produits_id = $catalogue_produits_id;
	}

	/**
	 * @return the  $catalogue_produits_id
	 */
	public function getCatalogue_produits_id()
	{
		return $this->catalogue_produits_id;
	}

	/**
	 * @param int $catalogue_produits_vendeur_id
	 */
	public function setCatalogue_produits_vendeur_id($catalogue_produits_vendeur_id)
	{
		$this->catalogue_produits_vendeur_id = $catalogue_produits_vendeur_id;
	}

	/**
	 * @return the  $catalogue_produits_vendeur_id
	 */
	public function getCatalogue_produits_vendeur_id()
	{
		return $this->catalogue_produits_vendeur_id;
	}

	/**
	 * @param int $catalogue_produits_categorie_id
	 */
	public function setCatalogue_produits_categorie_id($catalogue_produits_categorie_id)
	{
		$this->catalogue_produits_categorie_id = $catalogue_produits_categorie_id;
	}

	/**
	 * @return the  $catalogue_produits_categorie_id
	 */
	public function getCatalogue_produits_categorie_id()
	{
		return $this->catalogue_produits_categorie_id;
	}

	/**
	 * @param longtext $catalogue_produits_indexation
	 */
	public function setCatalogue_produits_indexation($catalogue_produits_indexation)
	{
		$this->catalogue_produits_indexation = $catalogue_produits_indexation;
	}

	/**
	 * @return the  $catalogue_produits_indexation
	 */
	public function getCatalogue_produits_indexation()
	{
		return $this->catalogue_produits_indexation;
	}

	/**
	 * @param varchar $catalogue_produits_titre
	 */
	public function setCatalogue_produits_titre($catalogue_produits_titre)
	{
		$this->catalogue_produits_titre = $catalogue_produits_titre;
	}

	/**
	 * @return the  $catalogue_produits_titre
	 */
	public function getCatalogue_produits_titre()
	{
		return $this->catalogue_produits_titre;
	}

	/**
	 * @param longtext $catalogue_produits_description
	 */
	public function setCatalogue_produits_description($catalogue_produits_description)
	{
		$this->catalogue_produits_description = $catalogue_produits_description;
	}

	/**
	 * @return the  $catalogue_produits_description
	 */
	public function getCatalogue_produits_description()
	{
		return $this->catalogue_produits_description;
	}

	/**
	 * @param float $catalogue_produits_prix_depart
	 */
	public function setCatalogue_produits_prix_depart($catalogue_produits_prix_depart)
	{
		$this->catalogue_produits_prix_depart = $catalogue_produits_prix_depart;
	}

	/**
	 * @return the  $catalogue_produits_prix_depart
	 */
	public function getCatalogue_produits_prix_depart()
	{
		return $this->catalogue_produits_prix_depart;
	}

	/**
	 * @param float $catalogue_produits_prix_reserve
	 */
	public function setCatalogue_produits_prix_reserve($catalogue_produits_prix_reserve)
	{
		$this->catalogue_produits_prix_reserve = $catalogue_produits_prix_reserve;
	}

	/**
	 * @return the  $catalogue_produits_prix_reserve
	 */
	public function getCatalogue_produits_prix_reserve()
	{
		return $this->catalogue_produits_prix_reserve;
	}

	/**
	 * @param float $catalogue_produits_prix_fp
	 */
	public function setCatalogue_produits_prix_fp($catalogue_produits_prix_fp)
	{
		$this->catalogue_produits_prix_fp = $catalogue_produits_prix_fp;
	}

	/**
	 * @return the $catalogue_produits_prix_fp
	 */
	public function getCatalogue_produits_prix_fp()
	{
		return $this->catalogue_produits_prix_fp;
	}

	/**
	 * @param int $catalogue_produits_fp_delai
	 */
	public function setCatalogue_produits_fp_delai($catalogue_produits_fp_delai)
	{
		$this->catalogue_produits_fp_delai = $catalogue_produits_fp_delai;
	}

	/**
	 * @return the $catalogue_produits_fp_delai
	 */
	public function getCatalogue_produits_fp_delai()
	{
		return $this->catalogue_produits_fp_delai;
	}

	/**
	 * @param int $catalogue_produits_fp
	 */
	public function setCatalogue_produits_fp($catalogue_produits_fp)
	{
		$this->catalogue_produits_fp = $catalogue_produits_fp;
	}

	/**
	 * @return the $catalogue_produits_fp
	 */
	public function getCatalogue_produits_fp()
	{
		return $this->catalogue_produits_fp;
	}

	/**
	 * @param int $catalogue_produits_hasBibliothèque
	 */
	public function setCatalogue_produits_hasBibliothèque($catalogue_produits_hasBibliothèque)
	{
		$this->catalogue_produits_hasBibliothèque = $catalogue_produits_hasBibliothèque;
	}

	/**
	 * @return the  $catalogue_produits_hasBibliothèque
	 */
	public function getCatalogue_produits_hasBibliothèque()
	{
		return $this->catalogue_produits_hasBibliothèque;
	}


	/**
	 * @param int $catalogue_produits_used
	 */
	public function setCatalogue_produits_used($catalogue_produits_used)
	{
		$this->catalogue_produits_used = $catalogue_produits_used;
	}

	/**
	 * @return the  $catalogue_produits_used
	 */
	public function getCatalogue_produits_used()
	{
		return $this->catalogue_produits_used;
	}


	/**
	 * @param int $catalogue_produits_deleted
	 */
	public function setCatalogue_produits_deleted($catalogue_produits_deleted)
	{
		$this->catalogue_produits_deleted = $catalogue_produits_deleted;
	}

	/**
	 * @return the  $catalogue_produits_deleted
	 */
	public function getCatalogue_produits_deleted()
	{
		return $this->catalogue_produits_deleted;
	}

	/**
	 * @param datetime $catalogue_produits_dateAdded
	 */
	public function setCatalogue_produits_dateAdded($catalogue_produits_dateAdded)
	{
		$this->catalogue_produits_dateAdded = $catalogue_produits_dateAdded;
	}

	/**
	 * @return the  $catalogue_produits_dateAdded
	 */
	public function getCatalogue_produits_dateAdded()
	{
		return $this->catalogue_produits_dateAdded;
	}

	/**
	 * @param timestamp $catalogue_produits_dateUpdated
	 */
	public function setCatalogue_produits_dateUpdated($catalogue_produits_dateUpdated)
	{
		$this->catalogue_produits_dateUpdated = $catalogue_produits_dateUpdated;
	}

	/**
	 * @return the  $catalogue_produits_dateUpdated
	 */
	public function getCatalogue_produits_dateUpdated()
	{
		return $this->catalogue_produits_dateUpdated;
	}

	public function saveForSearch(){
		$catalogueProduitSearchModel = new CatalogueProduitSearch($this->catalogue_produits_id);
		$catalogueProduitSearch = clone($this);
		$catalogueProduitSearch->_myDbClassName       = $catalogueProduitSearchModel->_myDbClassName;
		$catalogueProduitSearch->_myDbPrimary         = $catalogueProduitSearchModel->_myDbPrimary;
		$catalogueProduitSearch->_myMetierClassName   = $catalogueProduitSearchModel->_myMetierClassName;
		$catalogueProduitSearch->_myDbTableName       = $catalogueProduitSearchModel->_myDbTableName;
		$catalogueProduitSearch->_myDbFieldPrefix     = $catalogueProduitSearchModel->_myDbFieldPrefix;
		$catalogueProduitSearch->save();
	}

	public function getMainImage(){
		$mod_cat_bib = new CatalogueBibliotheque();
		return $mod_cat_bib->getMainImageByProduitId($this->catalogue_produits_id);
	}
	public function getImageListe(){
		$mod_cat_bib = new CatalogueBibliotheque();
		return $mod_cat_bib->getListeByProduitId($this->catalogue_produits_id);
	}

}