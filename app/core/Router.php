<?php

class Router
{
    public function run()
    {
        $url = $_GET['url'] ?? '';

        $url = trim($url, '/');

        if ($url == '') {

            $controller = new HomeController();
            $controller->index();

            return;
        }

        $controllerName = ucfirst($url) . "Controller";

        if (class_exists($controllerName)) {

            $controller = new $controllerName();

            $controller->index();

        } else {

            die("Página não encontrada.");
        }
    }
}