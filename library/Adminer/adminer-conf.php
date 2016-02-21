<?php
function adminer_object() {
    class AdminerSoftware extends Adminer {

        function name() {
            // custom name in title and heading
            $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
            if (null === $viewRenderer->view) {
                $viewRenderer->initView();
            }
            $view = $viewRenderer->view;
            return "<a href='".$view->baseUrl()."/tools' id='h1'>".ParamCustom::param("NOM.APPLI", "FRAMEWORK")."</a>";
        }
        /**
        function permanentLogin() {
            // key used for permanent login
            return "27f34a9c540ae44a1ed7a2826a6172fd";
        }
        /**/
        function credentials() {
            $dbAdapter = Zend_Registry::get('dbAdapter');
            $config = $dbAdapter->getConfig();
            // server, username and password for connecting to database
            return array (
                    $config['host'],
                    $config['username'],
                    $config['password']
            );
        }
        /**/
        function database() {
            // database name, will be escaped by Adminer
            $dbAdapter = Zend_Registry::get('dbAdapter');
            $config = $dbAdapter->getConfig();
            return $config['dbname'];
        }
        /**/
        function login($login, $password) {
            $dbAdapter = Zend_Registry::get('dbAdapter');
            $config = $dbAdapter->getConfig();
            // validate user submitted credentials
            return ($login == $config['username'] && $password == $config['password']);
        }
        /**/
        /**
        function tableName($tableStatus) {
            // tables without comments would return empty string and will be ignored by Adminer
            return h ( $tableStatus ["Comment"] );
        }
        function fieldName($field, $order = 0) {
            // only columns with comments will be displayed and only the first five in select
            return ($order <= 5 && ! ereg ( '_(md5|sha1)$', $field ["field"] ) ? h ( $field ["comment"] ) : "");
        }
        /**/
    }

    return new AdminerSoftware ();
}