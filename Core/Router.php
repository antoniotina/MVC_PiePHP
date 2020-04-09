<?php

namespace Core;

class Router
{
    static $routes;
    static $id;
    static $email;

    public static function connect($url, $route)
    {
        self::$routes[$url] = $route;
    }

    public static function get($url)
    {
        // i could do with regex \/\d+\/ for all number between two forward slashes but the point still stands
        $lastElement = explode('/', $url)[sizeof(explode('/', $url)) - 1];
        if (is_numeric($lastElement) || $lastElement == '?') {
            self::$id = $lastElement;
            $url = explode('/', $url);
            $url[sizeof($url) - 1] = "{id}";
            $url = implode('/', $url);
        }
        return array_key_exists($url, self::$routes) ? self::$routes[$url] : null;
    }
}
