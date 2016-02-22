<?php
class App_Model_Observable extends App_Model_Std implements SplSubject{

    const INVALID_PROPERTY = 'Invalid property';
    const INSERTED         = 1; // Last save() call was an insertion
    const UPDATED          = 2; // Last save() call was an update
    const DELETED          = 3; // Record deleted

    public $_myDbClassName       = "";
    public $_myDbPrimary         = "";
    public $_myMetierClassName   = "";
    public $_myDbTableName       = "";
    public $_myDbFieldPrefix     = "";
    public $_stdProfiling        = true;
    public $_profiling           = true;
    public $_saved               = null;    // Flag if object was inserted or updated on last save call
    private $_observers          = array(); // List of observers to notify
    protected $_cleanData        = array(); // data same as loaded from database
    protected $_isObservable     = false;   // Attach or not the Trace observer
    public $_messageTemplates    = array(
            self::INSERTED    => 'Le nouvel enregistrement a été ajouté',
            self::UPDATED     => 'L\'enregistrement a été modifié',
            self::DELETED     => 'L\'enregistrement a été supprimé',
    );

    public function __construct()
    {
        // Init trace observer
        if( $this->_isObservable )
        {
            $this->attach(new Observer_Tracer());
        }
    }

    public function myApp(){
        return MyTools_MyApp::singleton(); /* MyTools_MyApp */
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
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                if($rowset){
                    // Récupère un tableau associatif column/value
                    if(is_array($rowset)){
                        $rowArray = $rowset;
                    }else{
                        $rowArray = $rowset->toArray();
                    }

                    if($this->_useCleanData){
                        // Keep data as loaded from database
                        $this->_cleanData = $rowArray;
                    }

                    foreach($rowArray as $key => $val){
                        if(isset($this->{$key}) || property_exists($this,$key)) $this->{$key} = $val;
                    }
                }
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
            }

            /**
             * Fonction qui initialise l'objet à partir de son id
             */
            public function loadById($id,$full = false,$champ=""){
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */

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
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
            }

            public function save($change=true){
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */

                // Inserted flag (if new primary key)
                $this->_saved = $this->{$this->_myDbPrimary} ? self::UPDATED : self::INSERTED;

                // Save object
                $id = $objDB->Db_save($this,$change);
                $this->{$this->_myDbPrimary} = $id;
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");

                // Send notify signal
                $this->notify();

                return $id;
            }

            /**
             * Update multiple rows
             */
            public function saveMultiple($array_ids, $values)
            {
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */
                $id = $objDB->Db_saveMultiple($array_ids, $values);

                // Notify save multiple
                $this->notify(array('save_multiple'=>$array_ids, 'changes'=>$values));

                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $id;
            }

            public function duplique(){
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objClone = clone $this;
                $objClone->{$this->_myDbPrimary} = 0;
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $objClone;
            }

            public function delete(){
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */

                $id        = $this->{$this->_myDbPrimary};
                $nbDeleted = $objDB->Db_delete($this);

                // Notify delete
                if( $nbDeleted )
                {
                    $this->_saved = self::DELETED;
                    $this->notify();
                }

                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $nbDeleted;
            }

            /**
             * Delete multiple rows
             */
            function deleteMultiple($array_ids)
            {
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */
                $nbDeleted = $objDB->Db_deleteMultiple($array_ids);

                // Notify delete
                if( $nbDeleted )
                {
                    $this->notify(array('delete_multiple'=>$array_ids));
                }

                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $nbDeleted;
            }

            public function getListe($full=false,$select=false){
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */
                $return = array();

                if(!$select){
                    if(!$full){
                        $select = $objDB->mySelectBuild();
                    }else{
                        $select = $objDB->myFullSelectBuild();
                    }
                }

                $tabRows = $objDB->fetchAll($select);

                foreach($tabRows as $rowset){
                    $obj = new $this->_myMetierClassName();
                    $obj->loadFromRowset($rowset);
                    $return[] = $obj;
                }
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $return;
            }

            public function getResult($select){
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */

                $res = $objDB->fetchAll($select);
                if(is_array($res)){
                    $tabRows = $res;
                }else{
                    $tabRows = $res->toArray();
                }

                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $tabRows;
            }

            public function searchPaginator($page, $nb, $full=false, $select=false, $desactiveCache=false){
                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */
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
                $paginator->setPageRange(10);

                if($this->_stdProfiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $paginator;
            }

            // Special Medialex

            public function getTabFilter($filtres){
                if($this->_profiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $tabFilter = array();

                if($filtres != "none"){
                    $filtersUrl = base64_decode($filtres);
                    $filtersTab = explode("||",$filtersUrl);
                    $cpt = 0;
                    foreach($filtersTab as $filterTxt){
                        if($filterTxt){
                            $filter = explode("=",$filterTxt,2);
                            $filterType = explode("]]",$filter[0],2);
                            if(isset($filter[1]) && $filter[1]!="") {
                                $index = $filterType[1];
                                $tabFilter[$index]['name'] = $filterType[1];
                                $tabFilter[$index]['type'] = $filterType[0];
                                $tabFilter[$index]['value'] = $filter[1];
                            }
                        }
                    }
                }
                if($this->_profiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $tabFilter;
            }

            public function listingPaginator($page, $nb, $full=false, $params=array(), $select=false){
                if($this->_profiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */
                if(!$select){
                    if(!$full){
                        $select = $objDB->mySelectBuild();
                    }else{
                        $select = $objDB->myFullSelectBuild();
                    }
                }

                $select = Utils_FieldListing::contructFilterClause($select, $params);
                //Zend_debug::dump($select->__toString());/**/exit();/**/
                $infosObjDB = $objDB->info();
                $colsObjDB = $infosObjDB['cols'];
                if($params['orderBy'] != 'PRIMARY_KEY'){
                    $select->order(array($params['orderBy']." ".$params['sort']));
                }

                //debug($select->__toString());

                $paginator = $this->searchPaginator($page, $nb, $full,$select);

                if($this->_profiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");
                return $paginator;
            }

            /**
             * Return all rows filtered without pagination (used for export)
             * @param $full
             * @param $params
             * @param $select
             */
            public function listingExport($full=false, $params=array(), $select=false)
            {
                if($this->_profiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_start");
                $objDB = new $this->_myDbClassName(); /* @var $objDB Db_MyStdDbModel */
                if(!$select){
                    if(!$full){
                        $select = $objDB->mySelectBuild();
                    }else{
                        $select = $objDB->myFullSelectBuild();
                    }
                }

                $select = Utils_FieldListing::contructFilterClause($select, $params);
                $infosObjDB = $objDB->info();
                $colsObjDB = $infosObjDB['cols'];
                if($params['orderBy'] != 'PRIMARY_KEY'){
                    $select->order(array($params['orderBy']." ".$params['sort']));
                }

                if($this->_profiling) $this->myApp()->myBenchmark->mark(get_class($this).$this->myApp()->myBenchmark->separator.__FUNCTION__."_end");

                // Return rows as Metier Object
                $listeObject = array();
                foreach ($objDB->fetchAll($select) as $Db_Table_Row){
                    $object = new $objDB->_myMetierClassName();/* @var $object Metier_MyStdObjectModel */
                    $object->loadFromRowset($Db_Table_Row);
                    $listeObject[] = $object;
                }

                return $listeObject;
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
             * Observer Subject impletementation
             */
            function attach(SplObserver $observer, $key=null)
            {
                if( !$key )
                {
                    $key = get_class($observer);
                }

                if( array_key_exists($key, $this->_observers) )
                {
                    throw new Exception('Attention, vous ne pouvez pas ajouter plusieurs observers de même type "' . $key .'" !');
                }

                $this->_observers[$key] = $observer;

                return $this;
            }

            function detach(SplObserver $observer, $key=null)
            {
                if( !$key )
                {
                    $key = get_class($observer);
                }

                if( array_key_exists($key, $this->_observers) )
                {
                    unset($this->_observers[$key]);
                }

                return $this;
            }

            function notify($extra=array())
            {
                foreach( $this->_observers as $observer )
                {
                    $observer->update($this, $extra);
                }

                return $this;
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
        }