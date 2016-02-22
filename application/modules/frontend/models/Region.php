<?php


/**
 * Générateur version 2.0
 */
class Region extends App_Model_Std {


	/* Champs de la table */

	protected $reg_code = 0;
	protected $reg_nom = null;
	protected $reg_codecheflieu = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Region";
		$this->_myDbPrimary         = "reg_code";
		$this->_myMetierClassName   = "Region";
		$this->_myDbTableName       = "frontend_region";
		$this->_myDbFieldPrefix     = "reg";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $reg_code
	 */
	public function setReg_code($reg_code)
	{
		$this->reg_code = $reg_code;
	}

	/**
	 * @return the  $reg_code
	 */
	public function getReg_code()
	{
		return $this->reg_code;
	}

	/**
	 * @param varchar $reg_nom
	 */
	public function setReg_nom($reg_nom)
	{
		$this->reg_nom = $reg_nom;
	}

	/**
	 * @return the  $reg_nom
	 */
	public function getReg_nom()
	{
		return $this->reg_nom;
	}

	/**
	 * @param varchar $reg_codecheflieu
	 */
	public function setReg_codecheflieu($reg_codecheflieu)
	{
		$this->reg_codecheflieu = $reg_codecheflieu;
	}

	/**
	 * @return the  $reg_codecheflieu
	 */
	public function getReg_codecheflieu()
	{
		return $this->reg_codecheflieu;
	}


}