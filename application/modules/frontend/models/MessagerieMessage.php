<?php
/**
 *  models/Metier/MessagerieMessage.php
 */


/**
 * Générateur version 2.0
 */
class MessagerieMessage extends App_Model_Std {


	/* Champs de la table */

	protected $message_id = 0;
	protected $message_conversation_id = "";
	protected $message_from_user_id = "";
	protected $message_to_user_id = "";
	protected $message_date_envoi = "";
	protected $message_isReaded = 0;
	protected $message_dateAdded = null;


	/* /Champs de la table */

	public function __construct($id = false,$full = false,$champ="")
	{
		parent::__construct();
		$this->_myDbClassName       = "Db_MessagerieMessage";
		$this->_myDbPrimary         = "message_id";
		$this->_myMetierClassName   = "MessagerieMessage";
		$this->_myDbTableName       = "frontend_messagerie_message";
		$this->_myDbFieldPrefix     = "message";

		if($id) $this->loadById($id,$full,$champ);
	}


	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////


	/**
	 * @param int $message_id
	 */
	public function setMessage_id($message_id)
	{
		$this->message_id = $message_id;
	}

	/**
	 * @return the  $message_id
	 */
	public function getMessage_id()
	{
		return $this->message_id;
	}

	/**
	 * @param int $message_conversation_id
	 */
	public function setMessage_conversation_id($message_conversation_id)
	{
		$this->message_conversation_id = $message_conversation_id;
	}

	/**
	 * @return the  $message_conversation_id
	 */
	public function getMessage_conversation_id()
	{
		return $this->message_conversation_id;
	}

	/**
	 * @param int $message_from_user_id
	 */
	public function setMessage_from_user_id($message_from_user_id)
	{
		$this->message_from_user_id = $message_from_user_id;
	}

	/**
	 * @return the  $message_from_user_id
	 */
	public function getMessage_from_user_id()
	{
		return $this->message_from_user_id;
	}

	/**
	 * @param int $message_to_user_id
	 */
	public function setMessage_to_user_id($message_to_user_id)
	{
		$this->message_to_user_id = $message_to_user_id;
	}

	/**
	 * @return the  $message_to_user_id
	 */
	public function getMessage_to_user_id()
	{
		return $this->message_to_user_id;
	}

	/**
	 * @param datetime $message_date_envoi
	 */
	public function setMessage_date_envoi($message_date_envoi)
	{
		$this->message_date_envoi = $message_date_envoi;
	}

	/**
	 * @return the  $message_date_envoi
	 */
	public function getMessage_date_envoi()
	{
		return $this->message_date_envoi;
	}

	/**
	 * @param int $message_isReaded
	 */
	public function setMessage_isReaded($message_isReaded)
	{
		$this->message_isReaded = $message_isReaded;
	}

	/**
	 * @return the  $message_isReaded
	 */
	public function getMessage_isReaded()
	{
		return $this->message_isReaded;
	}

	/**
	 * @param timestamp $message_dateAdded
	 */
	public function setMessage_dateAdded($message_dateAdded)
	{
		$this->message_dateAdded = $message_dateAdded;
	}

	/**
	 * @return the  $message_dateAdded
	 */
	public function getMessage_dateAdded()
	{
		return $this->message_dateAdded;
	}


}