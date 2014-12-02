<?php

class Model_DbTable_User extends Zend_Db_Table_Abstract
{
    const TABLE_NAME = 'user';
    const COL_ID = 'id';
    const COL_LOGIN = 'login';
    const COL_PASSWORD = 'password';
    
    protected $_name = self::TABLE_NAME;
    protected $_primary = self::COL_ID;
}
