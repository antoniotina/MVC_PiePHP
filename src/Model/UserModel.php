<?php

// namespace Model;

class UserModel
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    
    public function saveAction()
    {
        $dbh = new Database();
        $conn = $dbh->connect();
        $insertQuery = $conn->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $insertQuery->bindValue(':email', $this->email);
        $insertQuery->bindValue(':password', $this->password);
        $insertQuery->execute();
        // while($data = $results->fetch( PDO::FETCH_ASSOC )){ 
        //     print_r($data);
        // }
    }

    public function loginUserAction()
    {
        session_start();
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["password"] = $_POST["password"];
    }
}

// $test = new UserModel;
// $test->registerAction();