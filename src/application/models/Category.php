<?php

class Model_Category
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->setId($id);
        $this->setName($name);
    }    
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
        return $this;
    }  
}
