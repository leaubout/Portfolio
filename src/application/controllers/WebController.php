<?php

class WebController extends Zend_Controller_Action
{
	protected $webApi;

	public function init()
	{
		$this->webApi = new Service_Web();
	}	
	
    public function indexAction()
    {
    	$this->view->headTitle("Webographie");
    	$this->view->webs = $this->webApi->fetchAll();        
    }
    
    public function addAction()
    {
    	$form = new Form_Web_Add();
    	
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($this->getRequest()->getPost())) {
    			$upload = new Zend_File_Transfer_Adapter_Http();
    			$upload->setDestination(SRC_PATH . '/public/uploads');
    			try {
    				if ($upload->receive()) {
    					echo "ça a marché !<br>";
    					echo($upload->getFileName());
    				} else {
    					echo "ben non.";
    				}
    				exit(0);    				
    			} catch (Zend_File_Transfer_Exception $e) {
    				$e->getMessage();
    			}

    			$web = new Model_Web($form->getValidValues($this->getRequest()->getPost()));
/*    	
    			$web->setTitle($form->getValue('title'))
    				->setUrl($form->getValue('url'))
    				->setFeature($form->getValue('feature'))
    				->setLanguage($form->getValue('language'))
    				->setUpload($form->getValue('upload'))
    				->setDescription($form->getValue('description'))
    				->setTechnology($form->getValue('technology'));
*/    			var_dump($web);exit(0);
    			if ($this->webApi->save($web)) {
    				$this->view->priorityMessenger('Nouvelle entrée dans la webographie enregistrée.', 'success');
    				$this->redirect($this->view->url(array(), 'webList'));
    			} else {
    				$this->view->priorityMessenger('La création a échoué.', 'danger');
    			}
    		}
    	}
    	$this->view->form = $form;        
    }
    
    public function editAction()
    {
    	$id = $this->getRequest()->getParam('id');
    	if ($id && ! Zend_Validate::is($id, 'Digits')) {
    		$this->view->priorityMessenger('Identifiant incorrect', 'danger');
    		$this->redirect($this->view->url(array(), 'webList'));
    	}
    	
    	$web = $this->webApi->find($id);
    	if (! $web) {
    		$this->view->priorityMessenger('Entrée inexistante', 'warning');
    		$this->redirect($this->view->url(array(), 'webList'));
    	}
    	
    	$form = new Form_Web_Edit();
    	
    	$form->populate(array(
    			'id' => $web->getId(), // rajout de LB
    			'title' => $web->getTitle(),
    			'url' => $web->getUrl(),
    			'feature' => $web->getFeature(),
    			'upload' => $web->getUpload(),
    			'language' => $web->getLanguage(),
    			'description' => $web->getDescription(),
    			'technology' => $web->getTechnology()
    	));
    	
    	if ($this->getRequest()->isPost()) {
    		$data = $this->getRequest()->getPost();
    		foreach ($data as $key => $value) {
    			if (empty($value)) {
    				unset($data[$key]);
    			}
    		}
    		if ($form->isValidPartial($data)) {
    	
    			$web->setTitle($form->getValue('title'))
    			    ->setUrl($form->getValue('url'))
    			    ->setFeature($form->getValue('feature'))
    			    ->setLanguage($form->getValue('language'))
    				->setUpload($form->getValue('upload'))
    				->setDescription($form->getValue('description'))
    				->setTechnology($form->getValue('technology'));
    	
    			if ($this->webApi->save($web)) {
    				$this->view->priorityMessenger('Element modifié', 'success');
    				$this->redirect($this->view->url(array(), 'webList'));
    			} else {
    				$this->view->priorityMessenger('La modification a échoué', 'danger');
    			}
    		}
    	}
    	
    	$this->view->form = $form;        
    }
    
    public function deleteAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    	
    	$id = $this->getRequest()->getParam('id');
    	if ($id && ! Zend_Validate::is($id, 'Digits')) {
    		$this->view->priorityMessenger('Identifiant incorrect', 'danger');
    		$this->redirect($this->view->url(array(), 'webList'));
    	}
    	
    	if ($this->webApi->delete($id)) {
    		$this->view->priorityMessenger('Elément supprimé', 'success');
    	} else {
    		$this->view->priorityMessenger('Echec Suppression', 'danger');
    	}
    	$this->redirect($this->view->url(array(), 'webList'));        
    }
    
    public function listAction()
    {
    	$this->view->headTitle("Liste des réalisations web");
    	$this->view->webs = $this->webApi->fetchAll();    	
    }
}
