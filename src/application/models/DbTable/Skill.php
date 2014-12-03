<?php

class Model_DbTable_Skill extends Zend_Db_Table_Abstract
{
    const TABLE_NAME = 'skills';
    const COL_ID = 'id';
    const COL_CATEGORY = 'id_category';
    const COL_DESCRIPTION = 'description';
    const COL_LEVEL = 'level';
    const COL_EXPERIENCE = 'experience';
    
    protected $_name = self::TABLE_NAME;
    protected $_primary = self::COL_ID;
}