<?php

class Service_Skill
{
    private $skillMapper;
    
    public function getSkillMapper(){
        if (null === $this->skillMapper){
            $this->skillMapper = new Model_Mapper_Skill();
        }
        return $this->skillMapper;
    }
    
    public function find($id){
        return $this->getSkillMapper()->find($id);
    }
    
    public function save(Model_Skill $skill) {
        return $this->getSkillMapper()->save($skill);
    }
    
    public function fetchAll($where = null, $order = null, $count = null, $offset = null){
        return $this->getSkillMapper()->fetchAll($where, $order, $count, $offset);
    }
    
    
    
}