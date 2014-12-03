<?php

class SkillController extends Zend_Controller_Action
{
    private $skillApi;
    
    public function init(){
        $this->skillApi = new Service_Skill();
    }
    
    public function indexAction(){
        
    }
    
    public function addAction(){
        $form = new Form_Skill_Add();
        
        if ($this->getRequest()->isPost()){
            if ($form->isValid($this->getRequest()->getPost())){
                var_dump($this->getRequest()->getPost());exit;
            }
        }
        
        $this->view->form = $form;
    }
    
    public function editAction(){
        
    }
    
    public function deleteAction(){
        
    }
}