<?php

namespace Model;

class UserModel extends \Core\Database
{
    private $email;
    private $password;
    private $conn;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->conn = $this->connect();
    }

    public function saveAction()
    {
        $insertQuery = $this->conn->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $insertQuery->bindValue(':email', $this->email);
        $insertQuery->bindValue(':password', $this->password);
        $insertQuery->execute();
    }

    public function create()
    {
        // insert into
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function read_all()
    {
    }
}
