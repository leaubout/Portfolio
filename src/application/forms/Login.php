<?php

class Form_Login extends Zend_Form
{
	public function init(){
		$login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login');
        $login->setRequired(true);
        
        $this->addElement($login);
        
        $this->addElement('password', 'password', array(
        		'label' => 'Password',
            	'required'  => TRUE
        ));
        
        $this->addElement('submit', 'Sign in');
    }
}
