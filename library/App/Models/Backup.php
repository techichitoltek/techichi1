<?php
class Backup extends App_Model_Std {

    const BACKUP_TYPE_BDD = "BDD";
    const BACKUP_TYPE_FILES = "FILES";

    const BACKUP_STATE_START = "START";
    const BACKUP_STATE_DUMP = "DUMP";
    const BACKUP_STATE_COMPRESS = "COMPRESS";
    const BACKUP_STATE_FINISHED = "FINISHED";

    /* Champs de la table */

    protected $backup_id = 0;
    protected $backup_type = "";
    protected $backup_path = "";
    protected $backup_size = 0;
    protected $backup_state = NULL;
    protected $backup_error = 0;
    protected $backup_dateAdded = null;
    protected $backup_dateUpdated = null;


    /* /Champs de la table */



    public function __construct($id = false,$full = false,$champ="")
    {
        parent::__construct();
        $this->_myDbClassName       = "Db_Backup";
        $this->_myDbPrimary         = "backup_id";
        $this->_myMetierClassName   = "Backup";
        $this->_myDbTableName       = "zf_backup";
        $this->_myDbFieldPrefix     = "backup";

        if($id !== false) $this->loadById($id,$full,$champ);
    }

    /**
     * @return the $backup_id
     */
    public function getBackup_id() {
        return $this->backup_id;
    }

    /**
     * @param number $backup_id
     */
    public function setBackup_id($backup_id) {
        $this->backup_id = $backup_id;
    }

    /**
     * @return the $backup_type
     */
    public function getBackup_type() {
        return $this->backup_type;
    }

    /**
     * @param string $backup_type
     */
    public function setBackup_type($backup_type) {
        $this->backup_type = $backup_type;
    }

    /**
     * @return the $backup_path
     */
    public function getBackup_path() {
        return $this->backup_path;
    }

    /**
     * @param string $backup_path
     */
    public function setBackup_path($backup_path) {
        $this->backup_path = $backup_path;
    }

    /**
     * @return the $backup_size
     */
    public function getBackup_size() {
        return $this->backup_size;
    }

    /**
     * @param number $backup_size
     */
    public function setBackup_size($backup_size) {
        $this->backup_size = $backup_size;
    }

    /**
     * @return the $backup_state
     */
    public function getBackup_state() {
        return $this->backup_state;
    }

    /**
     * @param number $backup_state
     */
    public function setBackup_state($backup_state) {
        $this->backup_state = $backup_state;
    }

    /**
     * @return the $backup_error
     */
    public function getBackup_error() {
        return $this->backup_error;
    }

    /**
     * @param number $backup_error
     */
    public function setBackup_error($backup_error) {
        $this->backup_error = $backup_error;
    }

    /**
     * @return the $backup_dateAdded
     */
    public function getBackup_dateAdded() {
        return $this->backup_dateAdded;
    }

    /**
     * @param field_type $backup_dateAdded
     */
    public function setBackup_dateAdded($backup_dateAdded) {
        $this->backup_dateAdded = $backup_dateAdded;
    }

    /**
     * @return the $backup_dateUpdated
     */
    public function getBackup_dateUpdated() {
        return $this->backup_dateUpdated;
    }

    /**
     * @param string $backup_dateUpdated
     */
    public function setBackup_dateUpdated($backup_dateUpdated) {
        $this->backup_dateUpdated = $backup_dateUpdated;
    }


    public function getListeBackup(){
        $objDb = new $this->_myDbClassName; /* @var $objDb Db_Backup */

        $select = $objDb->mySelectBuild();
        $select->order("backup_dateAdded DESC");
        $select->limit(50);

        return $this->getListe(false,$select);
    }


    public function purgeBackup($type){
        require_once ('App/Utils.php');
        switch ($type) {
            case self::BACKUP_TYPE_BDD:
                $rep = ParamCustom::param('BACKUP.PATH_DB', 'FRAMEWORK');
                $rep = Zend_Path::normalizePath($rep);
                $heures = ParamCustom::param('BACKUP.EXPIRE_DB', 'FRAMEWORK');
                break;
            case self::BACKUP_TYPE_FILES:
                $rep = ParamCustom::param('BACKUP.PATH_SITE', 'FRAMEWORK');
                $rep = Zend_Path::normalizePath($rep);
                $heures = ParamCustom::param('BACKUP.EXPIRE_FILES', 'FRAMEWORK');
                break;

            default:
                ;
            break;
        }
        // Sécurité : il faut qu'il y ait backup dans le chemin
        $pos = strpos($rep, "backup");

        if($rep && ($pos !== false)){
            Zend_Debug::dump($rep,'delete');
            my_CleanFolder($rep,$heures,"none",true);
        }else{
            throw new App_Exception("Attention, le chemin de sauvegarde '.$rep.' doit contenir le mot 'backup'");
        }
    }

    public function backupBdd(){
        require_once ('App/Utils.php');
        $this->setBackup_type(self::BACKUP_TYPE_BDD);
        $this->setBackup_state(self::BACKUP_STATE_START);
        $this->save(true);
        set_time_limit(0);
        $res = "";
        $dbAdapter = Zend_Registry::get('dbAdapter');
        $config = $dbAdapter->getConfig();

        $backupPath = ParamCustom::param('BACKUP.PATH_DB', 'FRAMEWORK');

        $destination = $backupPath ."/". date("Y-m-d_H-i-s")."-".$config['dbname'];
        $destination = Zend_Path::normalizePath($destination);
        @mkdir($destination,0777,true);

        // Sécurité : il faut qu'il y ait backup dans le chemin
        $pos = strpos($destination, "backup");

        if($destination && ($pos !== false)){

            $this->setBackup_state(self::BACKUP_STATE_DUMP);
            $this->save(true);
            $rowset = $dbAdapter->fetchAll( "SHOW TABLES" );
            foreach ( $rowset as $row ){
                /** Optimizamos la tabla */
                $query = "OPTIMIZE TABLE " . $row['Tables_in_' . $config['dbname'] ] ;
                $dbAdapter->query( $query );
                $path = $destination . "/{$row['Tables_in_' . $config['dbname'] ]}-" . date("Y-m-d_H-i-s") . ".sql" ;

                /** Génération du dump de la table */
                $cmdDump = ParamCustom::param('PATH.MYSQLDUMP', 'FRAMEWORK')." --opt -u {$config['username']} -p{$config['password']} -h {$config['host']} {$config['dbname']} {$row['Tables_in_' . $config['dbname'] ]} > $path ";
                $res .= system( $cmdDump );
                Zend_Debug::dump($cmdDump);
            }

            $this->setBackup_state(self::BACKUP_STATE_COMPRESS);
            $this->setBackup_path($destination.".tar.gz");
            $this->save(true);
            // Compression du répertoires */
            $cmdTar = ParamCustom::param('PATH.TAR', 'FRAMEWORK')." zcf {$destination}.tar.gz {$destination}";
            $res .= system( $cmdTar );
            Zend_Debug::dump($cmdTar);
            // Suppression du répertoire
            my_Remover($destination,"dir");

            $size = filesize($this->getBackup_path());
            Zend_Debug::dump($size);
            $this->setBackup_size($size);
            $this->setBackup_state(self::BACKUP_STATE_FINISHED);
            $this->save(true);

            Zend_Debug::dump($res);
        }else{
            throw new App_Exception("Attention, le chemin de sauvegarde '.$destination.' doit contenir le mot 'backup'");
        }

        echo "ndone!nn";
    }

    public function backupFiles(){
        require_once ('App/Utils.php');
        $this->setBackup_type(self::BACKUP_TYPE_FILES);
        $this->setBackup_state(self::BACKUP_STATE_START);
        $this->save(true);
        set_time_limit(0);
        $res = "";

        $source = Zend_Path::normalizePath(ROOT_PATH);
        $repName = basename($source);

        $backupPath = ParamCustom::param('BACKUP.PATH_SITE', 'FRAMEWORK');
        $backupPath = Zend_Path::normalizePath($backupPath);
        $destination = $backupPath ."/". date("Y-m-d_H-i-s")."-".$repName;
        $destination = Zend_Path::normalizePath($destination);
        @mkdir($backupPath,0777,true);

        // Sécurité : il faut qu'il y ait backup dans le chemin
        $pos = strpos($backupPath, "backup");

        if($backupPath && ($pos !== false)){

            $this->setBackup_state(self::BACKUP_STATE_COMPRESS);
            $this->setBackup_path($destination.".tar.gz");
            $this->save(true);
            // Compression du répertoires */
            $cmdTar = ParamCustom::param('PATH.TAR', 'FRAMEWORK')." zcf {$destination}.tar.gz {$source}";
            Zend_Debug::dump($cmdTar);
            $res .= system( $cmdTar );

            $size = filesize($this->getBackup_path());
            Zend_Debug::dump($size);
            $this->setBackup_size($size);
            $this->setBackup_state(self::BACKUP_STATE_FINISHED);
            $this->save(true);

            Zend_Debug::dump($res);

        }else{
            throw new App_Exception("Attention, le chemin de sauvegarde '.$backupPath.' doit contenir le mot 'backup'");
        }

        echo "ndone!nn";

    }

    public function getDuration(){
        $dateAdded = new Zend_Date($this->getBackup_dateAdded(),Zend_Date::ISO_8601);
        $dateUpdated = new Zend_Date($this->getBackup_dateUpdated(),Zend_Date::ISO_8601);
        $diff = $dateUpdated->sub($dateAdded)->toValue();
        $measureTime = new App_Time_Interval($diff,Zend_Measure_Time::SECOND,Zend_Registry::get('Zend_Locale'));
        return $measureTime;
    }

}