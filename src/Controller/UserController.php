<?php

namespace Controller;

use Model\UserModel;

class UserController extends \Core\Controller
{
    private $request;

    public function __construct()
    {
        $this->request = new \Core\Request();
    }

    public function indexAction()
    {
        echo $this->render("index");
    }

    public function showAction($id = null)
    {
        if ($id == '?') {
            $user = ['email' => "default@email.com", 'FirstName' => "John", 'LastName' => "Doe"];
        } else {
            $user = new UserModel(['id' => $id]);
        }
        echo $this->render("show", ["user" => $user]);
    }

    public function addAction()
    {
        $params = $this->request->getQueryParams();
        var_dump($params);
        if (isset($params["email"]) && isset($params["password"])) {
            $user = new \Model\UserModel($params);
            echo $user->create();
        } else {
            echo $this->render("register");
        }
    }

    public function loginAction()
    {
        $params = $this->request->getQueryParams();
        if (isset($params["email"]) && isset($params["password"])) {
            $user = new \Model\UserModel($params);
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
