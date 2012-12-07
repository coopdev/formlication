<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload()
    {
        Zend_Loader_Autoloader::getInstance()->registerNamespace('My_');  


        $session = new Zend_Session_Namespace();
        $request = new Zend_Controller_Request_Http();
        $session->baseUrl = $request->getBaseUrl();
    }


}

