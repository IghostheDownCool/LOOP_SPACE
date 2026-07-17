<?php

class Router
{
    public function run()
    {
        $url = $_GET['url'] ?? '';

        $url = trim($url, '/');

        $segments = $url === '' ? [] : explode('/', $url);

        /*
        ----------------------------------------------------------
        | Área administrativa
        ----------------------------------------------------------
        */
        if (isset($segments[0]) && $segments[0] === 'admin') {

            $controllerName = isset($segments[1])
    ? ucfirst($segments[1]) . 'Controller'
    : 'AdminHomeController';

            $controllerFile = __DIR__ . '/../controllers/admin/' . $controllerName . '.php';

            if (!file_exists($controllerFile)) {
                die('Controller administrativo não encontrado.');
            }

            require_once $controllerFile;

            $method = $segments[2] ?? 'index';

            $params = array_slice($segments, 3);
        }
        /*
        ----------------------------------------------------------
        | Área pública
        ----------------------------------------------------------
        */
        else {

            $controllerName = ucfirst($segments[0] ?? 'Home') . 'Controller';

            $method = $segments[1] ?? 'index';

            $params = array_slice($segments, 2);
        }

        if (!class_exists($controllerName)) {
            die('Controller não encontrado.');
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            die('Método não encontrado.');
        }

        call_user_func_array([$controller, $method], $params);
        // Rota para playlist pública (deve vir antes da rota genérica)
if (isset($segments[0]) && $segments[0] === 'playlists' && isset($segments[1]) && $segments[1] === 'publica') {
    $controllerName = 'PlaylistsController';
    $method = 'publica';
    $params = array_slice($segments, 2);
}
    }
    
}

