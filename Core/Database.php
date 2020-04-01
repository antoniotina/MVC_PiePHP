<?php

namespace Core;

class Database
{
    private static $_db;

    public static function connect()
    {
        if(self::$_db == null)
            self::$_db = new \PDO('mysql:host=localhost;dbname=mvc_piephp', "root", "");
        return self::$_db;
    }
}
