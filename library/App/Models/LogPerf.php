<?php
class LogPerf extends App_Model_Std {


    /* Champs de la table */

    protected $logperf_id = 0;
    protected $logperf_ip = "";
    protected $logperf_user_agent = "";
    protected $logperf_url = "";
    protected $logperf_module = "";
    protected $logperf_controller = "";
    protected $logperf_action = "";
    protected $logperf_get = "";
    protected $logperf_post = "";
    protected $logperf_temps = "";
    protected $logperf_decalage = "";
    protected $logperf_tempsTotal = "";
    protected $logperf_profiler = "";
    protected $logperf_isbot = "";
    protected $logperf_httpReferrer = "";
    protected $logperf_dateAdded = null;
    protected $logperf_dateUpdated = null;


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_LogPerf";
        $this->_myDbPrimary         = "logperf_id";
        $this->_myMetierClassName   = "LogPerf";
        $this->_myDbTableName       = "ztdf_logperf";
        $this->_myDbFieldPrefix     = "logperf";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $logperf_id
     */
    public function getLogperf_id() {
        return $this->logperf_id;
    }

    /**
     * @param number $logperf_id
     */
    public function setLogperf_id($logperf_id) {
        $this->logperf_id = $logperf_id;
    }

    /**
     * @return the $logperf_ip
     */
    public function getLogperf_ip() {
        return $this->logperf_ip;
    }

    /**
     * @param string $logperf_ip
     */
    public function setLogperf_ip($logperf_ip) {
        $this->logperf_ip = $logperf_ip;
    }

    /**
     * @return the $logperf_user_agent
     */
    public function getLogperf_user_agent() {
        return $this->logperf_user_agent;
    }

    /**
     * @param string $logperf_user_agent
     */
    public function setLogperf_user_agent($logperf_user_agent) {
        $this->logperf_user_agent = $logperf_user_agent;
    }

    /**
     * @return the $logperf_date
     */
    public function getLogperf_date() {
        return $this->logperf_date;
    }

    /**
     * @param string $logperf_date
     */
    public function setLogperf_date($logperf_date) {
        $this->logperf_date = $logperf_date;
    }

    /**
     * @return the $logperf_url
     */
    public function getLogperf_url() {
        return $this->logperf_url;
    }

    /**
     * @param string $logperf_url
     */
    public function setLogperf_url($logperf_url) {
        $this->logperf_url = $logperf_url;
    }

    /**
     * @return the $logperf_module
     */
    public function getLogperf_module() {
        return $this->logperf_module;
    }

    /**
     * @param string $logperf_module
     */
    public function setLogperf_module($logperf_module) {
        $this->logperf_module = $logperf_module;
    }

    /**
     * @return the $logperf_controller
     */
    public function getLogperf_controller() {
        return $this->logperf_controller;
    }

    /**
     * @param string $logperf_controller
     */
    public function setLogperf_controller($logperf_controller) {
        $this->logperf_controller = $logperf_controller;
    }

    /**
     * @return the $logperf_action
     */
    public function getLogperf_action() {
        return $this->logperf_action;
    }

    /**
     * @param string $logperf_action
     */
    public function setLogperf_action($logperf_action) {
        $this->logperf_action = $logperf_action;
    }

    /**
     * @return the $logperf_get
     */
    public function getLogperf_get() {
        return $this->logperf_get;
    }

    /**
     * @param string $logperf_get
     */
    public function setLogperf_get($logperf_get) {
        $this->logperf_get = $logperf_get;
    }

    /**
     * @return the $logperf_post
     */
    public function getLogperf_post() {
        return $this->logperf_post;
    }

    /**
     * @param string $logperf_post
     */
    public function setLogperf_post($logperf_post) {
        $this->logperf_post = $logperf_post;
    }

    /**
     * @return the $logperf_temps
     */
    public function getLogperf_temps() {
        return $this->logperf_temps;
    }

    /**
     * @param string $logperf_temps
     */
    public function setLogperf_temps($logperf_temps) {
        $this->logperf_temps = $logperf_temps;
    }

    /**
     * @return the $logperf_decalage
     */
    public function getLogperf_decalage() {
        return $this->logperf_decalage;
    }

    /**
     * @param string $logperf_decalage
     */
    public function setLogperf_decalage($logperf_decalage) {
        $this->logperf_decalage = $logperf_decalage;
    }

    /**
     * @return the $logperf_tempsTotal
     */
    public function getLogperf_tempsTotal() {
        return $this->logperf_tempsTotal;
    }

    /**
     * @param string $logperf_tempsTotal
     */
    public function setLogperf_tempsTotal($logperf_tempsTotal) {
        $this->logperf_tempsTotal = $logperf_tempsTotal;
    }

    /**
     * @return the $logperf_profiler
     */
    public function getLogperf_profiler() {
        return $this->logperf_profiler;
    }

    /**
     * @param string $logperf_profiler
     */
    public function setLogperf_profiler($logperf_profiler) {
        $this->logperf_profiler = $logperf_profiler;
    }

    /**
     * @return the $logperf_isbot
     */
    public function getLogperf_isbot() {
        return $this->logperf_isbot;
    }

    /**
     * @param string $logperf_isbot
     */
    public function setLogperf_isbot($logperf_isbot) {
        $this->logperf_isbot = $logperf_isbot;
    }

    /**
     * @return the $logperf_httpReferrer
     */
    public function getLogperf_httpReferrer() {
        return $this->logperf_httpReferrer;
    }

    /**
     * @param string $logperf_httpReferrer
     */
    public function setLogperf_httpReferrer($logperf_httpReferrer) {
        $this->logperf_httpReferrer = $logperf_httpReferrer;
    }

    /**
     * @return the $logperf_dateAdded
     */
    public function getLogperf_dateAdded() {
        return $this->logperf_dateAdded;
    }

    /**
     * @param field_type $logperf_dateAdded
     */
    public function setLogperf_dateAdded($logperf_dateAdded) {
        $this->logperf_dateAdded = $logperf_dateAdded;
    }

    /**
     * @return the $logperf_dateUpdated
     */
    public function getLogperf_dateUpdated() {
        return $this->logperf_dateUpdated;
    }

    /**
     * @param field_type $logperf_dateUpdated
     */
    public function setLogperf_dateUpdated($logperf_dateUpdated) {
        $this->logperf_dateUpdated = $logperf_dateUpdated;
    }




}