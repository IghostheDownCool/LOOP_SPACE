<?php

class ArtistaController extends Controller
{
    // ============================================
    // MÉTODOS PÚBLICOS (VISUALIZAÇÃO)
    // ============================================

    public function ver(int $id): void
{
    // Verifica se está logado
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    $artistaModel = new Artista();
    $artista = $artistaModel->buscarCompleto($id);

    if (!$artista) {
        die('Artista não encontrado.');
    }

    // 🔥 DIAGNÓSTICO - REMOVA DEPOIS
    error_log("ArtistaController::ver() - Artista ID: " . $id . " - Nome: " . $artista['nome']);
    error_log("Usuário logado: " . $_SESSION['usuario_nome'] . " (Role: " . ($_SESSION['usuario_role'] ?? 'user') . ")");

    // Salvar no histórico de navegação (apenas para usuários comuns)
    $isAdmin = false;
    if (isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin') {
        $isAdmin = true;
    }

    if (!$isAdmin) {
        $historicoNav = new HistoricoNavegacao();
        $historicoNav->salvar(
            $_SESSION['usuario_id'],
            'artista',
            $artista['id'],
            $artista['nome'],
            '/artista/ver/' . $artista['id'],
            $artista['foto'] ?? null
        );
    }

    $musicas = $artistaModel->listarMusicas($id);
    $albuns = $artistaModel->listarAlbuns($id);

    $this->view('artistas/ver', [
        'artista' => $artista,
        'musicas' => $musicas,
        'albuns' => $albuns
    ]);
}

    public function seguir(int $id): void
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artistaModel->seguir($_SESSION['usuario_id'], $id);

        Flash::set('success', 'Você agora segue este artista!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deixarSeguir(int $id): void
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artistaModel->deixarSeguir($_SESSION['usuario_id'], $id);

        Flash::set('success', 'Você deixou de seguir este artista.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // ============================================
    // ÁREA DO ARTISTA (DASHBOARD E GERENCIAMENTO)
    // ============================================

    /**
     * Verifica se o usuário logado é artista
     */
    private function verificarArtista()
    {
        // Verifica se está logado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Verifica se o usuário é artista
        $usuarioModel = new Usuario();
        if (!$usuarioModel->isArtista($_SESSION['usuario_id'])) {
            Flash::set('danger', 'Você não tem permissão para acessar esta área.');
            header('Location: ' . BASE_URL);
            exit;
        }

        // Busca o artista do usuário
        $artista = $usuarioModel->getArtistaDoUsuario($_SESSION['usuario_id']);
        if (!$artista) {
            Flash::set('danger', 'Perfil de artista não encontrado.');
            header('Location: ' . BASE_URL);
            exit;
        }

        return $artista;
    }

    /**
     * Dashboard do Artista
     */
    public function dashboard()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $musicaModel = new Musica();
        $albumModel = new Album();
        $artistaModel = new Artista();

        // Estatísticas
        $totalMusicas = $musicaModel->contarPorArtista($artistaId);
        $totalAlbuns = $albumModel->contarPorArtista($artistaId);
        $totalReproducoes = $musicaModel->totalReproducoesPorArtista($artistaId);
        $totalSeguidores = $artistaModel->contarSeguidos($_SESSION['usuario_id']);

        // Últimas músicas adicionadas
        $ultimasMusicas = $musicaModel->listarPorArtista($artistaId);
        $ultimasMusicas = array_slice($ultimasMusicas, 0, 5);

        // Top músicas do artista
        $topMusicas = $musicaModel->listarPorArtista($artistaId);
        usort($topMusicas, function($a, $b) {
            return $b['reproducoes'] - $a['reproducoes'];
        });
        $topMusicas = array_slice($topMusicas, 0, 5);

        $this->view('artista/dashboard', [
            'artista' => $artista,
            'totalMusicas' => $totalMusicas,
            'totalAlbuns' => $totalAlbuns,
            'totalReproducoes' => $totalReproducoes,
            'totalSeguidores' => $totalSeguidores,
            'ultimasMusicas' => $ultimasMusicas,
            'topMusicas' => $topMusicas
        ]);
    }

    /**
     * Lista de músicas do artista
     */
    public function musicas()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $musicaModel = new Musica();
        $musicas = $musicaModel->listarPorArtista($artistaId);

        $this->view('artista/musicas', [
            'artista' => $artista,
            'musicas' => $musicas
        ]);
    }

    /**
     * Formulário de upload de música
     */
    public function upload()
{
    $artista = $this->verificarArtista();
    $artistaId = $artista['id'];

    $albumModel = new Album();
    $albuns = $albumModel->listarPorArtista($artistaId);

    // 🔥 Busca todos os gêneros
    $generoModel = new Genero();
    $generos = $generoModel->listar();

    $this->view('artista/upload', [
        'artista' => $artista,
        'albuns' => $albuns,
        'generos' => $generos
    ]);
}

    /**
     * Salvar nova música
     */
    public function salvarMusica()
{
    $artista = $this->verificarArtista();
    $artistaId = $artista['id'];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/artista/upload');
        exit;
    }

    $titulo = trim($_POST['titulo'] ?? '');
    $albumId = (int) ($_POST['album_id'] ?? 0);
    $numeroFaixa = (int) ($_POST['numero_faixa'] ?? 0);
    $generoId = (int) ($_POST['genero_id'] ?? 0);

    // Validações
    if (empty($titulo) || $albumId <= 0 || $numeroFaixa <= 0) {
        Flash::set('danger', 'Preencha todos os campos obrigatórios.');
        header('Location: ' . BASE_URL . '/artista/upload');
        exit;
    }

    // Verifica se o álbum pertence ao artista
    $albumModel = new Album();
    $albumArtistaId = $albumModel->getArtistaId($albumId);
    if ($albumArtistaId != $artistaId) {
        Flash::set('danger', 'Álbum inválido.');
        header('Location: ' . BASE_URL . '/artista/upload');
        exit;
    }

    // Upload do arquivo de áudio
    $arquivo = null;
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $uploadHelper = new UploadHelper();
        $arquivo = $uploadHelper->uploadMusica($_FILES['arquivo']);
        if (!$arquivo) {
            Flash::set('danger', 'Erro ao enviar o arquivo de áudio.');
            header('Location: ' . BASE_URL . '/artista/upload');
            exit;
        }
    } else {
        Flash::set('danger', 'Selecione um arquivo de áudio.');
        header('Location: ' . BASE_URL . '/artista/upload');
        exit;
    }

    // 🔥 Calcular duração automaticamente
    $caminhoArquivo = __DIR__ . '/../../public/uploads/musicas/' . $arquivo;
    $musicaModel = new Musica();
    $duracao = $musicaModel->getDuracao($caminhoArquivo);

    if ($duracao <= 0) {
        // Fallback: se não conseguir calcular, usar 0 (será atualizado depois)
        $duracao = 0;
    }

    // Busca o nome do gênero
    $genero = null;
    if ($generoId > 0) {
        $generoModel = new Genero();
        $generoData = $generoModel->buscarPorId($generoId);
        if ($generoData) {
            $genero = $generoData['nome'];
        }
    }

    // Upload da capa (opcional)
    $capa = null;
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
        $uploadHelper = new UploadHelper();
        $capa = $uploadHelper->uploadCapa($_FILES['capa']);
    }

    // Salva a música
    $result = $musicaModel->cadastrar(
        $titulo,
        $albumId,
        $numeroFaixa,
        $duracao,
        $arquivo,
        $genero
    );

    if ($result) {
        Flash::set('success', 'Música cadastrada com sucesso!');
    } else {
        Flash::set('danger', 'Erro ao cadastrar música. Tente novamente.');
    }

    header('Location: ' . BASE_URL . '/artista/musicas');
    exit;
}

    /**
     * Ativar/Desativar música
     */
    public function toggleMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        // Verifica se a música pertence ao artista
        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);
        if (!$musica || $musica['artista_id'] != $artistaId) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/artista/musicas');
            exit;
        }

        $musicaModel->toggleAtiva($id);
        Flash::set('success', 'Status da música atualizado.');
        header('Location: ' . BASE_URL . '/artista/musicas');
        exit;
    }

    /**
     * Excluir música
     */
    public function excluirMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        // Verifica se a música pertence ao artista
        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);
        if (!$musica || $musica['artista_id'] != $artistaId) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/artista/musicas');
            exit;
        }

        // Remove o arquivo
        if (!empty($musica['arquivo'])) {
            $arquivoPath = __DIR__ . '/../../public/uploads/musicas/' . $musica['arquivo'];
            if (file_exists($arquivoPath)) {
                unlink($arquivoPath);
            }
        }

        $musicaModel->excluir($id);
        Flash::set('success', 'Música excluída com sucesso.');
        header('Location: ' . BASE_URL . '/artista/musicas');
        exit;
    }

    /**
     * Lista de álbuns do artista
     */
    public function albuns()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $albumModel = new Album();
        $albuns = $albumModel->listarPorArtista($artistaId);

        $this->view('artista/albuns', [
            'artista' => $artista,
            'albuns' => $albuns
        ]);
    }

    /**
     * Formulário para criar novo álbum
     */
    public function novoAlbum()
    {
        $artista = $this->verificarArtista();

        $this->view('artista/novo-album', [
            'artista' => $artista
        ]);
    }

    /**
     * Salvar novo álbum
     */
    public function salvarAlbum()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/artista/albuns');
            exit;
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $ano = (int) ($_POST['ano'] ?? date('Y'));

        if (empty($titulo)) {
            Flash::set('danger', 'Preencha o título do álbum.');
            header('Location: ' . BASE_URL . '/artista/novo-album');
            exit;
        }

        // Upload da capa
        $capa = null;
        if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
            $uploadHelper = new UploadHelper();
            $capa = $uploadHelper->uploadCapa($_FILES['capa']);
        }

        $albumModel = new Album();
        $result = $albumModel->cadastrar($titulo, $artistaId, $ano, $capa);

        if ($result) {
            Flash::set('success', 'Álbum criado com sucesso!');
        } else {
            Flash::set('danger', 'Erro ao criar álbum. Tente novamente.');
        }

        header('Location: ' . BASE_URL . '/artista/albuns');
        exit;
    }

    /**
     * Lista de seguidores do artista
     */
    public function seguidores()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $artistaModel = new Artista();
        $seguidores = $artistaModel->listarSeguidores($artistaId);

        // Busca dados dos usuários
        $usuarioModel = new Usuario();
        $seguidoresData = [];
        foreach ($seguidores as $seguidor) {
            $usuario = $usuarioModel->buscarPorId($seguidor['usuario_id']);
            if ($usuario) {
                $seguidoresData[] = $usuario;
            }
        }

        $this->view('artista/seguidores', [
            'artista' => $artista,
            'seguidores' => $seguidoresData
        ]);
    }

        /**
     * Formulário de edição de música
     */
    public function editarMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        // Verifica se a música pertence ao artista
        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);
        if (!$musica || $musica['artista_id'] != $artistaId) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/artista/musicas');
            exit;
        }

        // Busca os álbuns do artista
        $albumModel = new Album();
        $albuns = $albumModel->listarPorArtista($artistaId);

        $this->view('artista/editar-musica', [
            'artista' => $artista,
            'musica' => $musica,
            'albuns' => $albuns
        ]);
    }

    /**
     * Atualizar música
     */
    public function atualizarMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        // Verifica se a música pertence ao artista
        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);
        if (!$musica || $musica['artista_id'] != $artistaId) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/artista/musicas');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/artista/musicas');
            exit;
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $albumId = (int) ($_POST['album_id'] ?? 0);
        $numeroFaixa = (int) ($_POST['numero_faixa'] ?? 0);
        $duracao = (int) ($_POST['duracao'] ?? 0);
        $genero = trim($_POST['genero'] ?? '');

        // Validações
        if (empty($titulo) || $albumId <= 0 || $numeroFaixa <= 0 || $duracao <= 0) {
            Flash::set('danger', 'Preencha todos os campos obrigatórios.');
            header('Location: ' . BASE_URL . '/artista/editar-musica/' . $id);
            exit;
        }

        // Verifica se o álbum pertence ao artista
        $albumModel = new Album();
        $albumArtistaId = $albumModel->getArtistaId($albumId);
        if ($albumArtistaId != $artistaId) {
            Flash::set('danger', 'Álbum inválido.');
            header('Location: ' . BASE_URL . '/artista/editar-musica/' . $id);
            exit;
        }

        // Atualiza os dados básicos
        $musicaModel->atualizar($id, $titulo, $albumId, $numeroFaixa, $duracao, $genero);

        // Upload do arquivo de áudio (opcional)
        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            $uploadHelper = new UploadHelper();
            $arquivo = $uploadHelper->uploadMusica($_FILES['arquivo']);
            if ($arquivo) {
                // Remove o arquivo antigo
                if (!empty($musica['arquivo'])) {
                    $arquivoPath = __DIR__ . '/../../public/uploads/musicas/' . $musica['arquivo'];
                    if (file_exists($arquivoPath)) {
                        unlink($arquivoPath);
                    }
                }
                $musicaModel->atualizarArquivo($id, $arquivo);
            }
        }

        // Upload da capa (opcional)
        if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
            $uploadHelper = new UploadHelper();
            $capa = $uploadHelper->uploadCapa($_FILES['capa']);
            if ($capa) {
                // Remove a capa antiga
                if (!empty($musica['capa'])) {
                    $capaPath = __DIR__ . '/../../public/uploads/capas/' . $musica['capa'];
                    if (file_exists($capaPath)) {
                        unlink($capaPath);
                    }
                }
                $musicaModel->atualizarCapa($id, $capa);
            }
        }

        Flash::set('success', 'Música atualizada com sucesso!');
        header('Location: ' . BASE_URL . '/artista/musicas');
        exit;
    }
}