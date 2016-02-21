<?php

class App_Auth extends Zend_Auth {

    protected function __construct()
    {}

    protected function __clone()
    {}

    /**/
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    /**/

    /**
     * Returns true if and only if an identity is available from storage
     *
     * @return boolean
     */
    public function hasIdentity()
    {
        $hasIdentity = parent::hasIdentity();
        if($hasIdentity){
            $identity = parent::getIdentity();
            if(!isset($identity->group->name) || $identity->group->name == 'guests'){
                return false;
            }
        }
        return $hasIdentity;
    }

    public static function updateStorage($storageObject)
    {
        self::$_instance->getStorage()->write($storageObject);
    }
}