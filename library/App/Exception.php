<?php
/**
 * Exception that will be picked up by the framework
 *
 * @category App
 * @package App
 * @copyright RCWEB
 */

class App_Exception extends Zend_Exception
{
    const PARAMETRAGE = 100;


    /*
     * @see Zend_Exception::__construct()
     */
    public function __construct($msg = '', $code = 0, Exception $previous = null) {
        parent::__construct($msg, $code,$previous);
    }


}