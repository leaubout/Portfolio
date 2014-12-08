<?php

class Model_User implements Zend_Acl_Role_Interface
{
    private $id;
    private $name;
    private $password;
    private $roleId = 'guest';
    
    public function getRoleId(){
        return $this->roleId;
    }
    
    public function setRoleId($roleId){
        $this->roleId = $roleId;
        return $this;
    }
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return (int) $this->id;
    }

	/**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

	/**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

	/**
     * @param field_type $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}