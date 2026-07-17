<?php

class Router
{
    public function run()
    {
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $segments = $url === '' ? [] : explode('/', $url);

        // ==================================================
// ROTA PARA REGISTRAR HISTÓRICO
// ==================================================
if (isset($segments[0]) && $segments[0] === 'historico' && isset($segments[1]) && $segments[1] === 'registrar') {
    $controllerName = 'HistoricoController';
    $method = 'registrar';
    $params = isset($segments[2]) ? [$segments[2]] : [];
    
    $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
    if (!file_exists($controllerFile)) {
        die('Controller não encontrado.');
    }
    require_once $controllerFile;
    
    if (!class_exists($controllerName)) {
        die('Controller não encontrado.');
    }
    
    $controller = new $controllerName();
    if (!method_exists($controller, $method)) {
        die('Método não encontrado.');
    }
    
    call_user_func_array([$controller, $method], $params);
    return;
}

// ==================================================
// ROTAS PARA COMENTÁRIOS
// ==================================================
if (isset($segments[0]) && $segments[0] === 'comentarios') {
    if (isset($segments[1]) && $segments[1] === 'adicionar') {
        $controllerName = 'ComentariosController';
        $method = 'adicionar';
        $params = [];
    } elseif (isset($segments[1]) && $segments[1] === 'excluir' && isset($segments[2])) {
        $controllerName = 'ComentariosController';
        $method = 'excluir';
        $params = [(int) $segments[2]];
    } else {
        die('Rota de comentários inválida.');
    }
    
    $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
    if (!file_exists($controllerFile)) {
        die('Controller não encontrado.');
    }
    require_once $controllerFile;
    
    if (!class_exists($controllerName)) {
        die('Controller não encontrado.');
    }
    
    $controller = new $controllerName();
    if (!method_exists($controller, $method)) {
        die('Método não encontrado.');
    }
    
    call_user_func_array([$controller, $method], $params);
    return;
}

        // ==================================================
        // ROTA PARA PLAYLIST PÚBLICA
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'playlists' && isset($segments[1]) && $segments[1] === 'publica') {
            $controllerName = 'PlaylistsController';
            $method = 'publica';
            $params = isset($segments[2]) ? [$segments[2]] : [];
            
            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
            if (!file_exists($controllerFile)) {
                die('Controller não encontrado.');
            }
            require_once $controllerFile;
            
            if (!class_exists($controllerName)) {
                die('Controller não encontrado.');
            }
            
            $controller = new $controllerName();
            if (!method_exists($controller, $method)) {
                die('Método não encontrado.');
            }
            
            call_user_func_array([$controller, $method], $params);
            return;
        }

        // ==================================================
        // ÁREA ADMINISTRATIVA
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'admin') {
            // Se for apenas /admin ou /admin/
            if (!isset($segments[1]) || $segments[1] === '') {
                $controllerName = 'DashboardController';
                $method = 'index';
                $params = [];
            } else {
                $controllerName = ucfirst($segments[1]) . 'Controller';
                $method = $segments[2] ?? 'index';
                $params = array_slice($segments, 3);
            }
            
            $controllerFile = __DIR__ . '/../controllers/admin/' . $controllerName . '.php';

            if (!file_exists($controllerFile)) {
                die('Controller administrativo não encontrado: ' . $controllerName);
            }

            require_once $controllerFile;

            if (!class_exists($controllerName)) {
                die('Classe não encontrada: ' . $controllerName);
            }

            $controller = new $controllerName();

            if (!method_exists($controller, $method)) {
                die('Método não encontrado: ' . $method);
            }

            call_user_func_array([$controller, $method], $params);
            return;
        }

        // ==================================================
        // ÁREA PÚBLICA
        // ==================================================
        $controllerName = ucfirst($segments[0] ?? 'Home') . 'Controller';
        $method = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            die('Controller não encontrado: ' . $controllerName);
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            die('Classe não encontrada: ' . $controllerName);
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            die('Método não encontrado: ' . $method);
        }

        call_user_func_array([$controller, $method], $params);
    }
}