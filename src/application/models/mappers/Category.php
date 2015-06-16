<?php

class Model_Mapper_Category
{
    private $tabCategories = array(
        'Technologie', 
        'Langage', 
        'Plateforme'
    );
    
    private $tabCategoriesTechnologie = array(
        '1' => 'Zend',
        '2' => 'Symfony',
        '3' => 'Wordpress',
        '4' => 'CakePHP',
        '5' => 'Prestashop'        
    );
    
    private $tabCategoriesLangage = array(
        '6' => 'PHP',
        '7' => 'Javascript',
        '8' => 'HTML',
        '9' => 'CSS3',
        '10' => 'Less',
        '11' => 'Sass'    
    );
    
    private $tabCategoriesPlateforme = array(
        '12' => 'Linux',
        '13' => 'Windows',
        '14' => 'Mac'    
    );
    
    public function getById($id)
    {
        switch (true) {
            case array_key_exists($id, $this->tabCategoriesTechnologie):
                $category = new Model_Category($id, $this->tabCategoriesTechnologie[$id]);
                break;
            case array_key_exists($id, $this->tabCategoriesLangage):
                $category = new Model_Category($id, $this->tabCategoriesLangage[$id]);
                break;
            case array_key_exists($id, $this->tabCategoriesPlateforme):
                $category = new Model_Category($id, $this->tabCategoriesPlateforme[$id]);
                break;
            default: 
                $category = null;                                
        }
        return $category;
    }
    
    public function getList()
    {
        return $this->tabCategories;
    }
    
    public function fetchAll()
    {
        $tabSubCategories = array();
        foreach ($this->tabCategories as $categorie) {
            $var = 'tabCategories' . ucfirst($categorie);
            $tabSubCategories[$categorie] = $this->$var;
        }
        return $tabSubCategories;
    }
}
