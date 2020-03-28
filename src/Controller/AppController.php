<?php

namespace Controller;

class AppController extends \Core\Controller
{
    private $requestObj;

    public function __construct()
    {
        $this->requestObj = new \Core\Request();
    }
    
    public function addAction()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        echo "This is Controller\\AppController\\addAction()" . PHP_EOL;
    }

    public function indexAction()
    {
        echo $this->render("index");
        // show all users and links to register.php/login.php
        // echo "This is Controller\\AppController\\indexAction()";
    }
}
