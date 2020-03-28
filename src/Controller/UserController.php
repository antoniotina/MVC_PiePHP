<?php

namespace Controller;

class UserController extends \Core\Controller
{
    private $cleanedHTTP;

    public function __construct()
    {
        $this->cleanedHTTP = new \Core\Request();
        // $this->cleanedHTTP->POST;
    }

    public function indexAction()
    {
        echo $this->render("index");
    }

    public function addAction()
    {
        if (isset($this->cleanedHTTP->POST["email"]) && isset($this->cleanedHTTP->POST["password"])) {
            $user = new \Model\UserModel($this->cleanedHTTP->POST['email'], $this->cleanedHTTP->POST['password']);
            echo $user->register();
        } else {
            echo $this->render("register");
        }
    }

    public function loginAction()
    {
        if (isset($this->cleanedHTTP->POST["email"]) && isset($this->cleanedHTTP->POST["password"])) {
            $user = new \Model\UserModel($this->cleanedHTTP->POST['email'], $this->cleanedHTTP->POST['password']);
            if ($user->login()) {
                echo "user is logged in";
            } else {
                echo "user not logged in";
            }
        } else {
            echo $this->render("login");
        }
    }
}
