<?php

class SkillController extends Zend_Controller_Action
{
    private $skillApi;
    
    public function init(){
        $storage = $user->getStorage();
        $this->skillApi = new Service_Skill();
    }
    
    public function indexAction(){
        $this->forward('list');
/*        $this->redirect($this->view->url(array(
            'controller' => 'skill',
            'action' => 'list'
        ), null));*/        
    }
    
    public function addAction(){
        $form = new Form_Skill_Add();
        
        if ($this->getRequest()->isPost()){
            if ($form->isValid($this->getRequest()->getPost())){
                $skill = new Model_Skill($form->getValidValues($this->getRequest()->getPost()));
                if ($this->skillApi->save($skill)){
                    $this->view->priorityMessenger('Compétence enregistrée.', 'success');
                } else {
                    $this->view->priorityMessenger('Problème lors de l\'enregistrement de la compétence.', 'warning');
                }
                $this->redirect($this->view->url(array(), 'skillList'));
            }
        }
        
        $this->view->form = $form;
    }
    
    public function editAction(){
        $form = new Form_Skill_Edit();
        
        $id = (int) $this->getRequest()->getParam('id');
        $skill = $this->skillApi->find($id);
        
        if(!$skill){
            $this->view->priorityMessenger('Erreur lors de la recherche de la compétence', 'warning');
            $this->redirect($this->view->url(array(
                'controller' => 'skill',
                'action' => 'list'
            ), null));
        }
        
        if ($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $skill = new Model_Skill($form->getValidValues($this->getRequest()->getPost()));
                if ($this->skillApi->save($skill)){
                    $this->view->priorityMessenger('Compétence mise à jour.', 'success');
                } else {
                    $this->view->priorityMessenger('Problème lors de la mise à jour de la compétence.', 'warning');
                }
                //$this->view->
                $this->redirect($this->view->url(array(), '/skill/list'));
            }  
        } else {
            $form->populate(array(
                'id' => $skill->getId(),
                'category' => $skill->getCategory()->getId(),
                'description' => $skill->getDescription(),
                'level' => $skill->getLevel(),
                'experience' => $skill->getExperience()
            ));
            $this->view->form = $form;
        }
    }
    
    public function deleteAction(){
        
        //$this->view->skills = $this->skillApi->fetchAll();
        
    }
    
    public function listAction(){
        $this->view->headTitle("Liste des compétences");
        $this->view->skills = $this->skillApi->fetchAll();
    }
}