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
        $acl->addResource('index');
        $acl->addResource('user');
        $acl->addResource('web');
        //$acl->addResource('other-work');
        $acl->addResource('skill');
        //$acl->addResource('progress');
        $acl->addResource('auth');
        $acl->addResource('contact');
            
        
        //AddRules
        $acl->allow('guest','auth', 'login');
        $acl->allow('guest', 'auth', 'index');
        $acl->allow('guest', 'index', 'index');
        $acl->allow('guest',
            array('web', 'skill'),
            array('read')
        );
        $acl->allow('guest', 'contact', 'send');
        
        $acl->deny('curious', 'auth', 'login');
        $acl->allow('curious', 'auth', 'logout');
        $acl->allow(
            'curious', 
            array('web', 'skill'), 
            'list');
        
        $acl->allow('guest', 'contact', 'send');
        
        $acl->allow(
            'admin', 
            array('web', 'skill'), // array('web', 'skill', 'otherwork', 'progress')
            array('add', 'edit', 'delete')
        );
        $acl->allow(
            'admin',
            'user',
            array('create', 'list', 'update', 'delete')
        );
        
        Zend_Registry::set('Zend_Acl', $acl);
    }
}

