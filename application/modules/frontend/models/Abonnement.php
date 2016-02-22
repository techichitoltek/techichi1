<?php
/**
 *  models/Metier/Abonnement.php
 */


/**
 * Générateur version 2.0
 */
class Abonnement extends App_Model_Std {


	/* Champs de la table */

	protected $abo_id = 0;
	protected $abo_type_id = "";
	protected $abo_user_id = "";
	protected $abo_start = "";
	protected $abo_end = null;
	protected $abo_order = "";
	protected $abo_resiliation = null;
	protected $abo_resiliation_motif = null;
	protected $abo_desactive = 0;
	protected $abo_dateAdded = null;
	protected $abo_dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Abonnement";
		$this->_myDbPrimary         = "abo_id";
		$this->_myMetierClassName   = "Abonnement";
		$this->_myDbTableName       = "frontend_abonnement";
		$this->_myDbFieldPrefix     = "abo";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $abo_id
	 */
	public function setAbo_id($abo_id)
	{
		$this->abo_id = $abo_id;
	}

	/**
	 * @return the  $abo_id
	 */
	public function getAbo_id()
	{
		return $this->abo_id;
	}

	/**
	 * @param int $abo_type_id
	 */
	public function setAbo_type_id($abo_type_id)
	{
		$this->abo_type_id = $abo_type_id;
	}

	/**
	 * @return the  $abo_type_id
	 */
	public function getAbo_type_id()
	{
		return $this->abo_type_id;
	}

	/**
	 * @param int $abo_user_id
	 */
	public function setAbo_user_id($abo_user_id)
	{
		$this->abo_user_id = $abo_user_id;
	}

	/**
	 * @return the  $abo_user_id
	 */
	public function getAbo_user_id()
	{
		return $this->abo_user_id;
	}

	/**
	 * @param datetime $abo_start
	 */
	public function setAbo_start($abo_start)
	{
		$this->abo_start = $abo_start;
	}

	/**
	 * @return the  $abo_start
	 */
	public function getAbo_start()
	{
		return $this->abo_start;
	}

	/**
	 * @param datetime $abo_end
	 */
	public function setAbo_end($abo_end)
	{
		$this->abo_end = $abo_end;
	}

	/**
	 * @return the  $abo_end
	 */
	public function getAbo_end()
	{
		return $this->abo_end;
	}

	/**
	 * @param datetime $abo_order
	 */
	public function setAbo_order($abo_order)
	{
		$this->abo_order = $abo_order;
	}

	/**
	 * @return the  $abo_order
	 */
	public function getAbo_order()
	{
		return $this->abo_order;
	}

	/**
	 * @param datetime $abo_resiliation
	 */
	public function setAbo_resiliation($abo_resiliation)
	{
		$this->abo_resiliation = $abo_resiliation;
	}

	/**
	 * @return the  $abo_resiliation
	 */
	public function getAbo_resiliation()
	{
		return $this->abo_resiliation;
	}

	/**
	 * @param varchar $abo_resiliation_motif
	 */
	public function setAbo_resiliation_motif($abo_resiliation_motif)
	{
		$this->abo_resiliation_motif = $abo_resiliation_motif;
	}

	/**
	 * @return the  $abo_resiliation_motif
	 */
	public function getAbo_resiliation_motif()
	{
		return $this->abo_resiliation_motif;
	}

	/**
	 * @param int $abo_desactive
	 */
	public function setAbo_desactive($abo_desactive)
	{
		$this->abo_desactive = $abo_desactive;
	}

	/**
	 * @return the  $abo_desactive
	 */
	public function getAbo_desactive()
	{
		return $this->abo_desactive;
	}

	/**
	 * @param datetime $abo_dateAdded
	 */
	public function setAbo_dateAdded($abo_dateAdded)
	{
		$this->abo_dateAdded = $abo_dateAdded;
	}

	/**
	 * @return the  $abo_dateAdded
	 */
	public function getAbo_dateAdded()
	{
		return $this->abo_dateAdded;
	}

	/**
	 * @param timestamp $abo_dateUpdated
	 */
	public function setAbo_dateUpdated($abo_dateUpdated)
	{
		$this->abo_dateUpdated = $abo_dateUpdated;
	}

	/**
	 * @return the  $abo_dateUpdated
	 */
	public function getAbo_dateUpdated()
	{
		return $this->abo_dateUpdated;
	}


}