<?php

namespace Core;

class ORM
{
    private $conn;

    public function __construct()
    {
        $this->conn = \Core\Database::connect();
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

    // example
    // $results = $this->orm->find('users', array('WHERE' => ['email' => $this->email, 'password' => $this->password], 'ANDOR' => 'AND', 'ORDER BY' => 'id ASC', 'LIMIT' => ''));
    public function find($table, $params = array('WHERE' => ['1' => '1'], "ANDOR" => "AND", 'ORDER BY' => 'id ASC', 'LIMIT' => ''))
    {
        $executeArray = [];
        $query = "SELECT * FROM $table WHERE ";

        foreach ($params["WHERE"] as $key => $value) {
            $query .= "$key = ? " . $params['ANDOR'] . " ";
            array_push($executeArray, $value);
        }

        $query = substr($query, 0, -5);
        $query .= " ORDER BY ? ";
        array_push($executeArray, $params["ORDER BY"]);
        if ($params["LIMIT"] != "") {
            $query .= " LIMIT ? ";
            array_push($executeArray, $params["LIMIT"]);
        }

        $req = $this->conn->prepare($query);
        $req->execute($executeArray);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function read($table, $id)
    {
        $query = "SELECT * FROM $table WHERE id = ?";
        $req = $this->conn->prepare($query);
        $req->execute([$id]);
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $fields)
    {
        // UPDATE $table SET $field[key] - $field[value] WHERE id = $id
        $query = "UPDATE $table SET ";
        $executeArray = [];
        foreach ($fields as $key => $value) {
            $query .= "$key = ? ";
            array_push($executeArray, $value);
        }

        $query .= " WHERE id = ?";
        array_push($executeArray, $id);

        $req = $this->conn->prepare($query);
        $req->execute($executeArray);
        return $req->rowCount();
    }

    public function delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE id = ? ";
        $req = $this->conn->prepare($query);
        $req->execute([intval($id)]);
        return $req->rowCount();
    }
}
