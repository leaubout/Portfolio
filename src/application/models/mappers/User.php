<?php

class Model_Mapper_User
{
    private $dbTable;
    
    public function find($id){
        $rowSet = $this->getDbTable()->find($id);
        if (0 == count($rowSet->current())){
            return false;
        }
        return $this->rowToObject($rowSet->current());
    }
    
    public function fetchAll($where = null, $order = null, $count = null, $offset = null){
        $rowSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
        $entities = array();
        foreach($rowSet as $row){
            $entities[] = $this->rowToObject($row);
        }
        return $entities;
    }
    
    public function delete($id)
    {
        $row =$this->getDbTable()->find($id)->current();
        if (!$row instanceof Zend_Db_Table_Row_Abstract){
            return false;
        }
        return $row->delete();
    }    
    
    public function save($user)
    {
        $row = $this->objectToRow($user);
        if ((int) $user->getId() === 0){
            unset($row[Model_DbTable_User::COL_ID]);
            return $this->getDbTable()->insert($row);
        }else{
            $where = array(Model_DbTable_User::COL_ID . ' = ?'  => $user->getId());
            return $this->getDbTable()->update($row, $where);
        }
    }
    
    public function getDbTable(){
        if ($this->dbTable === null){
            $this->dbTable = new Model_DbTable_User();
        }
        return $this->dbTable;
    }
    
    public function objectToRow($user){
        return array(
          Model_DbTable_User::COL_ID => $user->getId(),
          Model_DbTable_User::COL_LOGIN => $user->getName(),
          Model_DbTable_User::COL_PASSWORD => $user->getPassword()
        );
    }
    
    public function rowToObject($row){
        $user = new Model_User; 
        $user->setId($row[Model_DbTable_User::COL_ID]);
        $user->setName($row[Model_DbTable_User::COL_LOGIN]);
        $user->setPassword($row[Model_DbTable_User::COL_PASSWORD]);
        return $user;
    }
    
}