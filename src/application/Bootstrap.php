<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initAcl(){
        $acl = new Zend_Acl();
        
        //AddRoles
        $acl->addRole('guest');
        
        //AddResource
        $acl->addResource('someResource');
        
        //AddRules
        $acl->allow('guest', 'someResource', 'display');
        $acl->deny('guest', 'someResource', 'notDisplay');
        
        
        Zend_Registry::set('Zend_Acl', $acl);
    }
}

