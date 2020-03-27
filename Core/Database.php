<?php

Class Database
{
    // private $user ;
    // private $host;
    // private $pass ;
    // private $db;

    // public function __construct()
    // {
    //     $this->user = "root";
    //     $this->host = "localhost";
    //     $this->pass = "";
    //     $this->db = "db_blog";
    // }
    
    public function connect()
    {
        $dbh = new PDO('mysql:host=localhost;dbname=mvc_piephp', "root", "");
        return $dbh;
    }
}