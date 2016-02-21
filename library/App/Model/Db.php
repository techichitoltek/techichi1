<?php

class App_Model_Db extends Zend_Db_Table_Abstract{

    protected $_name = "";
    protected $_primary = "";

    public $_myDbClassName       = "";
    public $_myDbPrimary         = "";
    public $_myMetierClassName   = "";
    public $_myDbTableName       = "";
    public $_myDbFieldPrefix     = "";

    public $_myDateUpdatedField  = "";
    public $_myDateAddedField    = "";

    public function __construct($config = array())
    {
        $this->_name = $this->_myDbTableName;
        $this->_primary = $this->_myDbPrimary;
        parent::__construct($config);
        if($this->_myDbFieldPrefix){
            $this->_myDateAddedField = $this->_myDbFieldPrefix . "_dateAdded";
            $this->_myDateUpdatedField = $this->_myDbFieldPrefix . "_dateUpdated";
        }
    }

    public function mySelectBuild(){
        $select = $this->select()->setIntegrityCheck(false);
        return $select;
    }

    public function mySelectEmpty(){
        $select = $this->select()->setIntegrityCheck(false);
        $select->reset(Zend_Db_Select::FROM);
        $select->reset(Zend_Db_Select::COLUMNS);
        return $select;
    }

    public function Db_save($objet,$change){
        $id = $objet->{$this->_myDbPrimary};
        $info = $this->info();

        foreach($info["cols"] as $col){
            if($col != $this->_myDbPrimary /*&& $col != $this->_myDateAddedField*/ && $col != $this->_myDateUpdatedField)
            $data[$col] = $objet->{$col};
        }

        if($id){
            $where = $this->getAdapter()->quoteInto($this->_myDbPrimary.' = ?', $id);
            $res = $this->update($data, $where);
            if(!$res){
               $row = $this->find($id);
               if($row->count() == 0){
                   if($this->_myDateAddedField) $data[$this->_myDateAddedField] = date('Y-m-d H:i:s');
                   $data[$this->_myDbPrimary] = $id;
                   $id = $this->insert($data);
               }else{
                   // Erreur update
               }
            }
        }else{
            $data[$this->_myDateAddedField] = date('Y-m-d H:i:s');
            $id = $this->insert($data);
        }
        return $id;
    }

    public function Db_delete($objet){
        $id = $objet->{$this->_myDbPrimary};
        $nbDeleted = 0;
        if($id){
            $where = $this->getAdapter()->quoteInto($this->_myDbPrimary.' = ?', $id);
            $nbDeleted = $this->delete($where);
        }
        return $nbDeleted;
    }

    public function _cascadeDelete($parentTableClassname, array $primaryKey) {
        // TODO: Auto-generated method stub

    }

     /**
      * Exécute une requete et retourne les résultats (pour les select,...)
      *
      * @param $sql string
      * @return Array
      */
    public function Db_query($sql){
        // Initialisation du registre
        $registry = Zend_Registry::getInstance();
        $db = $registry->get("dbAdapter"); /* @var $db Zend_Db_Table */

        $stmt = $db->query($sql); /* @var $stmt Zend_Db_Statement_Pdo */
        $res = $stmt->fetchAll();
        return $res;
    }

    /**
     * Execute la requete (pour les requete sans retour : delete, insert,...)
     *
     * @param $sql string
     * @return bool
     */
    public function Db_execute($sql){
        // Initialisation du registre
        $registry = Zend_Registry::getInstance();
        $db = $registry->get("dbAdapter"); /* @var $db Zend_Db_Adapter_Pdo_Mysql */

        $stmt = $db->query($sql); /* @var $stmt Zend_Db_Statement_Pdo */
        return $stmt;
    }

    public function Db_duplicate($name){
        $res = $this->Db_query("SHOW CREATE TABLE `".$this->_myDbTableName."`;");
        //Zend_Debug::dump($res);exit;
        //$sql = $res['Create Table']; // Mode sans PDO
        $sql = $res[0]['Create Table']; // Mode avec PDO
        try {
            $sql = str_replace("CREATE TABLE `".$this->_myDbTableName."`", "CREATE TABLE `".$name."`", $sql);
            $this->Db_query($sql);
        } catch (Exception $e) {
            //Zend_Debug::dump("Create Table");
            //Zend_Debug::dump($e);
        }
        try {
            $sqlDatas = "INSERT INTO `".$name."` SELECT * FROM `".$this->_myDbTableName."`";
            $this->Db_query($sqlDatas);
        } catch (Exception $e) {
            //Zend_Debug::dump("Inserts");
            //Zend_Debug::dump($e);
        }
        //Zend_Debug::dump($sqlDatas);exit();
    }

    /**
     * Delete multiple rows
     */
    function Db_deleteMultiple($array_ids)
    {
        if( !is_array($array_ids) )
        {
            throw new Exception('Paramètre n\'est pas un tableau pour la suppression multiple !');
        }

        // Filters values by removing not numeric ID - Assume all primary key are numeric
        $array_ids = array_filter($array_ids, array($this, 'isNumeric'));

        // No value key found
        if( !count($array_ids) )
        {
            return 0;
        }

        // Exec delete query
        $rows_affected = $this->delete($this->_myDbPrimary . ' IN (' . implode(',', $array_ids) .')');

        return $rows_affected;
    }

    /**
     * Update multiple rows
     */
    function Db_saveMultiple($array_ids, $values)
    {
        if( !is_array($array_ids) )
        {
            throw new Exception('Paramètre n\'est pas un tableau pour la sauvegarde multiple !');
        }

        // Filters values by removing not numeric ID - Assume all primary key are numeric
        $array_ids = array_filter($array_ids, array($this, 'isNumeric'));

        // No valid key found
        if( !count($array_ids) )
        {
            return 0;
        }

        // Exec update query
        $rows_affected = $this->update($values, $this->_myDbPrimary . ' IN (' . implode(',', $array_ids) .')');

        return $rows_affected;
    }

    private function isNumeric($item){
        return is_numeric($item);
    }
}