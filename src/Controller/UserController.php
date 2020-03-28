<?php

namespace Controller;

use UserModel;

class UserController extends \Core\Controller
{
    public function indexAction()
    {
        echo $this->render("index");
    }

    public function addAction()
    {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $user = new UserModel($_POST['email'], $_POST['password']);
            $user->saveAction();
        } else {
            echo $this->render("register");
        }
    }

    public function loginAction()
    {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $user = new UserModel($_POST['email'], $_POST['password']);
            $user->saveAction();
        } else {
            echo $this->render("login");
        }
    }
}

// $testExtension = new UserController();
// $testExtension->testMe();
