<?php

class Form_Skill_Add extends Zend_Form
{
    public function init()
    {
        // select category
        $select = new Zend_Form_Element_Select('category', array(
            'label' => 'Catégorie',
            'required' => true,
            'order' => 1
        )); 

        $mapperCategory = new Model_Mapper_Category();
        $select->addMultiOptions($mapperCategory->fetchAll());
        $this->addElement($select);
        
        // textarea description
        $this->addElement('textarea', 'description', array(
            'label' => 'Description',
            'required' => true,
            'order' => 2
        ));
        $this->getElement('description')
        	 ->setAttrib('rows', 5)
             ->setAttrib('cols', 75)
             ->setAttrib('maxlength', 255);
        
        // input type texte level
        $this->addElement('text', 'level', array(
            'label' => 'Niveau',
            'required' => true,
            'validators' => array(new Zend_Validate_Digits()),
            'order' => 3
        ));
        
        // input type texte experience
        $this->addElement('text', 'experience', array(
           'label' => 'Expérience',
           'required' => true,
           'order' => 4 
        ));
        $this->getElement('experience')
        	 ->setAttrib('size', 75)
        	 ->setAttrib('maxLength', 150);
        
        // button
        $this->addElement('submit', 'send', array(
            'label' => 'Enregistrer',
            'class' => 'btn btn-primary',
            'order' => 5
        ));
    }    
}
