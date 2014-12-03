<?php

class Form_Contact extends Zend_Form
{
    public function init(){
        $this->setAction('');
        $this->setMethod(Zend_Form::METHOD_POST);
        //Nom / email / sujet / message
        //Name
        $this->addElement('text', 'name', array(
           'label' => 'Nom',
           'placeholder' => 'John Doe',
           'required' => true,
           'filters' => array('alnum'),
           'validators' => array(
                array(
                    'validator' =>'alpha',
                    'options' => array(
                        'allowWhiteSpace' => true
                    )
                )
            ),
           //'validators' => array(new Zend_Validate_Alnum(array('allowWhiteSpace' => true))),
           'order' => 1  
        ));

        // Email
        $this->addElement('text', 'email');
        $this->getElement('email')
               ->setLabel('Mail')
               ->setAttrib('placeholder', 'john.doe@gmail.com')
               ->setRequired(true)
               ->addValidator(new Zend_Validate_EmailAddress())
               ->setOrder(2);
        
        $this->addElement('text', 'subject', array(
            'label' => 'Sujet',
            'placeholder' => 'prise de contact',
            'required' => true,
            'validators' => array(new Zend_Validate_Alnum(array('allowWhiteSpace' => true))),
            'order' => 3
        ));
        
        $this->addElement('text', 'company', array(
           'label' => 'Société',
           'order' => 4 
        ));
        
        // textArea
        /*$text = new Zend_Form_Element_Textarea('message');
        $this->addElement($text);
        $this->getElement('message')
             ->setLabel('Message')
             ->setAttrib('placeholder', 'Saisissez ici votre message.')
             ->setRequired('true')
             ->setOrder(4);     
        */
        
        $this->addElement('textarea', 'message', array(
            'label' => 'Message',
            'order' => 5
        ));
        
        $this->addElement('submit', 'send', array(
            'label' => 'Envoyer',
            'class' => 'btn btn-primary',
            'order' => 6
        ));
        
    }
}