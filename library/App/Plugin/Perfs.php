<?php
/**
 * Handle the Perfs plugin
 *
 * @package App_Plugin
 * @copyright RCWEB
 */

class App_Plugin_Perfs extends Zend_Controller_Plugin_Abstract
{
    protected $_currentRequestInfo = null;

    protected $_timePerfDifftotal = null;
    protected $_timePerfDiff = null;
    protected $_decalage = null;

    public function dispatchLoopShutdown(){
        $this->_currentRequestInfo = Zend_Registry::get('currentRequestInfo');

        $timePerfBegin = Zend_Registry::get('timePerfBegin');

        $timePerfEnd     =     microtime(true);
        $this->_timePerfDiff    =     ($timePerfEnd - $timePerfBegin) *1000;

        $logPerfBdd = ParamCustom::param("FRAMEWORK.LOG_PERFS","FRAMEWORK");

        $benchmark = Zend_Registry::get("benchmark"); /* @var $benchmark App_Perfs_Benchmark */
        $benchmark->mark('total_execution_time_end');

        $this->_timePerfDifftotal = (microtime(true)-$_SERVER['REQUEST_TIME'])*1000;
        $this->_decalage = ($timePerfBegin-$_SERVER['REQUEST_TIME'])*1000;

        if(false && $logPerfBdd){
            $profiling = $benchmark->profiling();
            $benchmark->_HTMLprofiler = $profiling;
            require_once 'class.html2text.inc'; /////////////////////////////////////////////////////////////////////////////// ATTENTION <- Pb avec php 5.5 donc à tester avec nouvelle fonction de PhpMailer...
            $h2t = new html2text($profiling);
            $text = $h2t->get_text();
            $benchmark->_profiler = $text;

            try{
                $webUser = Zend_Registry::get('WebUser');/* @var $webUser App_WebUser */
                $requestInfo = Zend_Registry::get('currentRequestInfo');

                $logPerfModel = new LogPerf();
                $logPerfModel->setLogperf_ip($webUser->get_ip());
                $logPerfModel->setLogperf_user_agent($webUser->get_userAgent());
                $logPerfModel->setLogperf_url($this->_currentRequestInfo['requestUri']);
                $logPerfModel->setLogperf_module($this->_currentRequestInfo['requestModule']);
                $logPerfModel->setLogperf_controller($this->_currentRequestInfo['requestController']);
                $logPerfModel->setLogperf_action($this->_currentRequestInfo['requestAction']);
                $logPerfModel->setLogperf_get(Zend_Debug::dump($_GET,null,false));
                $logPerfModel->setLogperf_post(Zend_Debug::dump($_POST,null,false));
                $logPerfModel->setLogperf_temps($this->_timePerfDiff);
                $logPerfModel->setLogperf_decalage($this->_decalage);
                $logPerfModel->setLogperf_tempsTotal($this->_timePerfDifftotal);
                $logPerfModel->setLogperf_profiler($benchmark->_profiler);
                $logPerfModel->setLogperf_isbot($webUser->isBot());
                $logPerfModel->setLogperf_httpReferrer($webUser->get_httpReferrer());
                $logPerfModel->save();
                //print_r($sql);exit();
            }catch (Exception $e){
                //print_r($e);exit();
            }
        }
        $benchmark->setTimePerfDifftotal($this->_timePerfDifftotal);
        $benchmark->setTimePerfDiff($this->_timePerfDiff);
        $benchmark->setDecalage($this->_decalage);
        //Zend_Debug::dump($benchmark);
        //Zend_Registry::set("benchmark",$benchmark);

    }
}