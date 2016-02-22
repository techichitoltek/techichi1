<?php
/**
 * Plugin de sauvegarde des informations de routage appliquée à la requête en cours
 *
 * @uses Zend_Controller_Plugin_Abstract
 */
class App_Plugin_SaveOrigin extends Zend_Controller_Plugin_Abstract
{
  /**
  * Hook à la sortie de la boucle de dispatching
  * Mémorise le routage effectué en vue d'une réutilisation
  *
  * @return void
  */
  public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
  {
      $arrayRequestInfo	=	array(
          'requestUri'		=>	$request->getRequestUri(),
           'requestModule'		=>	$request->getModuleName(),
           'requestController'	=>	$request->getControllerName(),
           'requestAction'		=>	$request->getActionName(),
      );

    Zend_Registry::set('currentRequestInfo',$arrayRequestInfo);
  }
}