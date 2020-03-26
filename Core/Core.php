<?php

namespace Core;

use Core\Router;

class Core
{
    public function __construct()
    {
        require_once("src/routes.php");
    }

    public function run()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        $this->urlDecompose();
    }

    private function urlDecompose()
    {
        // Gets everything from the URL AFTER the root folder MVC_PiePHP
        $decomposedUrl = explode("MVC_PiePHP", $_SERVER["REQUEST_URI"]);

        // Checks if this URL already exists in the static router, if so, executes it
        // Else, deconstructs the URL and executes the class(if it exists, 404 if it doesnt) AND executes the method in the URL(if it exists, indexAction if it doesn't or if it's empty)
        if (($route = Router::get($decomposedUrl[1])) != null) {

            $class = "Controller\\" . ucfirst($route["controller"]) . "Controller";
            $classInstance = new $class;
            $action = $route["action"] . "Action";
            $classInstance->$action();
        } else {
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
}
