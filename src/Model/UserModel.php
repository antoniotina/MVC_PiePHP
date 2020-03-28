<?php

namespace Model;

class UserModel extends \Core\Database
{
    private $email;
    private $password;
    private $id;
    private $conn;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->conn = $this->connect();
    }

    public function register()
    {
        $orm = new \Core\ORM(); 
        $this->id = $orm->create('users', array('email' => $this->email, 'password' => $this->password));
        echo $this->id;
    }

    public function login()
    {
        $orm = new \Core\ORM(); 
        $this->id = $orm->find('users', array('email' => $this->email, 'password' => $this->password));
        return $this->id;

        // $query = $this->conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        // $query->bindValue(':email', $this->email);
        // $query->bindValue(':password', $this->password);
        // $query->execute();
        // return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function update()
    {
        // update
    }

    public function delete()
    {
        // delete
    }

    public function read_all()
    {
        // select multiple
    }
}
