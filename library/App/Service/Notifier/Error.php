<?php
class App_Service_Notifier_Error
{
    protected $_environment;

    /**
     *
     * @var App_Mail
     */
    protected $_mailer;
    protected $_session;
    protected $_error;
    protected $_profiler;
    protected $_auth;
    /**
     *
     * @var App_WebUser
     */
    protected $_webUser;

    public function __construct(
            $environment,
            ArrayObject $error,
            App_Mail $mailer,
            Zend_Session_Namespace $session,
            Zend_Db_Profiler $profiler,
            Array $server,
            $auth,
            $webUser)
    {
        $this->_environment = $environment;
        $this->_mailer = $mailer;
        $this->_error = $error;
        $this->_session = $session;
        $this->_profiler = $profiler;
        $this->_server = $server;
        $this->_auth = $auth;
        $this->_webUser = $webUser;
    }

    public function getFullErrorMessage()
    {
        $message = '';

        if (!empty($this->_server['SERVER_ADDR'])) {
            $message .= "Server IP: " . $this->_server['SERVER_ADDR'] . "<br><br>";
        }

        $message .= "Identity : " . Zend_Debug::dump($this->_auth->getIdentity(),null,false) . "<br><br>";

        if (!empty($this->_server['HTTP_USER_AGENT'])) {
            $message .= "User agent: " . $this->_server['HTTP_USER_AGENT'] . "<br><br>";
        }

        $message .= "User IP: " . $this->_webUser->get_ip() . "<br>";
        $message .= "Bot ?: "; $message .= $this->_webUser->isBot() ? "Oui":"Non" . "<br>";
        $message .= "Referer: " . $this->_webUser->get_httpReferrer() . "<br><br>";

        if (!empty($this->_server['HTTP_X_REQUESTED_WITH'])) {
            $message .= "Request type: " . $this->_server['HTTP_X_REQUESTED_WITH'] . "<br><br>";
        }

        $message .= "Server time: " . date("Y-m-d H:i:s") . "<br><br>";
        $message .= "RequestURI: " . $this->_error->request->getRequestUri() . "<br><br>";

        if (!empty($this->_server['HTTP_REFERER'])) {
            $message .= "Referer: " . $this->_server['HTTP_REFERER'] . "<br><br>";
        }

        $message .= "Message: " . $this->_error->exception->getMessage() . "<br><br>";
        $message .= "Trace:\n" . Zend_Debug::dump($this->_error->exception->getTraceAsString(),null,false) . "<br><br>";
        $message .= "Request data: " . var_export($this->_error->request->getParams(), true) . "<br><br>";

        $it = $this->_session->getIterator();

        $message .= "Session data:<br><br>";
        foreach ($it as $key => $value) {
            $message .= $key . ": " . var_export($value, true) . "<br>";
        }
        $message .= "<br><br>";

        if($this->_profiler->getEnabled() == true){
            try {
                $nbRequetes = $this->_profiler->getTotalNumQueries();
                $tabRequetes = $this->_profiler->getQueryProfiles();
                if($nbRequetes >= 4){
                    for($cpt = $nbRequetes - 4; $cpt <= $nbRequetes-1;$cpt++){
                        if(method_exists($tabRequetes[$cpt], "getQuery")){
                            $query = $tabRequetes[$cpt]->getQuery();
                            $queryParams = $tabRequetes[$cpt]->getQueryParams();

                            $message .= "Last database query: " . $query . "<br>";
                            $message .= "Last database query params: " . var_export($queryParams, true) . "<br><br>";
                        }
                    }
                }elseif($nbRequetes >= 3){
                    for($cpt = $nbRequetes - 3; $cpt <= $nbRequetes-1;$cpt++){
                        if(method_exists($tabRequetes[$cpt], "getQuery")){
                            $query = $tabRequetes[$cpt]->getQuery();
                            $queryParams = $tabRequetes[$cpt]->getQueryParams();

                            $message .= "Last database query: " . $query . "<br>";
                            $message .= "Last database query params: " . var_export($queryParams, true) . "<br><br>";
                        }
                    }
                }elseif($nbRequetes >= 2){
                    for($cpt = $nbRequetes - 2; $cpt <= $nbRequetes-1;$cpt++){
                        if(method_exists($tabRequetes[$cpt], "getQuery")){
                            $query = $tabRequetes[$cpt]->getQuery();
                            $queryParams = $tabRequetes[$cpt]->getQueryParams();

                            $message .= "Last database query: " . $query . "<br>";
                            $message .= "Last database query params: " . var_export($queryParams, true) . "<br><br>";
                        }
                    }
                }else{
                    if(method_exists($this->_profiler->getLastQueryProfile(), "getQuery")){
                        $query = $this->_profiler->getLastQueryProfile()->getQuery();
                        $queryParams = $this->_profiler->getLastQueryProfile()->getQueryParams();

                        $message .= "Last database query: " . $query . "<br>";
                        $message .= "Last database query params: " . var_export($queryParams, true) . "<br><br>";
                    }
                }
            } catch (Exception $e) {
            }
        }

        return $message;
    }

    public function getShortErrorMessage()
    {
        $message = '';

        switch ($this->_environment) {
            case APP_STATE_PRODUCTION:
                $message .= "Il y a eu une erreur durant le traitement de votre requête.\n";
                $message .= " Le service technique en a été informé.";
                break;
            default:
                $message .= "Message: " . $this->_error->exception->getMessage() . "\n\n";
                $message .= "Trace:\n" . $this->_error->exception->getTraceAsString() . "\n\n";
        }

        return $message;
    }

    public function notify()
    {
        // TDTODO : retire DEVELOPMENT
        if (!in_array($this->_environment, array(APP_STATE_PRODUCTION, APP_STATE_STAGING, /**/APP_STATE_DEVELOPMENT/**/))) {
            return false;
        }

        $this->_mailer->fullErrorMessage = $this->getFullErrorMessage();
        $this->_mailer->environment = $this->_environment;
        $this->_mailer->AddAddress(ParamCustom::param("MAIL.INCIDENT_ADDRESS","FRAMEWORK"));

        //return false;
        if(stristr($this->_error->request->getRequestUri(), '/modules/ticketdream/public/') === FALSE) {
            return $this->_mailer->send();
        }else{
            return true;
        }
    }
}