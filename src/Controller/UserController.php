<?php

namespace Controller;

use UserModel;

class UserController extends \Core\Controller
{
    public function addAction()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        echo "This is Controller\\UserController\\addAction()" . PHP_EOL;
    }

    public function indexAction()
    {
        echo "This is Controller\\UserController\\indexAction()";
    }

    public function registerAction()
    {
        $user = new UserModel($_POST['email'], $_POST['password']);
        $user->saveAction();
    }
}

// $testExtension = new UserController();
// $testExtension->testMe();