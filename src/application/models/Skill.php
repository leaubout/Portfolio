<?php

class Model_Skill
{
    /**
     * 
     * @var integer
     */
    private $id;
    
    /**
     * 
     * @var Model_Category
     */
    private $category;
    
    /**
     * 
     * @var string
     */
    private $description;
    
    /**
     * 
     * @var integer
     */
    private $level;
    
    /**
     * 
     * @var string
     */
    private $experience;

    public function __construct(array $data = null)
    {
        if ($data != null) {
        	foreach ($data as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)) {
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
     * @return the Model_Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * 
     * @return the string $category
     */
    public function getNameCategory()
    {
        return $this->getCategory()->getName();
    }
    
    /**
     * 
     * @return the integer $category
     */
    public function getIdCategory()
    {
        return $this->getCategory()->getId();
    }
    
    /**
     * 
     * @param Model_Category|integer $category
     */
    public function setCategory($category)
    {
		if ($category instanceof Model_Category) {
			$this->category = $category;
		} else {
			$mapperCategory = new Model_Mapper_Category();
			$this->category = $mapperCategory->getById($category);
		}
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
    
    public function toArray()
    {
    	return array(
    		'id' => $this->getId(),
    		'category' => $this->getNameCategory(),
    		'description' => $this->getDescription(),
    		'level' => $this->getLevel(),
    		'experience' => $this->getExperience()	
    	);
    }
}
