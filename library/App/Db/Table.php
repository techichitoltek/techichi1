<?php
class App_Db_Table extends Zend_Db_Table_Abstract{

    protected $_name = "";
    protected $_primary = "";

    public function App_Db_Table($table){
        $this->_name = $table;
        parent::_setupTableName();
        parent::__construct();
    }

}
