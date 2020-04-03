<?php

namespace Core;

class ORM
{

    public static function create($table, $fields)
    {
        $conn = Database::connect();
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

        $req = $conn->prepare($query);
        $req->execute($executeArray);
        return $conn->lastInsertId();
    }

    // example
    // $results = $this->orm->find('users', array('WHERE' => ['email' => $this->email, 'password' => $this->password], 'ANDOR' => 'AND', 'ORDER BY' => 'id ASC', 'LIMIT' => ''));
    public static function find($table, $params = array('WHERE' => ['1' => '1'], "ANDOR" => "AND", 'ORDER BY' => 'id ASC', 'LIMIT' => ''))
    {
        $conn = Database::connect();
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

        $req = $conn->prepare($query);
        $req->execute($executeArray);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function read($table, $id)
    {
        $conn = Database::connect();
        $query = "SELECT * FROM $table WHERE id = ?";
        $req = $conn->prepare($query);
        $req->execute([$id]);
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public static function read_all($table)
    {
        $conn = Database::connect();
        $query = "SELECT * FROM ?";
        $req = $conn->prepare($query);
        $req->execute([$table]);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function update($table, $id, $fields)
    {
        // UPDATE $table SET $field[key] - $field[value] WHERE id = $id
        $conn = Database::connect();
        $query = "UPDATE $table SET ";
        $executeArray = [];
        foreach ($fields as $key => $value) {
            $query .= "$key = ? ";
            array_push($executeArray, $value);
        }

        $query .= " WHERE id = ?";
        array_push($executeArray, $id);

        $req = $conn->prepare($query);
        $req->execute($executeArray);
        return $req->rowCount();
    }

    public static function delete($table, $id)
    {
        $conn = Database::connect();
        $query = "DELETE FROM $table WHERE id = ? ";
        $req = $conn->prepare($query);
        $req->execute([intval($id)]);
        return $req->rowCount();
    }
}
