<?php

namespace Core;

class Database
{
    private static $_db;

    public static function connect()
    {
        if($this->_db == null)
            $this->_dh = new \PDO('mysql:host=localhost;dbname=mvc_piephp', "root", "");
        return $this->_db;
    }
}
