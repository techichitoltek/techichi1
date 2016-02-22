<?php
/**
 *  models/Metier/MessagerieConversation.php
 */


/**
 * Générateur version 2.0
 */
class MessagerieConversation extends App_Model_Std {


	/* Champs de la table */

	protected $conversation_id = 0;
	protected $conversation_from_user_id = "";
	protected $conversation_to_user_id = "";
	protected $conversation_transaction_id = null;
	protected $conversation_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_MessagerieConversation";
		$this->_myDbPrimary         = "conversation_id";
		$this->_myMetierClassName   = "MessagerieConversation";
		$this->_myDbTableName       = "frontend_messagerie_conversation";
		$this->_myDbFieldPrefix     = "conversation";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $conversation_id
	 */
	public function setConversation_id($conversation_id)
	{
		$this->conversation_id = $conversation_id;
	}

	/**
	 * @return the  $conversation_id
	 */
	public function getConversation_id()
	{
		return $this->conversation_id;
	}

	/**
	 * @param int $conversation_from_user_id
	 */
	public function setConversation_from_user_id($conversation_from_user_id)
	{
		$this->conversation_from_user_id = $conversation_from_user_id;
	}

	/**
	 * @return the  $conversation_from_user_id
	 */
	public function getConversation_from_user_id()
	{
		return $this->conversation_from_user_id;
	}

	/**
	 * @param int $conversation_to_user_id
	 */
	public function setConversation_to_user_id($conversation_to_user_id)
	{
		$this->conversation_to_user_id = $conversation_to_user_id;
	}

	/**
	 * @return the  $conversation_to_user_id
	 */
	public function getConversation_to_user_id()
	{
		return $this->conversation_to_user_id;
	}

	/**
	 * @param int $conversation_transaction_id
	 */
	public function setConversation_transaction_id($conversation_transaction_id)
	{
		$this->conversation_transaction_id = $conversation_transaction_id;
	}

	/**
	 * @return the  $conversation_transaction_id
	 */
	public function getConversation_transaction_id()
	{
		return $this->conversation_transaction_id;
	}

	/**
	 * @param timestamp $conversation_dateAdded
	 */
	public function setConversation_dateAdded($conversation_dateAdded)
	{
		$this->conversation_dateAdded = $conversation_dateAdded;
	}

	/**
	 * @return the  $conversation_dateAdded
	 */
	public function getConversation_dateAdded()
	{
		return $this->conversation_dateAdded;
	}


}