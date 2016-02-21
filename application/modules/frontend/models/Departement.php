<?php
/**
 * Générateur version 2.0
 */
class FrontendDepartement extends App_Model_Std {


	/* Champs de la table */

	protected $dep_code = 0;
	protected $dep_id = "";
	protected $dep_nom = null;
	protected $dep_codecheflieu = null;
	protected $reg_code = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_FrontendDepartement";
		$this->_myDbPrimary         = "dep_code";
		$this->_myMetierClassName   = "FrontendDepartement";
		$this->_myDbTableName       = "frontend_departement";
		$this->_myDbFieldPrefix     = "dep";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param varchar $dep_code
	 */
	public function setDep_code($dep_code)
	{
		$this->dep_code = $dep_code;
	}

	/**
	 * @return the  $dep_code
	 */
	public function getDep_code()
	{
		return $this->dep_code;
	}

	/**
	 * @param int $dep_id
	 */
	public function setDep_id($dep_id)
	{
		$this->dep_id = $dep_id;
	}

	/**
	 * @return the  $dep_id
	 */
	public function getDep_id()
	{
		return $this->dep_id;
	}

	/**
	 * @param varchar $dep_nom
	 */
	public function setDep_nom($dep_nom)
	{
		$this->dep_nom = $dep_nom;
	}

	/**
	 * @return the  $dep_nom
	 */
	public function getDep_nom()
	{
		return $this->dep_nom;
	}

	/**
	 * @param varchar $dep_codecheflieu
	 */
	public function setDep_codecheflieu($dep_codecheflieu)
	{
		$this->dep_codecheflieu = $dep_codecheflieu;
	}

	/**
	 * @return the  $dep_codecheflieu
	 */
	public function getDep_codecheflieu()
	{
		return $this->dep_codecheflieu;
	}

	/**
	 * @param varchar $reg_code
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


}