<?PHP


/**
 * Mettre le nom de la table en base de données
 *
 */
define("CL_PARAMDEFAULT_TABLE_NAME","zf_paramdefault");
class ParamDefault extends Zend_Db_Table{

    protected $_name = CL_PARAMDEFAULT_TABLE_NAME;
    protected $_primary = 'paramdefault_Id';

    protected $paramdefault_Id;
    protected $paramdefault_Name;
    protected $paramdefault_Scope;
    protected $paramdefault_Value;
    protected $paramdefault_Commentaire;
    protected $paramdefault_Type;
    protected $paramdefault_LevelAccess;

    /**
     * Constructeur
     *
     */
    function ParamDefault(){
        parent::__construct();

         $this->paramdefault_Id 			= 0;
         $this->paramdefault_Name 			= "";
         $this->paramdefault_Scope 			= "";
         $this->paramdefault_Value 			= "";
         $this->paramdefault_Commentaire 	= "";
         $this->paramdefault_Type 			= 0;
         $this->paramdefault_LevelAccess	= 0;
    }

    function setParamDefault_Id($param){
        $this->paramdefault_Id = $param;
    }
    function getParamDefault_Id(){
        return $this->paramdefault_Id;
    }

    function setParamDefault_Name($param){
        $this->paramdefault_Name = $param;
    }
    function getParamDefault_Name(){
        return $this->paramdefault_Name;
    }

    function setParamDefault_Scope($param){
        $this->paramdefault_Scope = $param;
    }
    function getParamDefault_Scope(){
        return $this->paramdefault_Scope;
    }

    function setParamDefault_Value($param){
        $this->paramdefault_Value = $param;
    }
    function getParamDefault_Value(){
        return $this->paramdefault_Value;
    }

    function setParamDefault_Commentaire($param){
        $this->paramdefault_Commentaire = $param;
    }
    function getParamDefault_Commentaire(){
        return $this->paramdefault_Commentaire;
    }

    function setParamDefault_Type($param){
        $this->paramdefault_Type = $param;
    }
    function getParamDefault_Type(){
        return $this->paramdefault_Type;
    }

    function setParamDefault_LevelAccess($param){
        $this->paramdefault_LevelAccess = $param;
    }
    function getParamDefault_LevelAccess(){
        return $this->paramdefault_LevelAccess;
    }


    /**
     * Cette fonction initialise un objet ParmDefault à partir du résultat d'une requête
     *
     * @param array $form
     */
    function setParamDefaultFromTab($form){
        $this->setParamDefault_Id(($form['paramdefault_Id']));
        $this->setParamDefault_Name($form['paramdefault_Name']);
        $this->setParamDefault_Scope($form['paramdefault_Scope']);
        $this->setParamDefault_Value($form['paramdefault_Value']);
        $this->setParamDefault_Commentaire($form['paramdefault_Commentaire']);
        $this->setParamDefault_Type($form['paramdefault_Type']);
        $this->setParamDefault_LevelAccess($form['paramdefault_LevelAccess']);
    }


    /**
     * Chargement d'un ParamDefault
     *
     * @param identifiant unique du paramdefault $paramId
     * @return object de type ParamDefault
     */
    function loadParamDefault($paramId){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = $this->_name;
        $select = $db->select()
                     ->from($tableName)
                     ->where($db->quoteInto("paramdefault_Id = ?",$paramId));
        /* DEBUG
        $sql = $select->__toString();
        echo "$sql\n";
        /**/

        $stmt = $select->query();
        $rows = $stmt->fetch();
        $this->setParamDefaultFromTab($rows);
    }

    /**
     * Chargement d'un ParamDefault
     *
     * @param nom du parametre
     * @param scope du parametre $paramId
     * @return object de type ParamDefault
     */
    function loadParamDefaultByName($paramName,$paramScope){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = $this->_name;
        $select = $db->select()
                     ->from($tableName)
                     ->where($db->quoteInto("paramdefault_Name = ?",$paramName))
                     ->where($db->quoteInto("paramdefault_Scope = ?",$paramScope));
        /* DEBUG
        $sql = $select->__toString();
        echo "$sql\n";
        /**/

        $stmt = $select->query();
        $rows = $stmt->fetch();
        $this->setParamDefaultFromTab($rows);
    }


    /**
     * Teste l'existence d'un ParamDefault
     *
     * @param identifiant unique du PAramDefault à tester $primaryKey
     * @return boolean
     */
    static function existsParamDefault($primaryKey){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = CL_PARAMDEFAULT_TABLE_NAME;
        $select = $db->select()
                     ->from($tableName)
                     ->where("paramdefault_Id = ".$primaryKey);
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



    function saveParamDefault(){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = $this->_name;
        if($this->paramdefault_Id != 0 && ParamDefault::existsParamDefault($this->paramdefault_Id)){
            $db->beginTransaction();
            try {
                // On update
                break;
                $data = array(
                    'paramdefault_Name'			=>	html_entity_decode($this->paramdefault_Name,null,"ISO-8859-1"),
                    'paramdefault_Scope'		=>	html_entity_decode($this->paramdefault_Scope,null,"ISO-8859-1"),
                    'paramdefault_Value'		=>	html_entity_decode($this->paramdefault_Value,null,"ISO-8859-1"),
                    'paramdefault_Commentaire'	=>	html_entity_decode($this->paramdefault_Commentaire,null,"ISO-8859-1"),
                    'paramdefault_Type'			=>	$this->paramdefault_Type,
                    'paramdefault_LevelAccess'	=>	$this->paramdefault_LevelAccess
                );
                $where = array("paramdefault_Id = ?",$this->paramdefault_Id);
                $db->update($tableName,$data,$where);
                /* DEBUG
                /**/
                $db->commit();
                $paramdefault_Id = $this->paramdefault_Id;
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
                    'paramdefault_Name'			=>	html_entity_decode($this->paramdefault_Name,null,"ISO-8859-1"),
                    'paramdefault_Scope'		=>	html_entity_decode($this->paramdefault_Scope,null,"ISO-8859-1"),
                    'paramdefault_Value'		=>	html_entity_decode($this->paramdefault_Value,null,"ISO-8859-1"),
                    'paramdefault_Commentaire'	=>	html_entity_decode($this->paramdefault_Commentaire,null,"ISO-8859-1"),
                    'paramdefault_Type'			=>	$this->paramdefault_Type,
                    'paramdefault_LevelAccess'	=>	$this->paramdefault_LevelAccess
                );
                $db->insert($tableName,$data);
                $paramdefault_Id = $db->lastInsertId();
                $this->paramdefault_Id	=	$paramdefault_Id;
                /* DEBUG
                /**/
                $db->commit();
            }catch (Exception $e) {
                $db->rollBack();
                echo $e->getMessage();
                return false;
            }
            $paramdefault = new ParamDefault();
            $paramdefault->loadParamDefault($this->paramdefault_Id);
            return $paramdefault;
        }
        return false;
    }

    static function tabParamDefault(){
        $db = Zend_Registry::get('dbAdapter');

        $db->query('SET NAMES UTF8');
        $tableName = CL_PARAMDEFAULT_TABLE_NAME;
        $select = $db->select()
                     ->from($tableName);
        /* DEBUG
        $sql = $select->__toString();
        echo "$sql\n";
        /**/

        $stmt = $select->query();
        $rows = $stmt->fetchAll();

        $return	=	array();

        foreach($rows as $paramDefault){
            $currentParamDefault = new ParamDefault();
            $currentParamDefault->loadParamDefault($paramDefault['paramdefault_Id']);
            $return[$paramDefault['paramdefault_Id']] = $currentParamDefault;
        }

        return $return;
    }

}
