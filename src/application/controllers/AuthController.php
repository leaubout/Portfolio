<?php

class AuthController extends Zend_Controller_Action
{
    protected $auth;
    protected $userAuth;
    
    public function init(){
        $this->auth = Zend_Auth::getInstance();
        if($this->auth->hasIdentity()){
            $this->userAuth = $this->auth->getIdentity();
        } else {
            $this->userAuth = new Model_User();
        }
    }
    
    public function indexAction(){
        
        if ($this->auth->hasIdentity()){
            $this->forward('logout');
        } else {
            $this->forward('login');
        }
        
    }
    
    public function loginAction(){
        $form = new Form_Login();
               
        if ($this->getRequest()->isPost()){
            if ($form->isValid($this->getRequest()->getPost())){
                $login = $form->getValue('login');
                $password = $form->getValue('password');
                
                // Création de l'adaptateur DbTable
                $adapter = new Zend_Auth_Adapter_DbTable();
                $adapter->setTableName(Model_DbTable_User::TABLE_NAME)
                            ->setIdentityColumn(Model_DbTable_User::COL_LOGIN)
                            ->setCredentialColumn(Model_DbTable_User::COL_PASSWORD)
                            ->setIdentity($login)
                            ->setCredential($password);
                
                // Création de l'objet d'authentification
                $auth = Zend_Auth::getInstance();
                
                $authResult = $auth->authenticate($adapter);
                
                if ($authResult->isValid()){
                    $storage = $auth->getStorage();
                    
                    $service = new Service_User();
                    $user = $service->authenticate($adapter->getResultRowObject(null, 'password'));
                    
                    if($user->getId() == 1){
                        $user->setRoleId('admin');
                    } else {
                        $user->setRoleId('curious');
                    }
                    
                    $storage->write($user);
                }
                
                if ($authResult->getCode() == Zend_Auth_Result::SUCCESS){
                    // Success connect
                    $this->view->priorityMessenger('Login success.', 'success');
                    $this->redirect($this->view->url(array(), 'indexIndex'));
                }else{
                    $this->view->priorityMessenger('Login failed.', 'warning');
                }
                
            }else{
                // message d'erreur de connexion
            }
        }
        
        $this->view->assign('form', $form); 
    }
    
    public function logoutAction(){
        
        $this->_helper->viewRenderer->setNoRender(TRUE);
        
        $this->view->priorityMessenger('Déconnexion.', 'success');
        $this->auth->clearIdentity();
        
        $this->redirect($this->view->url(array(), 'indexIndex'));
    }
} 