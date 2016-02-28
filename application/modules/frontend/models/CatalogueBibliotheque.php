<?php
/**
 *  models/Metier/CatalogueBibliotheque.php
 */


/**
 * Générateur version 2.0
 */
class CatalogueBibliotheque extends App_Model_Std {


	/* Champs de la table */

	protected $catalogue_bibliotheque_id = 0;
	protected $catalogue_bibliotheque_vendeur_id = "";
	protected $catalogue_bibliotheque_produit_id = "";
	protected $catalogue_bibliotheque_type = null;
	protected $catalogue_bibliotheque_file = "";
	protected $catalogue_bibliotheque_deleted = 0;
	protected $catalogue_bibliotheque_dateAdded = null;
	protected $catalogue_bibliotheque_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_CatalogueBibliotheque";
		$this->_myDbPrimary         = "catalogue_bibliotheque_id";
		$this->_myMetierClassName   = "CatalogueBibliotheque";
		$this->_myDbTableName       = "frontend_catalogue_bibliotheque";
		$this->_myDbFieldPrefix     = "catalogue_bibliotheque";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $catalogue_bibliotheque_id
	 */
	public function setCatalogue_bibliotheque_id($catalogue_bibliotheque_id)
	{
		$this->catalogue_bibliotheque_id = $catalogue_bibliotheque_id;
	}

	/**
	 * @return the  $catalogue_bibliotheque_id
	 */
	public function getCatalogue_bibliotheque_id()
	{
		return $this->catalogue_bibliotheque_id;
	}

	/**
	 * @param int $catalogue_bibliotheque_vendeur_id
	 */
	public function setCatalogue_bibliotheque_vendeur_id($catalogue_bibliotheque_vendeur_id)
	{
		$this->catalogue_bibliotheque_vendeur_id = $catalogue_bibliotheque_vendeur_id;
	}

	/**
	 * @return the  $catalogue_bibliotheque_vendeur_id
	 */
	public function getCatalogue_bibliotheque_vendeur_id()
	{
		return $this->catalogue_bibliotheque_vendeur_id;
	}

	/**
	 * @param int $catalogue_bibliotheque_produit_id
	 */
	public function setCatalogue_bibliotheque_produit_id($catalogue_bibliotheque_produit_id)
	{
		$this->catalogue_bibliotheque_produit_id = $catalogue_bibliotheque_produit_id;
	}

	/**
	 * @return the  $catalogue_bibliotheque_produit_id
	 */
	public function getCatalogue_bibliotheque_produit_id()
	{
		return $this->catalogue_bibliotheque_produit_id;
	}

	/**
	 * @param int $catalogue_bibliotheque_type
	 */
	public function setCatalogue_bibliotheque_type($catalogue_bibliotheque_type)
	{
		$this->catalogue_bibliotheque_type = $catalogue_bibliotheque_type;
	}

	/**
	 * @return the  $catalogue_bibliotheque_type
	 */
	public function getCatalogue_bibliotheque_type()
	{
		return $this->catalogue_bibliotheque_type;
	}

	/**
	 * @param varchar $catalogue_bibliotheque_file
	 */
	public function setCatalogue_bibliotheque_file($catalogue_bibliotheque_file)
	{
		$this->catalogue_bibliotheque_file = $catalogue_bibliotheque_file;
	}

	/**
	 * @return the  $catalogue_bibliotheque_file
	 */
	public function getCatalogue_bibliotheque_file()
	{
		return $this->catalogue_bibliotheque_file;
	}

	/**
	 * @param int $catalogue_bibliotheque_deleted
	 */
	public function setCatalogue_bibliotheque_deleted($catalogue_bibliotheque_deleted)
	{
		$this->catalogue_bibliotheque_deleted = $catalogue_bibliotheque_deleted;
	}

	/**
	 * @return the  $catalogue_bibliotheque_deleted
	 */
	public function getCatalogue_bibliotheque_deleted()
	{
		return $this->catalogue_bibliotheque_deleted;
	}

	/**
	 * @param datetime $catalogue_bibliotheque_dateAdded
	 */
	public function setCatalogue_bibliotheque_dateAdded($catalogue_bibliotheque_dateAdded)
	{
		$this->catalogue_bibliotheque_dateAdded = $catalogue_bibliotheque_dateAdded;
	}

	/**
	 * @return the  $catalogue_bibliotheque_dateAdded
	 */
	public function getCatalogue_bibliotheque_dateAdded()
	{
		return $this->catalogue_bibliotheque_dateAdded;
	}

	/**
	 * @param timestamp $catalogue_bibliotheque_dateUpdated
	 */
	public function setCatalogue_bibliotheque_dateUpdated($catalogue_bibliotheque_dateUpdated)
	{
		$this->catalogue_bibliotheque_dateUpdated = $catalogue_bibliotheque_dateUpdated;
	}

	/**
	 * @return the  $catalogue_bibliotheque_dateUpdated
	 */
	public function getCatalogue_bibliotheque_dateUpdated()
	{
		return $this->catalogue_bibliotheque_dateUpdated;
	}

	public function getListeByProduitId($produitId){
		$objDB = new $this->_myDbClassName(); /* @var $objDB Db_CatalogueBibliotheque */
		$select = $objDB->mySelectBuild();
		$select->where('catalogue_bibliotheque_produit_id = ?',$produitId);
		$select->where('catalogue_bibliotheque_deleted = 0');
		return $this->getListe(false,$select);
	}

	public function getMainImageByProduitId($produitId){
		$objDB = new $this->_myDbClassName(); /* @var $objDB Db_CatalogueBibliotheque */
		$select = $objDB->mySelectBuild();
		$select->where('catalogue_bibliotheque_produit_id = ?',$produitId);
		$select->where('catalogue_bibliotheque_deleted = 0');
		$select->where('catalogue_bibliotheque_type = 1');
		$select->limit(1);
		$res = $this->getOneRowset($select);
		$bib = new CatalogueBibliotheque($res['catalogue_bibliotheque_id']);
		return $bib->getCatalogue_bibliotheque_file();
	}
}