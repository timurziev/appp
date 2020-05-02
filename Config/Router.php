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
        $params = explode('/', $route);

        $controller = 'App\\Controllers\\' . ($params[1] ? ucfirst($params[1]) : 'Main') . 'Controller';

        $controller = new $controller;

        !$params[2] ? $controller->index() : $controller->{$params[2]}();
    }
}