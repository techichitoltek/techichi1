<?php
/**
 * Handle the Online plugin
 *
 * @package App_Plugin
 * @copyright RCWEB
 */

class App_Plugin_Online extends Zend_Controller_Plugin_Abstract
{
    /*public function routeStartup(){

    }*/

    public function dispatchLoopShutdown(){
        $currentRequestInfo = Zend_Registry::get('currentRequestInfo');
        $portailUrl = Zend_Registry::get("PortailUrl"); /* @var $portailUrl PortailUrl */
        $webUser = Zend_Registry::get("WebUser"); /* @var $webUser App_WebUser */
        $benchmark = Zend_Registry::get("benchmark"); /* @var $benchmark App_Perfs_Benchmark */
        $online = new Online($webUser->getSessionId(),null,"online_session");
        //$online = new Online();
        $online->setOnline_session($webUser->getSessionId());
        $online->setOnline_ip($webUser->get_ip());
        $online->setOnline_timeGeneration($benchmark->getTimePerfDiff());
        $online->setOnline_timeGenerationTotal($benchmark->getTimePerfDifftotal());
        $online->setOnline_userAgent($webUser->get_userAgent());
        $online->setOnline_isBot($webUser->isBot());
        $online->setOnline_time(time());
        $online->setOnline_portailUrl($portailUrl->getPortailurl_url());
        $online->setOnline_url($currentRequestInfo['requestUri']);
        $online->setOnline_referrer($webUser->get_httpReferrer());
        $online->save();
    }
}