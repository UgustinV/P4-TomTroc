<?php

abstract class AbstractEntity
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
}