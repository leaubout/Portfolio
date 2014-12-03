<?php

class Model_Mapper_Category
{
    private $tabCategories = array(
        '1' => 'technologie',
        '2' => 'langage',
        '3' => 'plateforme',
        '4' => 'autre'
    );
    
    public function getById($id){
        if (array_key_exists($id, $this->tabCategories)){
            $category = new Model_Category($id, $this->tabCategories[$id]);
        } else {
            $category = null;
        }
        return $category;
    }
    
    public function getList(){
        return $this->tabCategories;
    }
}
