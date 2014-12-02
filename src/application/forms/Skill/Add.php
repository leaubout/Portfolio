<?php

class Form_Skill_Add extends Zend_Form
{

    public function init(){
        
        $this->setAction('')
             ->setMethod(Zend_Form::METHOD_POST);
        
        $select = new Zend_Form_Element_Select('categories'); 
        //$select->addMultiOption('techno');
        
        $this->addElement($select);
        
        $this->getElement('categories')
             ->setLabel('Catégories')
             ->setOrder(1);   
        
        $this->addElement('text', 'description', array(
            'label' => 'Description',
            'required' => true,
            'order' => 2
        ));
        
        $this->addElement('text', 'level', array(
            'label' => 'Niveau',
            'required' => true,
            'validators' => array(new Zend_Validate_Alnum(array('allowWhiteSpace' => true))),
            'order' => 3
        ));
        
        $this->addElement('text', 'experience', array(
           'label' => 'Expérience',
           'required' => true,
           'order' => 4 
        ));
        
        $this->addElement('submit', 'send', array(
            'label' => 'Enregistrer',
            'class' => 'btn btn-primary',
            'order' => 5
        ));
    }
    
}