<?php

class SkillController extends Zend_Controller_Action
{
    public function indexAction(){
        
    }
    
    public function addAction(){
        $form = new Form_Skill_Add();
        
        if ($this->getRequest()->isPost()){
            $form->isValid($this->getRequest()->getPost());
        }
        
        $this->view->form = $form;
    }
    
    public function editAction(){
        
    }
    
    public function deleteAction(){
        
    }
}