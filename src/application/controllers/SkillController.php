<?php

class SkillController extends Zend_Controller_Action
{
    private $skillApi;
    
    public function init()
    {
        $this->skillApi = new Service_Skill();
    }
    
    public function indexAction()
    {
        $this->view->headTitle("Liste des compétences");
        $this->view->skills = $this->skillApi->fetchAll();
    }
    
    public function addAction()
    {
        $form = new Form_Skill_Add();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
            	
                $skill = new Model_Skill($form->getValidValues($this->getRequest()->getPost()));
                
                if ($this->skillApi->save($skill)) {
					$this->view->priorityMessenger('Nouvelle compétence enregistrée.', 'success');
					$this->getHelper(Redirector)->goToRoute(array(), 'skillList');   
					//$this->redirect($this->view->url(array(), 'skillList'));                 
                } else {
                    $this->view->priorityMessenger('La création a échoué.', 'warning');
                }
                
            }
        }
        $this->view->form = $form;
    }
    
    public function editAction()
    {       
        $id = (int) $this->getRequest()->getParam('id');
        if ($id && ! Zend_Validate::is($id, 'Digits')) {
        	$this->view->priorityMessenger('Identifiant incorrect', 'danger');
        	$this->getHelper(Redirector)->goToRoute(array(), 'skillList');
        	//$this->redirect($this->view->url(array(), 'skillList'));
        }
        
        $skill = $this->skillApi->find($id);
        if (! $skill) {
            $this->view->priorityMessenger('Erreur lors de la recherche de la compétence', 'warning');
			$this->getHelper(Redirector)->goToRoute(array(), 'skillList');            
            //$this->redirect($this->view->url(array(), 'skillList'));
        }
        
        $form = new Form_Skill_Edit();        
        
        $form->populate(array(
        	'id' => $skill->getId(),
        	'category' => $skill->getIdCategory(),
        	'description' => $skill->getDescription(),
        	'level' => $skill->getLevel(),
        	'experience' => $skill->getExperience()	
        ));
        
        if ($this->getRequest()->isPost()) {
        	$data = $this->getRequest()->getPost();
        
        	foreach ($data as $key => $value) {
        		if (empty($value)) {
        			unset($data[$key]);
        		}
        	}
        	unset($data['send']);
        	
        	if ($form->isValidPartial($data)) {        		
        		$identical = true;
        		foreach ($data as $key => $value) {
        			if ($key == 'category') {
        				$method = 'getIdCategory'; 
        			} else {
        				$method = 'get' . ucfirst($key) ;
        			}
        			if (($value) != $skill->$method()) {
        				$identical = false;
        				break;
        			}
        		}
        		
        		// s'il y a eu des modifications apportées sur la compétence, on la met à jour
        		if (! $identical) {
	        		if (isset($data['category']) && $data['category'] != $skill->getIdCategory()) {
	        			$skill->setCategory($data['category']);
	        		}
	        		if (isset($data['description']) && $data['description'] != $skill->getDescription()) {
	        			$skill->setDescription($data['description']);
	        		}
	        		if (isset($data['level']) && $data['level'] != $skill->getLevel()) {
	        			$skill->setLevel($data['level']);
	        		}
	        		if (isset($data['experience']) && $data['experience'] != $skill->getExperience()) {
	        			$skill->setExperience($data['experience']);
	        		}

	                if ($this->skillApi->save($skill)) {
	                    $this->view->priorityMessenger('Compétence modifiée.', 'success');
	                } else {
	                    $this->view->priorityMessenger('Problème lors de la mise à jour de la compétence.', 'warning');
	                }
        		}  else {
        			$this->view->priorityMessenger('Aucune modification apportée à la compétence.', 'warning');
        		}  

        		$this->getHelper(Redirector)->goToRoute(array(), 'skillList');                    
	            //$this->redirect($this->view->url(array(), 'skillList'));
            }  
        }
        
        $this->view->form = $form;
    }
    
    public function deleteAction()
    {    
    	$this->_helper->viewRenderer->setNoRender(true);
    	
		$id = (int) $this->getRequest()->getParam('id');
    	if ($id && ! Zend_Validate::is($id, 'Digits')) {
    		$this->view->priorityMessenger('Identifiant incorrect', 'danger');
    		$this->getHelper(Redirector)->goToRoute(array(), 'skillList');
    		//$this->redirect($this->view->url(array(), 'skillList'));
    	}    	    														
    	
		if ($this->skillApi->delete($id)) {
			$this->view->priorityMessenger('Compétence supprimée.', 'success');
		} else {
			$this->view->priorityMessenger('Echec de la suppression de la compétence.', 'danger');
		}   
		$this->getHelper(Redirector)->goToRoute(array(), 'skillList');
		//$this->redirect($this->view->url(array(), 'skillList'));
    }
    
    public function listAction()
    {
        $this->view->headTitle("Liste des compétences");
        $this->view->skills = $this->skillApi->fetchAll();
    }
    
    public function readAction()
    {
    	$id = (int) $this->getRequest()->getParam('id');
    	if ($id && ! Zend_Validate::is($id, 'Digits')) {
    		$this->view->priorityMessenger('Identifiant incorrect', 'danger');
    		$this->getHelper(Redirector)->goToRoute(array(), 'skillList');
    	}    	
    	
    	$skill = $this->skillApi->find($id);
    	if (! $skill) {
    		$this->view->priorityMessenger('Erreur lors de la recherche de la compétence', 'warning');
    		$this->getHelper(Redirector)->goToRoute(array(), 'skillList');
    		//$this->redirect($this->view->url(array(), 'skillList'));
    	}    	
    	
    	$this->view->headTitle("Voir une compétence");
    	$this->view->skill = $skill;
    }
}
