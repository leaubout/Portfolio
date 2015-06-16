<?php

class Model_Mapper_Skill
{    
    private $dbTable;

    public function getDbTable()
    {
    	if ($this->dbTable === null) {
    		$this->dbTable = new Model_DbTable_Skill();
    	}
    	return $this->dbTable;
    }    
    
    public function find($id)
    {
    	$rowSet = $this->getDbTable()->find($id);
    	if (count($rowSet->current()) == 0) {
    	    return false;
    	}
		return $this->rowToObject($rowSet->current());
    }

    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
    	$rowSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
    	$entities = array();
    	foreach ($rowSet as $row) {
    		$entities[] = $this->rowToObject($row);
    	}
    	return $entities;
    }    
    
    public function delete($id)
    {
    	$row = $this->getDbTable()->find($id)->current();
    	if (!$row instanceof Zend_Db_Table_Row_Abstract) {
    		return false;
    	}
    	return $row->delete();
    }
    
    public function save($skill)
    {	
    	$row = $this->objectToRow($skill);
    	if ((int) $skill->getId() === 0) {
    		unset($row[Model_DbTable_Skill::COL_ID]);
    		return $this->getDbTable()->insert($row);
    	} else {
    		$where = array(Model_DbTable_Skill::COL_ID . ' = ?'  => $skill->getId());
    		return $this->getDbTable()->update($row, $where);
    	}
    }    
    
    public function objectToRow(Model_Skill $skill)
    {
        return array(
            Model_DbTable_Skill::COL_ID => $skill->getId(),
            Model_DbTable_Skill::COL_ID_CATEGORY => $skill->getIdCategory(),
            Model_DbTable_Skill::COL_DESCRIPTION => $skill->getDescription(),
            Model_DbTable_Skill::COL_LEVEL => $skill->getLevel(),
            Model_DbTable_Skill::COL_EXPERIENCE => $skill->getExperience()
        );
    }    
    
    public function rowToObject($row)
    {
        $skill = new Model_Skill();
        
        $skill->setId($row[Model_DbTable_Skill::COL_ID]);
        
        $mapperCategory = new Model_Mapper_Category();
        $category = $mapperCategory->getById($row[Model_DbTable_Skill::COL_ID_CATEGORY]);
        $skill->setCategory($category);
        
        $skill->setDescription($row[Model_DbTable_Skill::COL_DESCRIPTION])
              ->setLevel($row[Model_DbTable_Skill::COL_LEVEL])
              ->setExperience($row[Model_DbTable_Skill::COL_EXPERIENCE]);
        
        return $skill;
    }
}
