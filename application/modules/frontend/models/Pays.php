<?php
/**
 *  models/Metier/Pays.php
 */


/**
 * Générateur version 2.0
 */
class Pays extends App_Model_Std {


	/* Champs de la table */

	protected $id = 0;
	protected $code = "";
	protected $alpha2 = "";
	protected $alpha3 = "";
	protected $nom_en_gb = "";
	protected $nom_fr_fr = "";


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Pays";
		$this->_myDbPrimary         = "id";
		$this->_myMetierClassName   = "Pays";
		$this->_myDbTableName       = "frontend_pays";
		$this->_myDbFieldPrefix     = "";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param smallint $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return the  $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}

	/**
	 * @return the  $code
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @param varchar $alpha2
	 */
	public function setAlpha2($alpha2)
	{
		$this->alpha2 = $alpha2;
	}

	/**
	 * @return the  $alpha2
	 */
	public function getAlpha2()
	{
		return $this->alpha2;
	}

	/**
	 * @param varchar $alpha3
	 */
	public function setAlpha3($alpha3)
	{
		$this->alpha3 = $alpha3;
	}

	/**
	 * @return the  $alpha3
	 */
	public function getAlpha3()
	{
		return $this->alpha3;
	}

	/**
	 * @param varchar $nom_en_gb
	 */
	public function setNom_en_gb($nom_en_gb)
	{
		$this->nom_en_gb = $nom_en_gb;
	}

	/**
	 * @return the  $nom_en_gb
	 */
	public function getNom_en_gb()
	{
		return $this->nom_en_gb;
	}

	/**
	 * @param varchar $nom_fr_fr
	 */
	public function setNom_fr_fr($nom_fr_fr)
	{
		$this->nom_fr_fr = $nom_fr_fr;
	}

	/**
	 * @return the  $nom_fr_fr
	 */
	public function getNom_fr_fr()
	{
		return $this->nom_fr_fr;
	}


}