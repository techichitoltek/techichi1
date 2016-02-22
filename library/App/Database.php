<?php
class App_Database extends Zend_Db_Table{

    protected $_name = "";

    function _setTableName($tableName){
        $this->_name = $tableName;
    }

    function App_Database($nomTable){
        $this->_setTableName($nomTable);
        parent::__construct();
    }

    function showStructure(){
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = $this->_name;
        $sql = $db->query("SHOW CREATE TABLE ".$tableName);
        $return = $sql->fetch();
        return $return['Create Table'];
    }



    function mysql_structure() {
        $db = Zend_Registry::get('dbAdapter');
        $db->query('SET NAMES UTF8');
        $tableName = $this->_name;

        $table = $this->_name;
        $descTableau = $db->describeTable($table);
        $insertions = "";
        $tableau = array_keys($descTableau);

        $select = $db->select()
        ->from($tableName);
        $stmt = $select->query();
        $rows = $stmt->fetchAll();

        foreach($rows as $datas){
            $insertions .= "INSERT INTO $table VALUES(";
            foreach($datas as $key => $data)
            {
                $insertions .= $db->quote($data) . ", ";
            }
            $insertions = substr($insertions, 0, -2);
            $insertions .= ");\n";
        }
        return $insertions;
    }

    /**
     *
     * TODO
     */
    function con(){
        $con = mysql_connect('localhost','root','');
        mysql_select_db('database_name');

        $result = mysql_query("SHOW TABLES;");
        while ( $row = mysql_fetch_row($result) ) {
            $table = $row[0];

            // dump data
            $output .= datadump($table, true, true);
        }
        $fh = fopen("database_name.sql", 'w');
        fwrite($fh, $output);
        fclose($fh);
    }

    /**
     *
     *
     * TODO
     * @param unknown_type $table
     * @param unknown_type $drop
     * @param unknown_type $stripapos
     */
    function datadump($table, $drop = true, $stripapos = true)
    {
        $result = "# Dump of $table \n";
        $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";
        if ( $drop ) {
            if ( $stripapos ) {
                $result .= "DROP TABLE IF EXISTS $table;\n";
                // dump create table
                $createTableQuery = mysql_query("SHOW CREATE TABLE ".$table.";");
                $createTable = mysql_fetch_row($createTableQuery);
                $result .= str_replace('`', '', $createTable[1]).";\n\n\n\n";
            } else {
                $result .= "DROP TABLE IF EXISTS `$table`;\n";
                // dump create table
                $createTableQuery = mysql_query("SHOW CREATE TABLE ".$table.";");
                $createTable = mysql_fetch_row($createTableQuery);
                $result .= $createTable[1].";\n\n\n\n";
            }
        } else {
            $result .= "TRUNCATE TABLE $table;\n";
        }

        $query = mysql_query("SELECT * FROM $table");
        $num_fields = @mysql_num_fields($query);
        $numrow = mysql_num_rows($query);

        $columnsRes = mysql_query("SHOW COLUMNS FROM $table;");
        $columns = array();

        while ( $row = mysql_fetch_assoc($columnsRes) ) {
            $columns[$row['Field']] = $row;
        }

        while ( $row = mysql_fetch_assoc($query) ) {
            $result .= "INSERT INTO ".$table." VALUES(";

            $fields = array();

            foreach ( $row as $field => $data ) {
                if ( strpos(strtolower($columns[$field]['Type']), 'int') !== false
                || strpos(strtolower($columns[$field]['Type']), 'float') !== false
                || strpos(strtolower($columns[$field]['Type']), 'tinyint') !== false ) {
                    if ( strlen($data) > 0 ) {
                        $fields[] = $data;
                    } else {
                        if ( strtolower($columns[$field]['Null']) == 'no' ) {
                            $fields[] = 0;
                        } else {
                            $fields[] = "NULL";
                        }
                    }
                } elseif ( strpos(strtolower($columns[$field]['Type']), 'datetime') !== false ) {
                    if ( strlen($data) > 0 ) {
                        $fields[] = "\"".$data."\"" ;
                    } else {
                        if ( strtolower($columns[$field]['Null']) == 'no' ) {
                            $fields[] = '""';
                        } else {
                            $fields[] = "NULL";
                        }
                    }
                } elseif ( strpos(strtolower($columns[$field]['Type']), 'time') !== false ) {
                    if ( strlen($data) > 0 ) {
                        $fields[] = "\"".$data."\"" ;
                    } else {
                        if ( strtolower($columns[$field]['Null']) == 'no' ) {
                            $fields[] = '""';
                        } else {
                            $fields[] = "NULL";
                        }
                    }
                } elseif ( strpos(strtolower($columns[$field]['Type']), 'varchar') !== false
                        || strpos(strtolower($columns[$field]['Type']), 'text') !== false
                        || strpos(strtolower($columns[$field]['Type']), 'longtext') !== false
                        || strpos(strtolower($columns[$field]['Type']), 'mediumtext') !== false ) {
                    $data = addslashes($data);
                    $data = trim(ereg_replace("\n", "\\n", $data));
                    if ( strlen($data) > 0 ) {
                        $fields[] = "\"".$data."\"" ;
                    } else {
                        if ( strtolower($columns[$field]['Null']) == 'no' ) {
                            $fields[] = '""';
                        } else {
                            $fields[] = "NULL";
                        }
                    }
                } else {
                    // $columns[$field]['Type'] will contain the datatype
                    if ( strlen($data) > 0 ) {
                        $fields[] = "\"".$data."\"" ;
                    } else {
                        if ( strtolower($columns[$field]['Null']) == 'no' ) {
                            $fields[] = '""';
                        } else {
                            $fields[] = "NULL";
                        }
                    }
                }
            }
            $result .= implode(',', $fields);
            $result .= ");\n";
        }
        return $result . "\n\n\n";
    }




}