<?php



/**
 *  models/Db/MessagerieConversation.php
 */

/**
 * Générateur version 2.0
 */
class Db_MessagerieConversation extends App_Model_Db {

	public function __construct()
	{
		$this->_myDbClassName       = "Db_MessagerieConversation";
		$this->_myDbPrimary         = "conversation_id";
		$this->_myMetierClassName   = "MessagerieConversation";
		$this->_myDbTableName       = "frontend_messagerie_conversation";
		$this->_myDbFieldPrefix     = "conversation";

		parent::__construct();
	}

	function myFullSelectBuild(){
		$select = $this->select()->setIntegrityCheck(false);
		return $select;
	}

}
