<?php

class Model_Mapper_Web
{
    private $dbTable;

    public function getDbTable()
    {
    	if ($this->dbTable === null) {
    		$this->dbTable = new Model_DbTable_Web();
    	}
    	return $this->dbTable;
    }    
    
    public function find($id)
    {
        $rowSet = $this->getDbTable()->find($id);
        if (0 == count($rowSet->current())) {
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
        if (! $row instanceof Zend_Db_Table_Row_Abstract) {
            return false;
        }
        return $row->delete();
    }

    public function save($web)
    {
        $row = $this->objectToRow($web);
        if ((int) $web->getId() === 0) {
            unset($row[Model_DbTable_Web::COL_ID]);
            return $this->getDbTable()->insert($row);
        } else {
            $where = array(
                Model_DbTable_Web::COL_ID . ' = ?' => $web->getId()
            );
            return $this->getDbTable()->update($row, $where);
        }
    }

    public function objectToRow(Model_Web $web)
    {
        return array(
			Model_DbTable_Web::COL_ID => $web->getId(),
            Model_DbTable_Web::COL_TITLE => $web->getTitle(),
            Model_DbTable_Web::COL_URL => $web->getUrl(),
            Model_DbTable_Web::COL_FEATURE => $web->getFeature(),
            Model_DbTable_Web::COL_LANGUAGE => $web->getLanguage(),
        	Model_DbTable_Web::COL_UPLOAD => $web->getUpload(),
        	Model_DbTable_Web::COL_DESCRIPTION => $web->getDescription(),
            Model_DbTable_Web::COL_TECHNOLOGY => $web->getTechnology()
        );
    }

    public function rowToObject($row)
    {
        $web = new Model_Web();
        
        $web->setId($row[Model_DbTable_Web::COL_ID])
        	->setTitle($row[Model_DbTable_Web::COL_TITLE])
        	->setUrl($row[Model_DbTable_Web::COL_URL])
        	->setFeature($row[Model_DbTable_Web::COL_FEATURE])
        	->setLanguage($row[Model_DbTable_Web::COL_LANGUAGE])
        	->setUpload($row[Model_DbTable_Web::COL_UPLOAD])
        	->setDescription($row[Model_DbTable_Web::COL_DESCRIPTION])
        	->setTechnology($row[Model_DbTable_Web::COL_TECHNOLOGY]);
        
        return $web;
    }
}
