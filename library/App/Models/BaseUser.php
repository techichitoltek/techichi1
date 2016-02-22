<?php
/**
 * Base User Model
 *
 *
 * @category App
 * @package App_Model
 * @copyright TD-System
 */

class BaseUser extends App_Model
{
    const ROLE_GUEST        = 'guests';
    const ROLE_MEMBER       = 'members';
    const ROLE_GOD          = 'god';

    /**
     * Logs an user in the application based on his
     * username and email
     *
     * @param string $username
     * @param string $password
     * @param boolean $rememberMe
     * @access public
     * @return void
     */
    public function login($username, $password, $rememberMe = FALSE){
        // adapter cfg
        $adapter = new Zend_Auth_Adapter_DbTable($this->_db);
        $adapter->setTableName($this->_name);
        $adapter->setIdentityColumn('username');
        $adapter->setCredentialColumn('password');

        // checking credentials
        $adapter->setIdentity($username);
        $adapter->setCredential(BaseUser::hashPassword($password));

        try{
            $result = $adapter->authenticate();
        }catch(Zend_Auth_Adapter_Exception $e){
            App_Logger::log(sprintf("Exception catched while login: %s", $e->getMessage()),Zend_Log::ERR);

            return FALSE;
        }

        if($result->isValid()){
            // get the user row
            $loggedUser = $adapter->getResultRowObject(NULL, 'password');
            //Zend_Debug::dump($loggedUser);exit();
            //Check if the account has been closed
            if($loggedUser->deleted){
                return NULL;
            }

            // clear the existing data
            $auth = App_Auth::getInstance();
            $auth->clearIdentity();

            if(!empty($loggedUser->id)){
                switch(CURRENT_MODULE){
                    case 'frontend':
                        $userModel = new User();
                        $user = $userModel->findById($loggedUser->id);
                        $user->get('group');

                        $session = new stdClass();

                        foreach(get_object_vars($loggedUser) as $k => $v){
                            $session->{$k} = $v;
                        }
                        $session->group->name = $user->get('group')->name;
                        break;
                    case 'backoffice':
                        $userModel = new BackofficeUser();
                        $user = $userModel->findById($loggedUser->id);
                        $user->groups = $user->findManyToManyRowset('Group', 'BackofficeUserGroup');
                        $user->group = $user->groups[0];

                        $session = new stdClass();

                        foreach(get_object_vars($loggedUser) as $k => $v){
                            $session->{$k} = $v;
                        }
						$session->group = new stdClass();
                        $session->group->name = $user->group->name;
                        break;
                }

                $auth->getStorage()->write($session);

            }

            $this->update(
                array(
                    'last_login' => new Zend_Db_Expr('NOW()'),
                  'nb_login' => $user->nb_login + 1
                ),
                $this->_db->quoteInto('id = ?', $user->id)
            );

            if($rememberMe){
                Zend_Session::rememberMe(App_DI_Container::get('ConfigObject')->session->remember_me->lifetime);
            }else{
                Zend_Session::forgetMe();
            }

            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Hashes a password using the salt in the app.ini
     *
     * @param string $password
     * @static
     * @access public
     * @return string
     */
    public static function hashPassword($password){
        $config = App_DI_Container::get('ConfigObject');
        $module = strtolower(CURRENT_MODULE);
        return sha1($config->{$module}->security->passwordsalt . $password);
    }

    /**
     * Return the App_Table_User instance based on the logged info
     *
     * @return void
     */
    public static function getUserInstance(){
        $userModel = new User();

        $session = BaseUser::getSession();

        return isset($session->id)? $userModel->findById($session->id) : NULL;
    }

    /**
     * Check if the current user is logged
     *
     * @return void
     */
    public static function isLogged(){
        $user = BaseUser::getSession();

        return isset($user->id);
    }

    /**
     * Reload the data of the user in the session
     *
     * @return void
     */
    public static function reloadSession(){
        $auth = App_Auth::getInstance();

        switch(CURRENT_MODULE){
            case 'frontend':
                $userModel = new User();
                $user = $userModel->findById(self::getSession()->id);
                $user->get('group');
                break;
            case 'backoffice':
                $userModel = new BackofficeUser();
                $user = $userModel->findById(self::getSession()->id);
                $user->groups = $user->findManyToManyRowset('Group', 'BackofficeUserGroup');
                $user->group = $user->groups[0];
                break;
        }

        $session = new stdClass();
        foreach($user as $k => $v){
            $session->{$k} = $v;
        }
        $session->group->name = $user->get('group')->name;

        $auth->getStorage()->write($session);
    }

    /**
     * Return the current user auth instance
     *
     * @return stdClass
     */
    public static function getSession(){
        $auth = App_Auth::getInstance();

        // load the identity
        /**/
        if(!$auth->hasIdentity()){
            $user = new stdClass();
            $user->username = 'Not Authed';
            $user->group = new stdClass();
            $user->group->name = 'guests';
            $auth->getStorage()->write($user);
        }/**/

        $user = $auth->getIdentity();
        return $user;
    }

}