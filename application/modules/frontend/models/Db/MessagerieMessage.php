<?php



/**
 *  models/Db/MessagerieMessage.php
 */

/**
 * Générateur version 2.0
 */
class Db_MessagerieMessage extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_MessagerieMessage";
		$this->_myDbPrimary         = "message_id";
		$this->_myMetierClassName   = "MessagerieMessage";
		$this->_myDbTableName       = "frontend_messagerie_message";
		$this->_myDbFieldPrefix     = "message";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}
