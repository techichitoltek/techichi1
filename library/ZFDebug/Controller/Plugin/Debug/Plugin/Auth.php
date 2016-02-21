<?php
/**
 * ZFDebug Zend Additions
 *
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2009 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 * @version    $Id: $
 */

/**
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2009 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 */
class ZFDebug_Controller_Plugin_Debug_Plugin_Auth implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'auth';

    /**
     * Contains Zend_Auth object
     *
     * @var Zend_Auth
     */
    protected $_auth;

    /**
     * Contains "column name" for the username
     *
     * @var string
     */
    protected $_user = 'user';

    /**
     * Contains "column name" for the role
     *
     * @var string
     */
    protected $_role = 'role';

    /**
     * Contains Acls for this application
     *
     * @var Zend_Acl
     */
    protected $_acl;

    /**
     * Create ZFDebug_Controller_Plugin_Debug_Plugin_Auth
     *
     * @var string $user
     * @var string $role
     * @return void
     */
    public function __construct(array $options = array())
    {
        $this->_auth = App_Auth::getInstance();
        if (isset($options['user'])) {
            $this->_user = $options['user'];
        }
        if (isset($options['role'])) {
            $this->_role = $options['role'];
        }
    }

    /**
     * Gets identifier for this plugin
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab()
    {
        $username = 'Not Authed';
        $role = 'Unknown Role';

        if(!$this->_auth->hasIdentity()) {
            return 'Not authorized';
        }
        $identity = $this->_auth->getIdentity();
        // TDTODO : régler le problème en non connecté
//Zend_Debug::dump($identity);
        if (is_object($identity)) {
            $username = $this->_auth->getIdentity()->{$this->_user};
            $role = $this->_auth->getIdentity()->{$this->_role};
        }
        else {
            $username = $this->_auth->getIdentity();
            $role = '';
        }
        return "$username";
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        $panel = '<h4>AUTH Information</h4>';

        if ($this->_auth->hasIdentity())
        {
            $identity = $this->_auth->getIdentity();

            foreach ($identity as $key => $val)
            {
                if(is_string($val) || is_null($val)){
                    if($val !== null){
                        $panel .= $key . ' = ' .$val . '<br />';
                    }else{
                        $panel .= $key . ' = NULL<br />';
                    }
                }else{
                    $panel .= $key . ' => <br />';
                    foreach ($val as $keyVal => $valVal)
                    {
                        if(is_string($valVal) || is_null($valVal)){
                            if($valVal !== null){
                                $panel .= "&nbsp;&nbsp;&nbsp;" . $keyVal . ' = ' .$valVal . '<br />';
                            }else{
                                $panel .= "&nbsp;&nbsp;&nbsp;" . $keyVal . ' = NULL<br />';
                            }
                        }else{
                            $panel .= "&nbsp;&nbsp;&nbsp;" . $keyVal . ' => <br />';
                            foreach ($valVal as $kValVal => $valValVal)
                            {
                                if($valVal !== null){
                                    $panel .= "&nbsp;&nbsp;&nbsp;" . "&nbsp;&nbsp;&nbsp;" . $kValVal . ' = ' .$valValVal . '<br />';
                                }else{
                                    $panel .= "&nbsp;&nbsp;&nbsp;" . "&nbsp;&nbsp;&nbsp;" . $kValVal . ' = NULL<br />';
                                }

                            }
                        }
                    }
                }
            }
        }
        return $panel;
    }
}