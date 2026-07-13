<?php

class Router
{
    public function run()
{
    $url = $_GET['url'] ?? '';

    $url = trim($url, '/');

    $segments = explode('/', $url);

    $controllerName = !empty($segments[0])
        ? ucfirst($segments[0]) . 'Controller'
        : 'HomeController';

    $method = $segments[1] ?? 'index';

    $params = array_slice($segments, 2);

    if (!class_exists($controllerName)) {
        die('Controller não encontrado.');
    }

    $controller = new $controllerName();

    if (!method_exists($controller, $method)) {
        die('Método não encontrado.');
    }

    call_user_func_array([$controller, $method], $params);
}
}
