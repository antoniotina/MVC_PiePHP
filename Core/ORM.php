<?php

namespace Core;

class ORM extends \Core\Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function create($table, $fields)
    {
        $executeArray = [];
        $query = "INSERT INTO $table (";

        foreach ($fields as $key => $value) {
            $query .= "$key ,";
        }

        $query = substr($query, 0, -2);
        $query .= ") VALUES (";

        foreach ($fields as $key => $value) {
            $query .= "?, ";
            array_push($executeArray, $value);
        }

        $query = substr($query, 0, -2);
        $query .= ")";

        $req = $this->conn->prepare($query);
        $req->execute($executeArray);
        return $this->conn->lastInsertId();
    }

    public function find($table, $params = array('WHERE' => '1', 'ORDER BY' => 'id ASC', 'LIMIT' => ''))
    {
        
    }

    public function read($table, $id)
    {

    }

    public function update($table, $id, $fields)
    {
    }

    public function delete($table, $id)
    {
    }
}
