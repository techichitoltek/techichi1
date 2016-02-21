<?php
class App_Model_Std{

    const INVALID_PROPERTY = 'Invalid property';
    const INSERTED         = 1; // Last save() call was an insertion
    const UPDATED          = 2; // Last save() call was an update
    const DELETED          = 3; // Record deleted

    public $_myDbClassName       = "";
    public $_myDbPrimary         = "";
    public $_myMetierClassName   = "";
    public $_myDbTableName       = "";
    public $_myDbFieldPrefix     = "";

    public $_saved               = null;    // Flag if object was inserted or updated on last save call

    public $_messageTemplates    = array(
            self::INSERTED    => 'Le nouvel enregistrement a été ajouté',
            self::UPDATED     => 'L\'enregistrement a été modifié',
            self::DELETED     => 'L\'enregistrement a été supprimé',
    );

    protected $_useCleanData     = false; // active or desactive cleanData
    protected $_cleanData        = array(); // data same as loaded from database

    /**
     * mapping taken from http://forums.mysql.com/read.php?52,255868,255895#msg-255895
     */
    static public $mysqli_type = array(
    		0 => "MYSQLI_TYPE_DECIMAL",
    		1 => "MYSQLI_TYPE_TINYINT",
    		2 => "MYSQLI_TYPE_SMALLINT",
    		3 => "MYSQLI_TYPE_INTEGER",
    		4 => "MYSQLI_TYPE_FLOAT",
    		5 => "MYSQLI_TYPE_DOUBLE",
    		7 => "MYSQLI_TYPE_TIMESTAMP",
    		8 => "MYSQLI_TYPE_BIGINT",
    		9 => "MYSQLI_TYPE_MEDIUMINT",
    		10 => "MYSQLI_TYPE_DATE",
    		11 => "MYSQLI_TYPE_TIME",
    		12 => "MYSQLI_TYPE_DATETIME",
    		13 => "MYSQLI_TYPE_YEAR",
    		14 => "MYSQLI_TYPE_DATE",
    		16 => "MYSQLI_TYPE_BIT",
    		246 => "MYSQLI_TYPE_DECIMAL",
    		247 => "MYSQLI_TYPE_ENUM",
    		248 => "MYSQLI_TYPE_SET",
    		249 => "MYSQLI_TYPE_TINYBLOB",
    		250 => "MYSQLI_TYPE_MEDIUMBLOB",
    		251 => "MYSQLI_TYPE_LONGBLOB",
    		252 => "MYSQLI_TYPE_BLOB",
    		253 => "MYSQLI_TYPE_VARCHAR",
    		254 => "MYSQLI_TYPE_CHAR",
    		255 => "MYSQLI_TYPE_GEOMETRY",
    );

    // Build an associative array for a type look up
    static $mysqli_to_php = array(
    		"MYSQLI_TYPE_DECIMAL"     => 'float',
    		"MYSQLI_TYPE_NEWDECIMAL"  => 'float',
    		"MYSQLI_TYPE_BIT"         => 'integer',
    		"MYSQLI_TYPE_TINYINT"     => 'integer',
    		"MYSQLI_TYPE_SMALLINT"    => 'integer',
    		"MYSQLI_TYPE_MEDIUMINT"   => 'integer',
    		"MYSQLI_TYPE_BIGINT"      => 'integer',
    		"MYSQLI_TYPE_INTEGER"     => 'integer',
    		"MYSQLI_TYPE_FLOAT"       => 'float',
    		"MYSQLI_TYPE_DOUBLE"      => 'float',
    		"MYSQLI_TYPE_NULL"        => 'null',
    		"MYSQLI_TYPE_TIMESTAMP"   => 'string',
    		"MYSQLI_TYPE_INT24"       => 'integer',
    		"MYSQLI_TYPE_DATE"        => 'string',
    		"MYSQLI_TYPE_TIME"        => 'string',
    		"MYSQLI_TYPE_DATETIME"    => 'string',
    		"MYSQLI_TYPE_YEAR"        => 'string',
    		"MYSQLI_TYPE_NEWDATE"     => 'string',
    		"MYSQLI_TYPE_ENUM"        => 'string',
    		"MYSQLI_TYPE_SET"         => 'string',
    		"MYSQLI_TYPE_TINYBLOB"    => 'object',
    		"MYSQLI_TYPE_MEDIUMBLOB"  => 'object',
    		"MYSQLI_TYPE_LONGBLOB"    => 'object',
    		"MYSQLI_TYPE_BLOB"        => 'object',
    		"MYSQLI_TYPE_CHAR"        => 'string',
    		"MYSQLI_TYPE_VARCHAR"     => 'string',
    		"MYSQLI_TYPE_GEOMETRY"    => 'object',
    		"MYSQLI_TYPE_BIT"         => 'integer',
    );

    // From http://www.zfsnippets.com/snippets/view/id/70
    protected $_dataTypes = array(
    		'bit' => 'int',
    		'tinyint' => 'int',
    		'bool' => 'bool',
    		'boolean' => 'bool',
    		'smallint' => 'int',
    		'mediumint' => 'int',
    		'int' => 'int',
    		'integer' => 'int',
    		'bigint' => 'float',
    		'serial' => 'int',
    		'float' => 'float',
    		'real' => 'float',
    		'numeric' => 'float',
    		'money' => 'float',
    		'double' => 'float',
    		'double precision' => 'float',
    		'decimal' => 'float',
    		'dec' => 'float',
    		'fixed' => 'float',
    		'year' => 'int'
    );

    public function __construct()
    {

    }

    public function __get ($name){
        $method = 'get' . ucfirst($name);
        $value = null;

        // if getter method exists
        if (method_exists($this, $method)) {
            $value = $this->$method();
        } // else if array key with that name exists in object properties
        //else if (array_key_exists($name, $this->_properties)){
        else if(isset($this->{$name}) || property_exists($this, $name)){
            //$value = $this->_properties[$name];
            $value = $this->{$name};
        } else { // else throw exception
            //throw new Exception(self::INVALID_PROPERTY);
        }
        return $value;
        }

        public function __set ($name, $value){
            $method = 'set' . ucfirst($name);

            // if trying to set mapper, then throw exception
            if ('mapper' == $name) {
                throw new Exception(self::INVALID_PROPERTY);
            }

            // if setter method
            if(method_exists($this, $method)) {
                return $this->$method($value);
            } // else if array key with that name exists in object properties
            //else if (array_key_exists($name, $this->_properties)){
            else if(isset($this->{$name}) || property_exists($this, $name)){
                //$this->_properties[$name] = $value;
                $this->{$name} = $value;
            } else { // else throw exception
                throw new Exception(self::INVALID_PROPERTY." ".$name);
            }
        }

        public function __isset($name){
            return isset($this->{$name});
        }

            public function __unset($name){
                if (isset($this->{$name})) {
                    //unset($this->{$name});
                    $this->{$name} = NULL;
                }
            }

            public static function getPrimaryKey(){
                $calledClass = get_called_class();
                $obj = new $calledClass();
                return $obj->_myDbPrimary;
            }

            function myPrimaryKey(){
                return $this->_myDbPrimary;
            }

            /**
             * Get all accessible properties as array
             * @return array of accessible properties
             */
            public function toArray(){
                // return properties as array.
                return get_object_vars($this);
                //return $this->_properties;
            }

            /**
             * Clears (sets to null) all properties of the object
             * @return void
             */
            public function clear(){
                /*foreach ($this->_properties as $key => $value) {
                 $this->_properties[$key] = null;
                }*/
                foreach (get_object_vars($this) as $key => $value) {
                    $this->{$key} = null;
                }
            }

            /**
             * Charge les propriétés de l'objet Classification à partir du résultat d'une requête
             */
            public function loadFromRowset($rowset){
                if($rowset){
                    // Récupère un tableau associatif column/value
                    if(is_array($rowset)){
                        $rowArray = $rowset;
                    }elseif(method_exists($rowset,"toArray")){
                        $rowArray = $rowset->toArray();
                    }else{
                        $rowArray = objectToArray($rowset);
                    }

                    if($this->_useCleanData){
                        // Keep data as loaded from database
                        $this->_cleanData = $rowArray;
                    }

                    foreach($rowArray as $key => $val){
                        if(isset($this->{$key}) || property_exists($this,$key)) $this->{$key} = $val;
                    }
                    $this->init();
                }
            }

            /**
             * Fonction qui initialise l'objet à partir de son id
             */
            public function loadById($id,$full = false,$champ=""){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */

                if(!$champ) $champ = $this->_myDbPrimary;

                if(!$full){
                    $select = $objDB->mySelectBuild();
                }else{
                    $select = $objDB->myFullSelectBuild();
                }
                $select->where($champ.' = ?',$id);
                //debug($select->__toString());
                $row = $objDB->fetchRow($select);
                $this->loadFromRowset($row);
            }

            /**
             * Enregistre l'objet en base de données
             *
             * @param boolean $change
             * @return id
             */
            public function save($reload=false,$change=true){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */

                // Inserted flag (if new primary key)
                $this->_saved = $this->{$this->_myDbPrimary} ? self::UPDATED : self::INSERTED;

                // Save object
                $id = $objDB->Db_save($this,$change);
                $this->{$this->_myDbPrimary} = $id;
                if ($reload) $this->loadById($id,true);

                return $id;
            }

            /**
             * Update multiple rows
             */
            public function saveMultiple($array_ids, $values)
            {
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */
                $id = $objDB->Db_saveMultiple($array_ids, $values);
                return $id;
            }

            public function duplique(){
                $objClone = clone $this;
                $objClone->{$this->_myDbPrimary} = 0;
                return $objClone;
            }

            public function delete(){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */

                $id        = $this->{$this->_myDbPrimary};
                $nbDeleted = $objDB->Db_delete($this);

                // Notify delete
                if( $nbDeleted )
                {
                    $this->_saved = self::DELETED;
                }

                return $nbDeleted;
            }

            /**
             * Delete multiple rows
             */
            function deleteMultiple($array_ids)
            {
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */
                $nbDeleted = $objDB->Db_deleteMultiple($array_ids);
                return $nbDeleted;
            }

            public function getListe($full=false,$select=false,$order=false){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */
                $return = array();

                if(!$select){
                    if(!$full){
                        $select = $objDB->mySelectBuild();
                    }else{
                        $select = $objDB->myFullSelectBuild();
                    }
                }

                if($order){
                    $select->order($order);
                }

                $tabRows = $objDB->fetchAll($select);

                foreach($tabRows as $rowset){
                    $obj = new $this->_myMetierClassName();
                    $obj->loadFromRowset($rowset);
                    $return[] = $obj;
                }
                return $return;
            }

            public function getResult($select){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */

                $res = $objDB->fetchAll($select);
                if(is_array($res)){
                    $tabRows = $res;
                }else{
                    $tabRows = $res->toArray();
                }
                return $tabRows;
            }

            public function getOne($select,$full = false){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */
                $return = null;

                if(!$select){
                    if(!$full){
                        $select = $objDB->mySelectBuild();
                    }else{
                        $select = $objDB->myFullSelectBuild();
                    }
                }

                $select->limit(1);

                $rowset = $objDB->fetchRow($select);

                if($rowset){
                    $obj = new $this->_myMetierClassName();
                    $obj->loadFromRowset($rowset);
                    $return = $obj;
                }

                return $return;
            }

            public function getOneRowset($select, $full = false){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */
                $return = null;

                if(!$select){
                    if(!$full){
                        $select = $objDB->mySelectBuild();
                    }else{
                        $select = $objDB->myFullSelectBuild();
                    }
                }

                $select->limit(1);

                $rowset = $objDB->fetchRow($select);

                if($rowset){
                    if(is_array($rowset)){
                        $tabRows = $rowset;
                    }else{
                        $tabRows = $rowset->toArray();
                    }
                    $return = $tabRows;
                }

                return $return;
            }

            public function searchPaginator($page, $nb, $full=false, $select=false, $pageRange=10,$desactiveCache=false){
                $objDB = new $this->_myDbClassName(); /* @var $objDB App_Model_Db */
                if(!$select){
                    if(!$full){
                        $select = $objDB->mySelectBuild();
                    }else{
                        $select = $objDB->myFullSelectBuild();
                    }
                }
                $paginator = Zend_Paginator::factory($select);
                $paginator->setItemCountPerPage($nb);
                $paginator->setCurrentPageNumber($page);
                $paginator->setPageRange($pageRange);

                return $paginator;
            }

            /**
             * Return all columns that have been changed
             */
            function getUpdatedProperties($with_values=false)
            {
                $properties = array();

                foreach( $this->_cleanData as $key=>$value )
                {
                    if( $this->{$key} != $value )
                    {
                        if( $with_values )
                        {
                            $properties[$key] = $value;
                        }
                        else
                        {
                            $properties[] = $key;
                        }
                    }
                }

                return $properties;
            }

            /**
             * Get notify message template
             */
            function getMessageTemplate()
            {
                if( $this->_saved !== NULL )
                {
                    return $this->_messageTemplates[$this->_saved];
                }

                return 'Aucune modification n\'a été apportée ...';
            }

            /**
             * Return list as Array "pk_id" => "libelle"
             */
            function getListAsArray($libelle,$id=null,$select=null,$full=false)
            {
                $results = array();

                $db     = new $this->_myDbClassName();
                if($select===null){
                    $select = $db->mySelectBuild();
                }
                if($id == null){
                    $id = $this->myPrimaryKey();
                }

                // Format rows to array
                foreach( $this->getListe($full, $select) as $row )
                {
                    $results[$row->{$id}] = $row->{$libelle};
                }

                return $results;
            }

            /**
             * Return list as Array "id" => "libelle"
             */
            function getAsArray($listeObj,$libelleMethod,$idMethod)
            {
                $results = array();

                // Format rows to array
                foreach( $listeObj as $obj )
                {
                    $results[$obj->{$idMethod}()] = $obj->{$libelleMethod}();
                }

                return $results;
            }


            /**
             * Initialize object
             *
             * Called from {@link __construct()} as final step of object instantiation.
             *
             * @return void
            */
            public function init() {
            	//$table = $this->getTable();
            	//return;
            	$table = new $this->_myDbClassName();
            	if ($table) {
            		$cols = $table->info(Zend_Db_Table_Abstract::METADATA);
            		foreach ($cols as $name => $col) {
            			$dataType = strtolower($col['DATA_TYPE']);

            			if (array_key_exists($dataType, $this->_dataTypes)) {
            				if(!is_null($this->$name)){
            					settype($this->$name, $this->_dataTypes[$dataType]);
            				}
            			}
            		}
            	}
            }
}