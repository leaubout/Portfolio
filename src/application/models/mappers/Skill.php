<?php

class Model_Mapper_Skill
{    
    private $dbTable;

    public function find($id)
    {
    	$rowSet = $this->getDbTable()->find($id);
    	if (count($rowSet->current()) == 0){
    	    return false;
    	}
      return $this->rowToObject($rowSet->current());
    }

    public function getDbTable(){
        if ($this->dbTable == null){
            $this->dbTable = new Model_DbTable_Skill();
        }
        return $this->dbTable;
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
        
        $skill->setCategory($row[Model_DbTable_Skill::COL_ID_CATEGORY]);
        $skill->setDescription($row[Model_DbTable_Skill::COL_DESCRIPTION]);
        $skill->setLevel($row[Model_DbTable_Skill::COL_LEVEL]);
        $skill->setExperience($row[Model_DbTable_Skill::COL_EXPERIENCE]);
        return $skill;
    }
    
    public function save($skill)
    {
        $row = $this->objectToRow($skill);
        if ((int) $skill->getId() === 0){
            unset($row[Model_DbTable_Skill::COL_ID]);
            return $this->getDbTable()->insert($row);
        } else {
            $where = array(Model_DbTable_Skill::COL_ID . ' = ?'  => $skill->getId());
            return $this->getDbTable()->update($row, $where);
        }
    }
    
    public function fetchAll($where, $order, $count, $offset){
        $rowSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
        $entities = array();
        foreach($rowSet as $row){
            $entities[] = $this->rowToObject($row);
        }
        return $entities;
    }
 
}