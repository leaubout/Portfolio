<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initAcl(){
        $acl = new Zend_Acl();
        
        //AddRoles
        $acl->addRole('guest');
        $acl->addRole('curious', 'guest');
        $acl->addRole('admin', 'curious');
        
        //AddResource
        $acl->addResource('user');
        $acl->addResource('web');
        //$acl->addResource('other-work');
        $acl->addResource('skill');
        //$acl->addResource('progress');
        $acl->addResource('authentification');
        $acl->addResource('contact');
            
        
        //AddRules
        $acl->allow('guest','authentification', 'login');
        $acl->allow('guest',
            array('web', 'skill'),
            array('read')
        );
        $acl->allow('guest', 'contact', 'send');
        
        $acl->deny('curious', 'authentification', 'login');
        $acl->allow('curious', 'authentification', 'logout');
        $acl->allow(
            'curious', 
            array('web', 'skill'), 
            'list');
        
        $acl->allow('guest', 'contact', 'send');
        
        $acl->allow(
            'admin', 
            array('web', 'skill'), 
            array('create', 'update', 'delete')
        );
        $acl->allow(
            'admin',
            'user',
            array('create', 'list', 'update', 'delete')
        );
        
        Zend_Registry::set('Zend_Acl', $acl);
    }
}

