<?php

class Plugin_AccessHandler extends Zend_Controller_Plugin_Abstract
{
    protected $auth;
    
    public function preDispatch($request){
        
        $errors = $request->getParam('error_handler');
        
        if(! $errors || ! $errors instanceof ArrayObject){
            $this->auth = Zend_Auth::getInstance();
            //$this->_handleAccess($request);
        }
        
    }
    
    public function _handleAccess (Zend_Controller_Request_Abstract $request){
        if(! $this->auth->hasIdentity() && $request->getControllerName() != 'auth'){
            if($request->getActionName() != 'index'){
                throw new Zend_Controller_Dispatcher_Exception('Page not found');
            }
        }
    }
}