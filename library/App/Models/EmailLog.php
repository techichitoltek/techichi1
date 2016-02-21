<?php
class EmailLog extends App_Model_Std {


    /* Champs de la table */

    protected $emailLog_id = 0;
    protected $emailLog_name = "";
    protected $emailLog_templateName = "";
    protected $emailLog_to = "";
    protected $emailLog_cc = "";
    protected $emailLog_bcc = "";
    protected $emailLog_subject = "";
    protected $emailLog_bodyHtml = "";
    protected $emailLog_from = "";
    protected $emailLog_replyTo = "";
    protected $emailLog_sent = 0;
    protected $emailLog_log = null;
    protected $emailLog_dateAdded = "";
    protected $emailLog_dateUpdated = null;


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_EmailLog";
        $this->_myDbPrimary         = "emailLog_id";
        $this->_myMetierClassName   = "EmailLog";
        $this->_myDbTableName       = "ztdf_emails_log";
        $this->_myDbFieldPrefix     = "emailLog";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $emailLog_id
     */
    public function getEmailLog_id() {
        return $this->emailLog_id;
    }

    /**
     * @param number $emailLog_id
     */
    public function setEmailLog_id($emailLog_id) {
        $this->emailLog_id = $emailLog_id;
    }

    /**
     * @return the $emailLog_name
     */
    public function getEmailLog_name() {
        return $this->emailLog_name;
    }

    /**
     * @param string $emailLog_name
     */
    public function setEmailLog_name($emailLog_name) {
        $this->emailLog_name = $emailLog_name;
    }

    /**
     * @return the $emailLog_templateName
     */
    public function getEmailLog_templateName() {
        return $this->emailLog_templateName;
    }

    /**
     * @param string $emailLog_templateName
     */
    public function setEmailLog_templateName($emailLog_templateName) {
        $this->emailLog_templateName = $emailLog_templateName;
    }

    /**
     * @return the $emailLog_to
     */
    public function getEmailLog_to() {
        return $this->emailLog_to;
    }

    /**
     * @param string $emailLog_to
     */
    public function setEmailLog_to($emailLog_to) {
        $this->emailLog_to = $emailLog_to;
    }

    /**
     * @return the $emailLog_cc
     */
    public function getEmailLog_cc() {
        return $this->emailLog_cc;
    }

    /**
     * @param string $emailLog_cc
     */
    public function setEmailLog_cc($emailLog_cc) {
        $this->emailLog_cc = $emailLog_cc;
    }

    /**
     * @return the $emailLog_bcc
     */
    public function getEmailLog_bcc() {
        return $this->emailLog_bcc;
    }

    /**
     * @param string $emailLog_bcc
     */
    public function setEmailLog_bcc($emailLog_bcc) {
        $this->emailLog_bcc = $emailLog_bcc;
    }

    /**
     * @return the $emailLog_subject
     */
    public function getEmailLog_subject() {
        return $this->emailLog_subject;
    }

    /**
     * @param string $emailLog_subject
     */
    public function setEmailLog_subject($emailLog_subject) {
        $this->emailLog_subject = $emailLog_subject;
    }

    /**
     * @return the $emailLog_bodyHtml
     */
    public function getEmailLog_bodyHtml() {
        return $this->emailLog_bodyHtml;
    }

    /**
     * @param string $emailLog_bodyHtml
     */
    public function setEmailLog_bodyHtml($emailLog_bodyHtml) {
        $this->emailLog_bodyHtml = $emailLog_bodyHtml;
    }

    /**
     * @return the $emailLog_from
     */
    public function getEmailLog_from() {
        return $this->emailLog_from;
    }

    /**
     * @param string $emailLog_from
     */
    public function setEmailLog_from($emailLog_from) {
        $this->emailLog_from = $emailLog_from;
    }

    /**
     * @return the $emailLog_replyTo
     */
    public function getEmailLog_replyTo() {
        return $this->emailLog_replyTo;
    }

    /**
     * @param string $emailLog_replyTo
     */
    public function setEmailLog_replyTo($emailLog_replyTo) {
        $this->emailLog_replyTo = $emailLog_replyTo;
    }

    /**
     * @return the $emailLog_sent
     */
    public function getEmailLog_sent() {
        return $this->emailLog_sent;
    }

    /**
     * @param number $emailLog_sent
     */
    public function setEmailLog_sent($emailLog_sent) {
        $this->emailLog_sent = $emailLog_sent;
    }

    /**
     * @return the $emailLog_log
     */
    public function getEmailLog_log() {
        return $this->emailLog_log;
    }

    /**
     * @param field_type $emailLog_log
     */
    public function setEmailLog_log($emailLog_log) {
        $this->emailLog_log = $emailLog_log;
    }

    /**
     * @return the $emailLog_dateAdded
     */
    public function getEmailLog_dateAdded() {
        return $this->emailLog_dateAdded;
    }

    /**
     * @param string $emailLog_dateAdded
     */
    public function setEmailLog_dateAdded($emailLog_dateAdded) {
        $this->emailLog_dateAdded = $emailLog_dateAdded;
    }

    /**
     * @return the $emailLog_dateUpdated
     */
    public function getEmailLog_dateUpdated() {
        return $this->emailLog_dateUpdated;
    }

    /**
     * @param string $emailLog_dateUpdated
     */
    public function setEmailLog_dateUpdated($emailLog_dateUpdated) {
        $this->emailLog_dateUpdated = $emailLog_dateUpdated;
    }

    /**
     *
     * @param PHPMailer $mail
     * @param Email $email
     */
    public function loadEmail($mail,$email){
        $this->setEmailLog_name($email->getEmail_name());
        $this->setEmailLog_templateName($email->getEmail_template());
        $this->setEmailLog_bodyHtml($mail->Body);
        $this->setEmailLog_from($mail->From);
        $this->setEmailLog_replyTo($mail->Sender);
        $this->setEmailLog_subject($mail->Subject);
    }

}