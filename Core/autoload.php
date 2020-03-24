<?php

namespace Core;

class Autoloader
{
    public function autoload($classname)
    {
        static $counter = 0;
        $path = ["./src/Model/", "./src/View", "./src/Controller/", "./Core/"];
        $extension = ".php";

        // Path of the counter, which goes through each folder one by one recursively. Exploding the subnamespaces/namespaces away to get the class. And the php extension.
        $fullPath = $path[$counter] . explode("\\", $classname)[sizeof(explode("\\", $classname)) - 1] . $extension;

        if (!file_exists($fullPath)) {
            if ($counter <= sizeof($path)) {
                $counter++;
                $this->autoload($classname);
            }
            return false;
        }

        include_once $fullPath;
    }

    public function launchAutoloader()
    {
        spl_autoload_register(array(__CLASS__, "autoload"));
    }
}

$autoLoader = new Autoloader();
$autoLoader->launchAutoloader();
