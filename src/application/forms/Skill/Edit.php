<?php

class Form_Skill_Edit extends Form_Skill_Add
{
    public function init()
    {
        parent::init();
        
        $this->addElement('hidden', 'id', array(
           'required' => true,
           'validators' => array('int')  
        ));
    }
}