<?php

namespace Controller;

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
}

// $testExtension = new UserController();
// $testExtension->testMe();