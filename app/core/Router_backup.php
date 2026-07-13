<?php

class Router
{
    public function run()
{
    $url = $_GET['url'] ?? '';

    $url = trim($url, '/');

$routes = [

    '' => HomeController::class,

    'cadastro' => CadastroController::class,

    'login' => LoginController::class,

    'logout' => LogoutController::class,

    'artistas' => ArtistasController::class

];

    if (isset($routes[$url])) {

        $controller = new $routes[$url];

        $controller->index();

        return;
    }

    die("Página não encontrada.");
}
}
