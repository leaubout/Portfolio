<?php

class Form_Web_Add extends Zend_Form
{
    public function init()
    {
    	//$this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);
        
        // Title
        $this->addElement('text', 'title', array(
            'label' => 'Titre',
            'required' => true
        ));
        
        // URL
        $this->addElement('text', 'url', array(
            'label' => 'URL',
            'required' => true
        ));
        
        // Feature
        $this->addElement('text', 'feature', array(
            'label' => 'Fonctionnalité',
            'required' => true
        ));
        
        // Technology
        $this->addElement('text', 'technology', array(
            'label' => 'Technologie',
            'required' => true
        ));
        
        // Upload Picture
        $this->addElement('file', 'upload', array(
            'label' => 'Téléchargement d\'image',
            //'destination' => SRC_PATH . '/public/uploads',
            'validators' => array(
                array(
                    'validator' => 'count',
                    'options' => array(
                        '1'
                    )
                ),
                array(
                    'validator' => 'size',
                    'options' => array(
                        '102400'
                    )
                ),
                array(
                    'validator' => 'extension',
                    'options' => array(
                        'jpg,png,gif'
                    )
                )
            )
        ));
        
        // Language
        $this->addElement('text', 'language', array(
            'label' => 'Langage',
            'required' => true
        ));
        
        // Message
        $this->addElement('textarea', 'description', array(
            'label' => 'Description'
        ));
        
        // Submit
        $this->addElement('submit', 'send');
    }
}
