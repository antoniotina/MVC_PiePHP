<?php

namespace Core;

class Controller
{
    public static $_render;

    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $view]) . '.php';
        if (file_exists($f)) {
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
            return self::$_render;
        }
    }
    // protected function render in PDF


    // public function testMe()
    // {
    //     echo "the extension from a Controller Class to Core\\Controller is working \n";
    // }
}
