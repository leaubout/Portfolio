<?php

class Service_Web
{
    private $webMapper;

    public function getWebMapper()
    {
        if (null === $this->webMapper) {
            $this->webMapper = new Model_Mapper_Web();
        }
        return $this->webMapper;
    }

    public function find($id)
    {
    	/*
        $cache = Zend_Controller_Front::getInstance()
            ->getParam('bootstrap')
            ->getResource('cachemanager')
            ->getCache('data1');
        
        if (! $web = $cache->load('web' . $id)) {
            $web = $this->getWebMapper()->find($id);
            $cache->save($web);
        }
        return $web;
        */
    	return $this->getWebMapper()->find($id);
    }

    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        return $this->getWebMapper()->fetchAll($where, $order, $count, $offset);
    }

    public function delete($id)
    {
        return $this->getWebMapper()->delete($id);
    }

    public function save($web)
    {
        return $this->getWebMapper()->save($web);
    }
}
