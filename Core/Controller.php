<?php

namespace Core;

class Controller
{
    public static $_render;

    // Have to implement a way to read what's in the thingy to then 
    // dynamically do different things in the render

    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $view]) . '.php';
        if (file_exists($f)) {
            ob_start();
            $templating = new \Core\TemplateEngine();
            echo $templating->replace($f, $scope);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
            return self::$_render;
        }
    }
}
