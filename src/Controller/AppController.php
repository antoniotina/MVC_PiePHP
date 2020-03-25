<?php

namespace Controller;

class AppController extends \Core\Controller
{
    public function addAction()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        echo "This is Controller\\AppController\\addAction()" . PHP_EOL;
    }

    public function indexAction()
    {
        echo "This is Controller\\AppController\\indexAction()";
    }
}

// $testExtension = new AppController();
// $testExtension->testMe();