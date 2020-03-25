<?php

namespace Core;

class Core
{
    public function run()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        $this->urlDecompose();
    }

    private function urlDecompose()
    {
        $decomposedUrl = explode("MVC_PiePHP", $_SERVER["REQUEST_URI"]);
        $decomposedUrl = array_values(array_filter(explode("/", $decomposedUrl[1])));

        if (sizeof($decomposedUrl) == 1) {
            $class = $decomposedUrl[0];
            $action = "IndexAction";
        } elseif (sizeof($decomposedUrl) == 0) {
            $class = "App";
            $action = "IndexAction";
        } else {
            $class = $decomposedUrl[sizeof($decomposedUrl) - 2];
            $action = $decomposedUrl[sizeof($decomposedUrl) - 1] . "Action";
        }

        $controller = "controller\\" . ucfirst($class) . "Controller";

        // Creates an instance of the object given through the url
        if (class_exists($controller)) {
            $classInstance = new $controller();

            // Checks if the method exists, if it doesn't, displays a 404 error
            if (method_exists($classInstance, $action)) {
                $classInstance->$action();
            } else {
                $action = "IndexAction";
                $classInstance->$action();
            }
        } else {
            echo "404 - Class not found\n";
        }
    }
}
