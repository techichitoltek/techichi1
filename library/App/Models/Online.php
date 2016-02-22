<?php
class Online extends App_Model_Std {


    /* Champs de la table */

    protected $online_id = 0;
    protected $online_session = "";
    protected $online_ip = "";
    protected $online_timeGeneration = "";
    protected $online_timeGenerationTotal = "";
    protected $online_userAgent = "";
    protected $online_isBot = 0;
    protected $online_time = "";
    protected $online_portailUrl = null;
    protected $online_url = "";
    protected $online_referrer = "";
    protected $online_dateAdded = null;
    protected $online_dateUpdated = null;


    /* /Champs de la table */

    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_Online";
        $this->_myDbPrimary         = "online_id";
        $this->_myMetierClassName   = "Online";
        $this->_myDbTableName       = "zf_online";
        $this->_myDbFieldPrefix     = "online";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $online_id
     */
    public function getOnline_id() {
        return $this->online_id;
    }

    /**
     * @param number $online_id
     */
    public function setOnline_id($online_id) {
        $this->online_id = $online_id;
    }

    /**
     * @return the $online_session
     */
    public function getOnline_session() {
        return $this->online_session;
    }

    /**
     * @param string $online_session
     */
    public function setOnline_session($online_session) {
        $this->online_session = $online_session;
    }

    /**
     * @return the $online_ip
     */
    public function getOnline_ip() {
        return $this->online_ip;
    }

    /**
     * @param string $online_ip
     */
    public function setOnline_ip($online_ip) {
        $this->online_ip = $online_ip;
    }

    /**
     * @return the $online_timeGeneration
     */
    public function getOnline_timeGeneration() {
        return $this->online_timeGeneration;
    }

    /**
     * @param string $online_timeGeneration
     */
    public function setOnline_timeGeneration($online_timeGeneration) {
        $this->online_timeGeneration = $online_timeGeneration;
    }

    /**
     * @return the $online_timeGenerationTotal
     */
    public function getOnline_timeGenerationTotal() {
        return $this->online_timeGenerationTotal;
    }

    /**
     * @param string $online_timeGenerationTotal
     */
    public function setOnline_timeGenerationTotal($online_timeGenerationTotal) {
        $this->online_timeGenerationTotal = $online_timeGenerationTotal;
    }

    /**
     * @return the $online_userAgent
     */
    public function getOnline_userAgent() {
        return $this->online_userAgent;
    }

    /**
     * @param string $online_userAgent
     */
    public function setOnline_userAgent($online_userAgent) {
        $this->online_userAgent = $online_userAgent;
    }

    /**
     * @return the $online_isBot
     */
    public function getOnline_isBot() {
        return $this->online_isBot;
    }

    /**
     * @param number $online_isBot
     */
    public function setOnline_isBot($online_isBot) {
        $this->online_isBot = $online_isBot;
    }

    /**
     * @return the $online_time
     */
    public function getOnline_time() {
        return $this->online_time;
    }

    /**
     * @param string $online_time
     */
    public function setOnline_time($online_time) {
        $this->online_time = $online_time;
    }

    /**
     * @return the $online_portailUrl
     */
    public function getOnline_portailUrl() {
        return $this->online_portailUrl;
    }

    /**
     * @param field_type $online_portailUrl
     */
    public function setOnline_portailUrl($online_portailUrl) {
        $this->online_portailUrl = $online_portailUrl;
    }

    /**
     * @return the $online_url
     */
    public function getOnline_url() {
        return $this->online_url;
    }

    /**
     * @param string $online_url
     */
    public function setOnline_url($online_url) {
        $this->online_url = $online_url;
    }

    /**
     * @return the $online_referrer
     */
    public function getOnline_referrer() {
        return $this->online_referrer;
    }

    /**
     * @param string $online_referrer
     */
    public function setOnline_referrer($online_referrer) {
        $this->online_referrer = $online_referrer;
    }

    /**
     * @return the $online_dateAdded
     */
    public function getOnline_dateAdded() {
        return $this->online_dateAdded;
    }

    /**
     * @param field_type $online_dateAdded
     */
    public function setOnline_dateAdded($online_dateAdded) {
        $this->online_dateAdded = $online_dateAdded;
    }

    /**
     * @return the $online_dateUpdated
     */
    public function getOnline_dateUpdated() {
        return $this->online_dateUpdated;
    }

    /**
     * @param field_type $online_dateUpdated
     */
    public function setOnline_dateUpdated($online_dateUpdated) {
        $this->online_dateUpdated = $online_dateUpdated;
    }

    public function updateOnline(){
        $objDb = new $this->_myDbClassName; /* @var $objDb Db_Online */

        // 6 minutes
        $tps_max_connex = 360;

        $temps_actuel = time();
        // on calcule le temps imparti pour comptabiliser les connectés au site
        $heure_max = $temps_actuel - $tps_max_connex;

        $sql = 'DELETE FROM zf_online WHERE online_time < '.$heure_max;
        $objDb->Db_execute($sql);

    }

    public function getOnlineDuration(){
        $dateAdded = new Zend_Date($this->getOnline_dateAdded(),Zend_Date::ISO_8601);
        $dateUpdated = new Zend_Date($this->getOnline_dateUpdated(),Zend_Date::ISO_8601);
        $diff = $dateUpdated->sub($dateAdded)->toValue();
        $measureTime = new App_Time_Interval($diff,Zend_Measure_Time::SECOND,Zend_Registry::get('Zend_Locale'));
        return $measureTime;
    }

}