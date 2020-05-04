<?php

namespace Config;

class Router
{
    /**
     * Manage routes
     *
     * @param string $route
     * @param array $parameters
     */
    public static function route($route)
    {
        $params = preg_split("/(\/|\?|=)/", $route);

        $controller = 'App\\Controllers\\' . ($params[1] ? ucfirst($params[1]) : 'Main') . 'Controller';

        $controller = new $controller;

        !$params[2] ? $controller->index($params[3]) : $controller->{$params[2]}($params[3]);
    }
}