<?php

class ArtistaController extends Controller
{

    public function ver(int $id): void
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    $artistaModel = new Artista();
    $artista = $artistaModel->buscarCompleto($id);

    if (!$artista) {
        die('Artista não encontrado.');
    }

    error_log("ArtistaController::ver() - Artista ID: " . $id . " - Nome: " . $artista['nome']);
    error_log("Usuário logado: " . $_SESSION['usuario_nome'] . " (Role: " . ($_SESSION['usuario_role'] ?? 'user') . ")");

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

    $filaMusicas = array_column($musicas, 'id');

    $this->view('artistas/ver', [
        'artista' => $artista,
        'musicas' => $musicas,
        'albuns' => $albuns,
        'filaMusicas' => $filaMusicas
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

    private function verificarArtista()
    {

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $usuarioModel = new Usuario();

        if (!$usuarioModel->isArtista($_SESSION['usuario_id'])) {
            Flash::set('danger', 'Você não tem permissão para acessar esta área.');
            header('Location: ' . BASE_URL);
            exit;
        }

        $artista = $usuarioModel->getArtistaDoUsuario($_SESSION['usuario_id']);

        if (!$artista) {
            Flash::set('danger', 'Perfil de artista não encontrado.');
            header('Location: ' . BASE_URL);
            exit;
        }

        return $artista;
    }

    public function dashboard()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $musicaModel = new Musica();
        $albumModel = new Album();
        $artistaModel = new Artista();

        $totalMusicas = $musicaModel->contarPorArtista($artistaId);
        $totalAlbuns = $albumModel->contarPorArtista($artistaId);
        $totalReproducoes = $musicaModel->totalReproducoesPorArtista($artistaId);
        $totalSeguidores = $artistaModel->contarSeguidos($_SESSION['usuario_id']);

        $ultimasMusicas = $musicaModel->listarPorArtista($artistaId);
        $ultimasMusicas = array_slice($ultimasMusicas, 0, 5);

        $topMusicas = $musicaModel->listarPorArtista($artistaId);

        usort($topMusicas, function ($a, $b) {
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

    public function upload()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $albumModel = new Album();
        $albuns = $albumModel->listarPorArtista($artistaId);

        $generoModel = new Genero();
        $generos = $generoModel->listar();

        $this->view('artista/upload', [
            'artista' => $artista,
            'albuns' => $albuns,
            'generos' => $generos
        ]);
    }

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

        if (empty($titulo) || $albumId <= 0 || $numeroFaixa <= 0) {
            Flash::set('danger', 'Preencha todos os campos obrigatórios.');
            header('Location: ' . BASE_URL . '/artista/upload');
            exit;
        }

        $albumModel = new Album();
        $albumArtistaId = $albumModel->getArtistaId($albumId);

        if ($albumArtistaId != $artistaId) {
            Flash::set('danger', 'Álbum inválido.');
            header('Location: ' . BASE_URL . '/artista/upload');
            exit;
        }

        $arquivo = null;

        if (
            isset($_FILES['arquivo']) &&
            $_FILES['arquivo']['error'] === UPLOAD_ERR_OK
        ) {
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

        $caminhoArquivo = __DIR__ . '/../../public/uploads/musicas/' . $arquivo;

        $musicaModel = new Musica();
        $duracao = $musicaModel->getDuracao($caminhoArquivo);

        if ($duracao <= 0) {
            $duracao = 0;
        }

        $genero = null;

        if ($generoId > 0) {
            $generoModel = new Genero();
            $generoData = $generoModel->buscarPorId($generoId);

            if ($generoData) {
                $genero = $generoData['nome'];
            }
        }

        $capa = null;

        if (
            isset($_FILES['capa']) &&
            $_FILES['capa']['error'] === UPLOAD_ERR_OK
        ) {
            $uploadHelper = new UploadHelper();
            $capa = $uploadHelper->uploadCapa($_FILES['capa']);
        }

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

    public function toggleMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

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

    public function excluirMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);

        if (!$musica || $musica['artista_id'] != $artistaId) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/artista/musicas');
            exit;
        }

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

    public function novoAlbum()
    {
        $artista = $this->verificarArtista();

        $this->view('artista/novo-album', [
            'artista' => $artista
        ]);
    }

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

        $capa = null;

        if (
            isset($_FILES['capa']) &&
            $_FILES['capa']['error'] === UPLOAD_ERR_OK
        ) {
            $uploadHelper = new UploadHelper();
            $capa = $uploadHelper->uploadCapa($_FILES['capa']);
        }

        $albumModel = new Album();
        $result = $albumModel->cadastrar(
            $titulo,
            $artistaId,
            $ano,
            $capa
        );

        if ($result) {
            Flash::set('success', 'Álbum criado com sucesso!');
        } else {
            Flash::set('danger', 'Erro ao criar álbum. Tente novamente.');
        }

        header('Location: ' . BASE_URL . '/artista/albuns');
        exit;
    }

    public function seguidores()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $artistaModel = new Artista();
        $seguidores = $artistaModel->listarSeguidores($artistaId);

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

    public function editarMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);

        if (!$musica || $musica['artista_id'] != $artistaId) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/artista/musicas');
            exit;
        }

        $albumModel = new Album();
        $albuns = $albumModel->listarPorArtista($artistaId);

        $this->view('artista/editar-musica', [
            'artista' => $artista,
            'musica' => $musica,
            'albuns' => $albuns
        ]);
    }

    public function atualizarMusica($id)
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

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

        if (
            empty($titulo) ||
            $albumId <= 0 ||
            $numeroFaixa <= 0 ||
            $duracao <= 0
        ) {
            Flash::set('danger', 'Preencha todos os campos obrigatórios.');
            header('Location: ' . BASE_URL . '/artista/editar-musica/' . $id);
            exit;
        }

        $albumModel = new Album();
        $albumArtistaId = $albumModel->getArtistaId($albumId);

        if ($albumArtistaId != $artistaId) {
            Flash::set('danger', 'Álbum inválido.');
            header('Location: ' . BASE_URL . '/artista/editar-musica/' . $id);
            exit;
        }

        $musicaModel->atualizar(
            $id,
            $titulo,
            $albumId,
            $numeroFaixa,
            $duracao,
            $genero
        );

        if (
            isset($_FILES['arquivo']) &&
            $_FILES['arquivo']['error'] === UPLOAD_ERR_OK
        ) {
            $uploadHelper = new UploadHelper();
            $arquivo = $uploadHelper->uploadMusica($_FILES['arquivo']);

            if ($arquivo) {
                if (!empty($musica['arquivo'])) {
                    $arquivoPath = __DIR__ . '/../../public/uploads/musicas/' . $musica['arquivo'];

                    if (file_exists($arquivoPath)) {
                        unlink($arquivoPath);
                    }
                }

                $musicaModel->atualizarArquivo($id, $arquivo);
            }
        }

        if (
            isset($_FILES['capa']) &&
            $_FILES['capa']['error'] === UPLOAD_ERR_OK
        ) {
            $uploadHelper = new UploadHelper();
            $capa = $uploadHelper->uploadCapa($_FILES['capa']);

            if ($capa) {
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

    public function editarPerfil()
    {
        $artista = $this->verificarArtista();

        $this->view('artista/editar-perfil', [
            'artista' => $artista
        ]);
    }

    public function atualizarPerfil()
    {
        $artista = $this->verificarArtista();
        $artistaId = $artista['id'];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/artista/editar-perfil');
            exit;
        }

        $nome = trim($_POST['nome'] ?? '');

        if (empty($nome)) {
            Flash::set('danger', 'O nome artístico é obrigatório.');
            header('Location: ' . BASE_URL . '/artista/editar-perfil');
            exit;
        }

        $foto = $artista['foto'];

        if (
            isset($_FILES['foto']) &&
            $_FILES['foto']['error'] === UPLOAD_ERR_OK
        ) {
            $uploadHelper = new UploadHelper();

            $novaFoto = $uploadHelper->uploadArtistaFoto($_FILES['foto']);

            if ($novaFoto) {

                if (!empty($artista['foto'])) {
                    $fotoPath = __DIR__ . '/../../public/uploads/artistas/' . $artista['foto'];

                    if (file_exists($fotoPath)) {
                        unlink($fotoPath);
                    }
                }

                $foto = $novaFoto;

            } else {

                Flash::set(
                    'warning',
                    'Erro ao enviar foto. Verifique o formato e tamanho.'
                );

                header('Location: ' . BASE_URL . '/artista/editar-perfil');
                exit;
            }
        }

        $artistaModel = new Artista();

        $result = $artistaModel->atualizar(
            $artistaId,
            $nome,
            $foto
        );

        if ($result) {
            Flash::set(
                'success',
                'Perfil atualizado com sucesso!'
            );
        } else {
            Flash::set(
                'danger',
                'Erro ao atualizar perfil.'
            );
        }

        header('Location: ' . BASE_URL . '/artista/dashboard');
        exit;
    }
}