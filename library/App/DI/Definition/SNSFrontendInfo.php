<?php
/**
 * SNS Frontend Info object definition
 *
 * @category App
 * @package App_DI
 * @copyright RCWEB
 */
class App_DI_Definition_SNSFrontendInfo
{
    /**
     * This method will instantiate the object, configure it and return it
     *
     * @return Zend_Cache_Manager
     */
    public static function getInstance(){
        $config = App_DI_Container::get('ConfigObject');
        
        $snsConfig = array(
            'accessKey' => $config->amazon->aws_access_key,
            'privateKey' => $config->amazon->aws_private_key,
            'host' => $config->amazon->sns->host,
        );
        
        $snsConfig['topicArn'] = $config->amazon->sns->topics->frontend_info->arn;
        $sns = new App_Amazon_SNS_Topic($snsConfig);
        
        return $sns;
    }
}