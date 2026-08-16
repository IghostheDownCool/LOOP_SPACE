<?php

class Router
{
    public function run()
    {
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $segments = $url === '' ? [] : explode('/', $url);

        // ==================================================
        // ROTA PARA LOGIN
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'login') {
            if (isset($segments[1]) && $segments[1] === 'logar') {
                $controllerName = 'LoginController';
                $method = 'logar';
                $params = [];
            } else {
                $controllerName = 'LoginController';
                $method = 'index';
                $params = [];
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
        // ROTA PARA CADASTRO
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'cadastro') {
            if (isset($segments[1]) && $segments[1] === 'cadastrar') {
                $controllerName = 'CadastroController';
                $method = 'cadastrar';
                $params = [];
            } else {
                $controllerName = 'CadastroController';
                $method = 'index';
                $params = [];
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
        // ROTAS PARA PERFIL
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'perfil') {
            if (isset($segments[1]) && $segments[1] === 'atualizarNome') {
                $controllerName = 'PerfilController';
                $method = 'atualizarNome';
                $params = [];
            } elseif (isset($segments[1]) && $segments[1] === 'atualizarSenha') {
                $controllerName = 'PerfilController';
                $method = 'atualizarSenha';
                $params = [];
            } elseif (isset($segments[1]) && $segments[1] === 'atualizarAvatar') {
                $controllerName = 'PerfilController';
                $method = 'atualizarAvatar';
                $params = [];
            } elseif (isset($segments[1]) && $segments[1] === 'removerAvatar') {
                $controllerName = 'PerfilController';
                $method = 'removerAvatar';
                $params = [];
            } else {
                $controllerName = 'PerfilController';
                $method = 'index';
                $params = [];
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
        // ROTA PARA ARTISTAS SEGUIDOS
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'seguindo') {
            $controllerName = 'SeguindoController';
            $method = $segments[1] ?? 'index';
            $params = array_slice($segments, 2);
            
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
        // ROTA PARA LISTA DE ARTISTAS
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'artistas' && !isset($segments[1])) {
            $controllerName = 'ArtistasController';
            $method = 'index';
            $params = [];
            
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
        // ROTA PARA GÊNEROS
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'generos') {
            $controllerName = 'GeneroController';
            $method = 'index';
            $params = [];
            
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

        // Rota para gênero específico
        if (isset($segments[0]) && $segments[0] === 'genero' && isset($segments[1])) {
            $controllerName = 'GeneroController';
            $method = 'ver';
            $params = [urldecode($segments[1])];
            
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
        // ROTA PARA PLAYER COM FILTRO POR GÊNERO
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'player' && isset($segments[1]) && $segments[1] === 'genero' && isset($segments[2])) {
            $controllerName = 'PlayerController';
            $method = 'index';
            $params = [urldecode($segments[2])];
            
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

            if (!isset($segments[1]) || $segments[1] === '') {

                $controllerName = 'DashboardController';
                $method = 'index';
                $params = [];

            } elseif (isset($segments[1]) && $segments[1] === 'usuarios') {

                $controllerName = 'UsuariosController';
                $method = $segments[2] ?? 'index';
                $params = array_slice($segments, 3);

            // ==================================================
            // ROTAS ADMINISTRATIVAS PARA MÚSICAS
            // ==================================================
            } elseif ($segments[1] === 'musicas' && isset($segments[2]) && $segments[2] === 'ativar' && isset($segments[3])) {

                $controllerName = 'MusicasController';
                $method = 'ativar';
                $params = [(int) $segments[3]];

            } elseif ($segments[1] === 'musicas' && isset($segments[2]) && $segments[2] === 'desativar' && isset($segments[3])) {

                $controllerName = 'MusicasController';
                $method = 'desativar';
                $params = [(int) $segments[3]];

            } elseif ($segments[1] === 'musicas' && isset($segments[2]) && $segments[2] === 'excluir' && isset($segments[3])) {

                $controllerName = 'MusicasController';
                $method = 'excluir';
                $params = [(int) $segments[3]];

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
        // ROTAS PARA ÁREA DO ARTISTA
        // ==================================================
        if (isset($segments[0]) && $segments[0] === 'artista') {
            
            // 🔥 NOVA ROTA: /artista/ver/{id}
            if (isset($segments[1]) && $segments[1] === 'ver' && isset($segments[2])) {
                $controllerName = 'ArtistaController';
                $method = 'ver';
                $params = [(int) $segments[2]];
                
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
            
            if (!isset($segments[1]) || $segments[1] === 'dashboard') {
                $controllerName = 'ArtistaController';
                $method = 'dashboard';
                $params = [];
            } elseif ($segments[1] === 'musicas') {
                $controllerName = 'ArtistaController';
                $method = 'musicas';
                $params = [];
            } elseif ($segments[1] === 'upload') {
                $controllerName = 'ArtistaController';
                $method = 'upload';
                $params = [];
            } elseif ($segments[1] === 'salvar-musica') {
                $controllerName = 'ArtistaController';
                $method = 'salvarMusica';
                $params = [];
            } elseif ($segments[1] === 'editar-musica' && isset($segments[2])) {
                $controllerName = 'ArtistaController';
                $method = 'editarMusica';
                $params = [(int) $segments[2]];
            } elseif ($segments[1] === 'atualizar-musica' && isset($segments[2])) {
                $controllerName = 'ArtistaController';
                $method = 'atualizarMusica';
                $params = [(int) $segments[2]];
            } elseif ($segments[1] === 'toggle-musica' && isset($segments[2])) {
                $controllerName = 'ArtistaController';
                $method = 'toggleMusica';
                $params = [(int) $segments[2]];
            } elseif ($segments[1] === 'excluir-musica' && isset($segments[2])) {
                $controllerName = 'ArtistaController';
                $method = 'excluirMusica';
                $params = [(int) $segments[2]];
            } elseif ($segments[1] === 'albuns') {
                $controllerName = 'ArtistaController';
                $method = 'albuns';
                $params = [];
            } elseif ($segments[1] === 'novo-album') {
                $controllerName = 'ArtistaController';
                $method = 'novoAlbum';
                $params = [];
            } elseif ($segments[1] === 'salvar-album') {
                $controllerName = 'ArtistaController';
                $method = 'salvarAlbum';
                $params = [];
            } elseif ($segments[1] === 'seguidores') {
                $controllerName = 'ArtistaController';
                $method = 'seguidores';
                $params = [];
            } else {
                $controllerName = 'ArtistaController';
                $method = 'dashboard';
                $params = [];
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
        // ÁREA PÚBLICA (FALLBACK)
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