<?php

namespace Core;

class Database
{
    public function connect()
    {
        $dbh = new \PDO('mysql:host=localhost;dbname=mvc_piephp', "root", "");
        return $dbh;
    }
}
