<?php

class Form_Skill_Add extends Zend_Form
{

    public function init(){
        
        $this->setAction('')
             ->setMethod(Zend_Form::METHOD_POST);
        
        // sélecteur
        $select = new Zend_Form_Element_Select('category', array(
            'label' => 'Catégorie',
            'required' => true,
            'order' => 1
        )); 

        $mapperCategory = new Model_Mapper_Category();
        $select->addMultiOptions($mapperCategory->fetchAll());
        /*
        $select->addMultiOption('1','technologies')
               ->addMultiOption('2','langages')
               ->addMultiOption('3','plateformes')
               ->addMultiOption('4','autres');
        */
        $this->addElement($select);
        
        // textarea description
        $this->addElement('textarea', 'description', array(
            'label' => 'Description',
            'required' => true,
            'order' => 2
        ));
        
        $this->getElement('description')->setAttrib('rows', 5)
                                        ->setAttrib('cols', 75)
                                        ->setAttrib('maxlength', 255);
        
        // input type texte 'level'
        $this->addElement('text', 'level', array(
            'label' => 'Niveau',
            'required' => true,
            //'validators' => array(new Zend_Validate_Alnum())),
            'order' => 3
        ));
        
        $this->getElement('level')->setAttrib('size', 75)
                                  ->setAttrib('maxLength', 150);
        
        // input type texte 'experience'
        $this->addElement('text', 'experience', array(
           'label' => 'Expérience',
           'required' => true,
           'order' => 4 
        ));
        $this->getElement('experience')->setAttrib('size', 75)
                                       ->setAttrib('maxLength', 150);
        
        // bouton
        $this->addElement('submit', 'send', array(
            'label' => 'Enregistrer',
            'class' => 'btn btn-primary',
            'order' => 5
        ));
    }
    
}