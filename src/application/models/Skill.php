<?php

class Model_Skill
{
    private $id;
    private $category;
    private $description;
    private $level;
    private $experience;

    public function __construct(array $data = null)
    {
       
        if ($data != null){
            foreach($data as $key => $value){
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)){
                    $this->$methodName($value);
                }
            }            
        }
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
     * @return the $category
     */
    public function getCategory()
    {
        return $this->category->getName();
    }
    
    public function getIdCategory(){
        return $this->category->getId();
    }
    
    /**
     * @param field_type $category
     */
    public function setCategory($idCategory)
    {
        $mapperCategory = new Model_Mapper_Category();
        $this->category = $mapperCategory->getById($idCategory);
        return $this;
       
    }
    
	/**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

	/**
     * @param field_type $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

	/**
     * @return the $level
     */
    public function getLevel()
    {
        return $this->level;
    }

	/**
     * @param field_type $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

	/**
     * @return the $experience
     */
    public function getExperience()
    {
        return $this->experience;
    }

	/**
     * @param field_type $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
        return $this;
    }
}