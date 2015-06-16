<?php

class Model_DbTable_Web extends Zend_Db_Table_Abstract
{
    const TABLE_NAME = 'web';
    const COL_ID = 'id';
    const COL_TITLE = 'title';
    const COL_URL = 'url';
    const COL_FEATURE = 'feature';
    const COL_LANGUAGE = 'language';
    const COL_UPLOAD = 'upload';
    const COL_DESCRIPTION = 'description';
    const COL_TECHNOLOGY = 'technology';

    protected $_name = self::TABLE_NAME;
    protected $_primary = self::COL_ID;
}
