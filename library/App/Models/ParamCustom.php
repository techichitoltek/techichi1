<?PHP


/**
 * Mettre le nom de la table en base de données
 *
 */
define("CL_PARAMCUSTOM_TABLE_NAME","zf_paramcustom");
class ParamCustom extends Zend_Db_Table{

    public static $indexKey = 'paramCustom';

    private static $instance;    // Un constructeur privé ; empêche la création directe d'objet

    private static $counter = 0;

    protected $_name = CL_PARAMCUSTOM_TABLE_NAME;
    protected $_primary = 'paramcustom_Id';

    protected $paramcustom_Id;
    protected $paramcustom_SiteId;
    protected $paramcustom_DefaultId;
    protected $paramcustom_Name;
    protected $paramcustom_Scope;
    protected $paramcustom_Value;
    protected $paramcustom_LevelAccess;
    protected $paramDefault;

    protected static $_currentParams = null;

    // La méthode singleton
    public static function singleton(){
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    // Exemple d'une méthode
    public function bark(){
        echo 'Woof!';
    }

    // Prévient les utilisateurs sur le clônage de l'instance
    public function __clone(){
        trigger_error('Le clônage n\'est pas autorisé.', E_USER_ERROR);
    }

    /**
     * Constructeur
     *
     */
    private function ParamCustom(){
        parent::__construct();
         $this->paramcustom_Id 			= 0;
         $this->paramcustom_SiteId		= 0;
         $this->paramcustom_DefaultId	= 0;
         $this->paramcustom_Name 		= "";
         $this->paramcustom_Scope 		= "";
         $this->paramcustom_Value 		= "";
         $this->paramcustom_LevelAccess = 0;
         $this->paramDefault = new ParamDefault();
    }

    function setParamCustomId($id){
        $this->paramcustom_Id	=	$id;
    }
    function getParamCustomId(){
        return $this->paramcustom_Id;
    }

    function setParamCustomSiteId($id){
        $this->paramcustom_SiteId	=	$id;
    }
    function getParamCustomSiteId(){
        return $this->paramcustom_SiteId;
    }

    function setParamCustomName($param){
        $this->paramcustom_Name	=	$param;
    }
    function getParamCustomName(){
        return $this->paramcustom_Name;
    }

    function setParamCustomScope($scope){
        $this->paramcustom_Scope = $scope;
    }
    function getParamCustomScope(){
        return $this->paramcustom_Scope;
    }

    function setParamCustomValue($param){
        $this->paramcustom_Value	=	$param;
    }
    function getParamCustomValue(){
        return $this->paramcustom_Value;
    }

    function setParamCustomLevelAccess($param){
        $this->paramcustom_LevelAccess	=	$param;
    }
    function getParamCustomLevelAccess(){
        return $this->paramcustom_LevelAccess;
    }

    function setParamDefault($param){
        $this->paramDefault	=	$param;
    }
    function getParamDefault(){
        return $this->paramDefault;
    }

    function setParamDefaultId($param){
        $this->paramcustom_DefaultId	=	$param;
    }
    function getParamDefaultId(){
        return $this->paramcustom_DefaultId;
    }


    /**
     * Cette fonction initialise un objet ParamCustom à partir du résultat d'une requête
     *
     * @param array $form
     */
    function setParamCustomFromTab($form){
        $this->setParamCustomId($form['paramcustom_Id']);
        $this->setParamCustomSiteId($form['paramcustom_SiteId']);
        $this->setParamCustomName($form['paramcustom_Name']);
        $this->setParamCustomScope($form['paramcustom_Scope']);
        $this->setParamCustomValue($form['paramcustom_Value']);
        $this->setParamCustomLevelAccess($form['paramcustom_LevelAccess']);
        $paramDefault = new ParamDefault();
        $paramDefault->loadParamDefaultByName($this->getParamCustomName(),$this->getParamCustomScope());
        $this->setParamDefault($paramDefault);
        $this->setParamDefaultId($paramDefault->getParamDefault_Id());
    }

    /**
     * Chargement d'un ParamCustom
     *
     * @param identifiant unique du paramcustom $paramId
     * @return object de type ParamCustom
     */
    function loadParamCustom($paramId){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = $this->_name;
        $select = $db->select()
                     ->from($tableName)
                     ->where($db->quoteInto("paramcustom_Id = ?",$paramId));
        /* DEBUG
        $sql = $select->__toString();
        echo "$sql\n";
        /**/

        $stmt = $select->query();
        $rows = $stmt->fetch();
        $this->setParamCustomFromTab($rows);
    }


    /**
     * Teste l'existence d'un ParamCustom
     *
     * @param identifiant unique du ParamCustom à tester $primaryKey
     * @return boolean
     */
    static function existsParamCustom($primaryKey){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = CL_PARAMCUSTOM_TABLE_NAME;
        $select = $db->select()
                     ->from($tableName)
                     ->where("paramcustom_Id = ".$primaryKey);
        /* DEBUG
        $sql = $select->__toString();
        echo "$sql\n";
        /**/

        $stmt = $select->query();
        $rows = $stmt->fetch();
        if($rows==null){
            return false;
        }else{
            return true;
        }
    }


    function saveParamCustom(){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = $this->_name;
        if($this->paramcustom_Id != 0 && ParamCustom::existsParamCustom($this->paramcustom_Id)){
            $db->beginTransaction();
            try {
                // On update
                break;
                $data = array(
                    'paramcustom_SiteId'		=>	$this->getParamCustomSiteId(),
                    'paramcustom_Name'			=>	html_entity_decode($this->getParamCustomName(),null,"ISO-8859-1"),
                    'paramcustom_Scope'			=>	html_entity_decode($this->getParamCustomScope(),null,"ISO-8859-1"),
                    'paramcustom_Value'			=>	html_entity_decode($this->getParamCustomValue(),null,"ISO-8859-1"),
                    'paramcustom_LevelAccess'	=>	$this->getParamCustomLevelAccess()
                );
                $where = array("paramcustom_Id = ".$this->paramcustom_Id);
                $db->update($tableName,$data,$where);
                /* DEBUG
                /**/
                $db->commit();
                $paramcustom_Id = $this->paramcustom_Id;
            }catch (Exception $e) {
                $db->rollBack();
                echo $e->getMessage();
                return false;
            }
        }else{
            $db->beginTransaction();
            try {
            // On insert
                $data = array(
                    'paramcustom_SiteId'		=>	$this->getParamCustomSiteId(),
                    'paramcustom_Name'			=>	html_entity_decode($this->getParamCustomName(),null,"ISO-8859-1"),
                    'paramcustom_Scope'			=>	html_entity_decode($this->getParamCustomScope(),null,"ISO-8859-1"),
                    'paramcustom_Value'			=>	html_entity_decode($this->getParamCustomValue(),null,"ISO-8859-1"),
                    'paramcustom_LevelAccess'	=>	$this->getParamCustomLevelAccess()
                );
                $db->insert($tableName,$data);
                $paramcustom_Id = $db->lastInsertId();
                $this->paramcustom_Id	=	$paramcustom_Id;
                /* DEBUG
                /**/
                $db->commit();
            }catch (Exception $e) {
                $db->rollBack();
                echo $e->getMessage();
                return false;
            }
        }
        if($this->paramcustom_Id){
            $paramcustom = new ParamCustom();
            $paramcustom->loadParamCustom($this->paramcustom_Id);
            return $paramcustom;
        }
        return false;
    }





    static function listParamCustomBySite($siteId, $scope=""){
        $db = Zend_Registry::get('dbAdapter');

        $db->query('SET NAMES UTF8');
        $tableName = CL_PARAMCUSTOM_TABLE_NAME;
            $select = $db->select()
                     ->from($tableName)
                     ->where("paramcustom_SiteId = ".$siteId)
                     ->order(array("paramcustom_Id"));
        if ($scope) {
            $select->where($db->quoteInto("paramcustom_Scope = ?",$scope));
        }

        /**
        $sql = $select->__toString();
        echo "$sql\n";exit();
        /**/

        $stmt = $select->query();
        $rows = $stmt->fetchAll();

        $return	=	array();
        foreach($rows as $ParamCustom){
            $currentParamCustom = new ParamCustom();
            $currentParamCustom->loadParamCustom($ParamCustom['paramcustom_Id']);
            $return[$currentParamCustom->getParamDefaultId()] = $currentParamCustom;
        }
        return $return;
    }
    /*
    static function getParamCustomBySite($siteId){
        $db = Zend_Registry::get('dbAdapter');

        $db->query('SET NAMES UTF8');
        $tableName = CL_PARAMCUSTOM_TABLE_NAME;
            $select = $db->select()
                     ->from($tableName)
                     ->where("paramcustom_SiteId = ".$siteId)
                     ->order(array("paramcustom_Id"));

        $stmt = $select->query();
        $rows = $stmt->fetchAll();

        $return	=	array();

        foreach($rows as $ParamCustom){
            $return[$ParamCustom['paramcustom_Scope']][$ParamCustom['paramcustom_Name']] = $ParamCustom;
        }
        return $return;
    }
    */

    static function getAllParamCustom(){
        $db = Zend_Registry::get('dbAdapter');

        $db->query('SET NAMES UTF8');
        $tableName = CL_PARAMCUSTOM_TABLE_NAME;
        $select = $db->select()
        ->from($tableName)
        ->order(array("paramcustom_Id"));

        /**
         $sql = $select->__toString();
         echo "$sql\n";exit();
        /**/

        $stmt = $select->query();
        $rows = $stmt->fetchAll();

        $return	=	array();

        foreach($rows as $ParamCustom){
            $return[$ParamCustom['paramcustom_SiteId']][$ParamCustom['paramcustom_Scope']][$ParamCustom['paramcustom_Name']] = $ParamCustom;
        }
        return $return;
    }

    static function paramCheckIntegrite(){
        $db = Zend_Registry::get('dbAdapter');

        $db->query('SET NAMES UTF8');
        $tableName = CL_PARAMCUSTOM_TABLE_NAME;

        // Récupération de la liste des mails par défaut de la table maildefault
        $tabParamDefault = ParamDefault::tabParamDefault();

        // Récupération de la liste des sites

        $portail = new Portail();
        $listSite = $portail->getListe();

        foreach($listSite as $site){ /* @var $site Portail */
            // Récupération de la liste des parametres customisés de l'entité
            $tabParamCustom = ParamCustom::listParamCustomBySite($site->getPortail_id());
            foreach($tabParamDefault as $paramDefault){
                // On parcourt les param par défaut et on regarde si on a un param personnalisé
                if(!array_key_exists($paramDefault->getParamDefault_Id(),$tabParamCustom)){
                    //Sinon, on crée l'entrée
                    $newParamCustom = new ParamCustom();
                    $newParamCustom->createParamCustomFromDefault($paramDefault->getParamDefault_Id(),$site->getPortail_id());
                }
            }
        }
    }

    function createParamCustomFromDefault($paramDefaultId,$siteId){

        // R�cup�ration du param par d�faut
        $paramDefault = new ParamDefault();
        $paramDefault->loadParamDefault($paramDefaultId);

        // On initialise les valeurs
        $paramCustom = new ParamCustom();
        $paramCustom->setParamCustomSiteId($siteId);
        $paramCustom->setParamCustomName($paramDefault->getParamDefault_Name());
        $paramCustom->setParamCustomScope($paramDefault->getParamDefault_Scope());
        $paramCustom->setParamCustomValue($paramDefault->getParamDefault_Value());
        $paramCustom->setParamCustomLevelAccess($paramDefault->getParamDefault_LevelAccess());

        $paramCustom->saveParamCustom();
    }

    static function param($paramName, $paramScope = null, $tabParam = array()){
        if(self::$_currentParams == null){
            // On tente de charger les Params depuis le cache
            self::load();
        }
        if(is_null($paramScope)){
            $paramScope = strtoupper(CURRENT_MODULE);
        }
        $paramValue = "";

        if(self::$_currentParams != null && array_key_exists($paramScope, self::$_currentParams) && array_key_exists($paramName, self::$_currentParams[$paramScope])){
            $paramValue = self::$_currentParams[$paramScope][$paramName]['paramcustom_Value'];
        }else{
            throw new App_Exception('Paramétrage manquant pour ' . print_r($paramName .'/'.$paramScope,true));
        }

        if(is_array($tabParam) && count($tabParam)){
            // Remplacement des tokens par les valeurs
            foreach ($tabParam as $key => $value){
                $paramValue = str_replace("##$key##",$value,$paramValue);
            }
        }

        return $paramValue;

    }

    static function portailParam($portailId,$paramName, $paramScope){
        self::loadAll();
        $params = Zend_Registry::get("allParams");

        $paramValue = "Paramétrage manquant !";

        if($params != null && array_key_exists($paramScope, $params[$portailId]) && array_key_exists($paramName, $params[$portailId][$paramScope])){
            $paramValue = $params[$portailId][$paramScope][$paramName]['paramcustom_Value'];
        }else{
            //throw new App_Exception('Paramétrage manquant pour ' . print_r($paramName .'/'.$paramScope,true));
        }

        return $paramValue;

    }


    /**
     * Generate the Acl object from the permission file
     *
     * @return Zend_Acl
     */
    private static function _generateFromDb(){
        ParamCustom::paramCheckIntegrite();
        self::$_currentParams = self::getAllParamCustom();
        //self::$_currentAllParams = self::getAllParamCustom();
        return self::$_currentParams;
    }

    /**
     * Load the Params to the Registry if is not there
     *
     * This function takes care about generating the Params from the db
     * if the info is not in the registry and/or cache.
     *
     * If the params is inside the cache we load it from there.
     *
     * @return void
     */
    public static function load(){
        if(!ParamCustom::_checkIfExist()){
            if(!$params = ParamCustom::_getFromCache()){
                $params = ParamCustom::_generateFromDb();
                ParamCustom::_storeInCache($params);
            }

            ParamCustom::_storeInRegistry($params[Zend_Registry::get('PortailId')]);
            ParamCustom::$_currentParams = $params[Zend_Registry::get('PortailId')];
        }
    }

    /**
     * Load the Params to the Registry if is not there
     *
     * This function takes care about generating the Params from the db
     * if the info is not in the registry and/or cache.
     *
     * If the params is inside the cache we load it from there.
     *
     * @return void
     */
    public static function loadAll(){
        if(!Zend_Registry::isRegistered("allParams")){
            $params = ParamCustom::_generateFromDb();
            Zend_Registry::set("allParams", $params);
        }
    }

    /**
     * Regenerate the Params from the DB and update the cache and Zend_Registry
     *
     * @return boolean
     */
    public static function save(){
        $params = ParamCustom::_generateFromDb();
        ParamCustom::_storeInCache($params);
        ParamCustom::_storeInRegistry($params[Zend_Registry::get("PortailId")]);
    }

    /**
     * Check if the Params exists in Zend_Registry
     *
     * @return boolean
     */
    private static function _checkIfExist(){
        return Zend_Registry::isRegistered(ParamCustom::$indexKey);
    }

    /**
     * Get Params from Registry
     *
     * @return void
     */
    private static function _getFromRegistry(){
        if(ParamCustom::_checkIfExist()){
            return Zend_Registry::get(ParamCustom::$indexKey);
        }

        return FALSE;
    }

    /**
     * Retrieve the Params from the cache
     *
     * @return ParamCustom | boolean
     */
    private static function _getFromCache(){
        $cacheHandler = App_DI_Container::get('CacheManager')->getCache('default');

        if($params = $cacheHandler->load(ParamCustom::$indexKey)){
            return $params;
        }

        return FALSE;
    }

    /**
     * Store the Params in the cache
     *
     * @return void
     */
    private static function _storeInCache($params = NULL){
        if(is_null($params) && ParamCustom::_checkIfExist()){
            $params = ParamCustom::_getFromRegistry();
        }

        if(empty($params)){
            try {
                ParamCustom::paramCheckIntegrite();
            } catch (Exception $e) {
                throw new Exception('You must provide a valid Params in order to store it');
            }
        }

        $cacheHandler = App_DI_Container::get('CacheManager')->getCache('default');

        $cacheHandler->save($params, ParamCustom::$indexKey);
    }

    /**
     * Store the Params in the Registry
     *
     * @return void
     */
    private static function _storeInRegistry($params){
        Zend_Registry::set(ParamCustom::$indexKey, $params);
    }

}
