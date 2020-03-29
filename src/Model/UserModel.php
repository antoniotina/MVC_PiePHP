<?php

namespace Model;

class UserModel extends \Core\ORM
{
    private $email;
    private $password;
    private $id;
    private $conn;
    private $orm;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->conn = $this->connect();
        $this->orm = new \Core\ORM();
    }

    public function register()
    {
        $this->id = $this->orm->create('users', array('email' => $this->email, 'password' => $this->password));
        echo $this->id;
    }

    public function login()
    {
        $results = $this->orm->find('users', array('WHERE' => ['email' => $this->email, 'password' => $this->password], 'ANDOR' => 'AND', 'ORDER BY' => 'id ASC', 'LIMIT' => ''));
        echo $this->orm->delete("users", 36);
        if (isset($results[0]["id"])) {
            $this->id = $results[0]["id"];
        } else {
            $this->id = 0;
        }
        return $this->id;
    }


    // TEST UPDATE
    // echo $this->orm->update('users', 38, array( 'email' => 'nordine@gayyyy'));
}
