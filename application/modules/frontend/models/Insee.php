<?php
/**
 *  models/Metier/Insee.php
 */


/**
 * Générateur version 2.0
 */
class Insee extends App_Model_Std {


	/* Champs de la table */

	protected $INSEE = 0;
	protected $CDC = null;
	protected $CHEFLIEU = null;
	protected $REG = null;
	protected $DEP = null;
	protected $COM = null;
	protected $AR = null;
	protected $CT = null;
	protected $TNCC = null;
	protected $ARTMAJ = null;
	protected $NCC = null;
	protected $ARTMIN = null;
	protected $NCCENR = null;
	protected $LAT = null;
	protected $LONG = null;
	protected $CP = null;
	protected $dateUpdated = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_Insee";
		$this->_myDbPrimary         = "INSEE";
		$this->_myMetierClassName   = "Insee";
		$this->_myDbTableName       = "frontend_insee";
		$this->_myDbFieldPrefix     = "";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param varchar $INSEE
	 */
	public function setINSEE($INSEE)
	{
		$this->INSEE = $INSEE;
	}

	/**
	 * @return the  $INSEE
	 */
	public function getINSEE()
	{
		return $this->INSEE;
	}

	/**
	 * @param varchar $CDC
	 */
	public function setCDC($CDC)
	{
		$this->CDC = $CDC;
	}

	/**
	 * @return the  $CDC
	 */
	public function getCDC()
	{
		return $this->CDC;
	}

	/**
	 * @param varchar $CHEFLIEU
	 */
	public function setCHEFLIEU($CHEFLIEU)
	{
		$this->CHEFLIEU = $CHEFLIEU;
	}

	/**
	 * @return the  $CHEFLIEU
	 */
	public function getCHEFLIEU()
	{
		return $this->CHEFLIEU;
	}

	/**
	 * @param varchar $REG
	 */
	public function setREG($REG)
	{
		$this->REG = $REG;
	}

	/**
	 * @return the  $REG
	 */
	public function getREG()
	{
		return $this->REG;
	}

	/**
	 * @param varchar $DEP
	 */
	public function setDEP($DEP)
	{
		$this->DEP = $DEP;
	}

	/**
	 * @return the  $DEP
	 */
	public function getDEP()
	{
		return $this->DEP;
	}

	/**
	 * @param varchar $COM
	 */
	public function setCOM($COM)
	{
		$this->COM = $COM;
	}

	/**
	 * @return the  $COM
	 */
	public function getCOM()
	{
		return $this->COM;
	}

	/**
	 * @param varchar $AR
	 */
	public function setAR($AR)
	{
		$this->AR = $AR;
	}

	/**
	 * @return the  $AR
	 */
	public function getAR()
	{
		return $this->AR;
	}

	/**
	 * @param varchar $CT
	 */
	public function setCT($CT)
	{
		$this->CT = $CT;
	}

	/**
	 * @return the  $CT
	 */
	public function getCT()
	{
		return $this->CT;
	}

	/**
	 * @param varchar $TNCC
	 */
	public function setTNCC($TNCC)
	{
		$this->TNCC = $TNCC;
	}

	/**
	 * @return the  $TNCC
	 */
	public function getTNCC()
	{
		return $this->TNCC;
	}

	/**
	 * @param varchar $ARTMAJ
	 */
	public function setARTMAJ($ARTMAJ)
	{
		$this->ARTMAJ = $ARTMAJ;
	}

	/**
	 * @return the  $ARTMAJ
	 */
	public function getARTMAJ()
	{
		return $this->ARTMAJ;
	}

	/**
	 * @param varchar $NCC
	 */
	public function setNCC($NCC)
	{
		$this->NCC = $NCC;
	}

	/**
	 * @return the  $NCC
	 */
	public function getNCC()
	{
		return $this->NCC;
	}

	/**
	 * @param varchar $ARTMIN
	 */
	public function setARTMIN($ARTMIN)
	{
		$this->ARTMIN = $ARTMIN;
	}

	/**
	 * @return the  $ARTMIN
	 */
	public function getARTMIN()
	{
		return $this->ARTMIN;
	}

	/**
	 * @param varchar $NCCENR
	 */
	public function setNCCENR($NCCENR)
	{
		$this->NCCENR = $NCCENR;
	}

	/**
	 * @return the  $NCCENR
	 */
	public function getNCCENR()
	{
		return $this->NCCENR;
	}

	/**
	 * @param float $LAT
	 */
	public function setLAT($LAT)
	{
		$this->LAT = $LAT;
	}

	/**
	 * @return the  $LAT
	 */
	public function getLAT()
	{
		return $this->LAT;
	}

	/**
	 * @param float $LONG
	 */
	public function setLONG($LONG)
	{
		$this->LONG = $LONG;
	}

	/**
	 * @return the  $LONG
	 */
	public function getLONG()
	{
		return $this->LONG;
	}

	/**
	 * @param varchar $CP
	 */
	public function setCP($CP)
	{
		$this->CP = $CP;
	}

	/**
	 * @return the  $CP
	 */
	public function getCP()
	{
		return $this->CP;
	}

	/**
	 * @param timestamp $dateUpdated
	 */
	public function setDateUpdated($dateUpdated)
	{
		$this->dateUpdated = $dateUpdated;
	}

	/**
	 * @return the  $dateUpdated
	 */
	public function getDateUpdated()
	{
		return $this->dateUpdated;
	}


}