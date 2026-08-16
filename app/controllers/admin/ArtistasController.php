<?php

class ArtistasController extends Controller
{
    public function index()
    {
        AdminMiddleware::verificar();
        $this->requireLogin();

        $artista = new Artista();
        $artistas = $artista->listar();

        $this->view('admin/artistas/index', [
            'artistas' => $artistas
        ]);
    }

    public function cadastrar()
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);

            if (empty($nome)) {
                Flash::set('danger', 'O nome do artista é obrigatório.');
                header('Location: ' . BASE_URL . '/admin/artistas/cadastrar');
                exit;
            }

            // Upload da foto (opcional)
            $foto = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $uploadHelper = new UploadHelper();
                $foto = $uploadHelper->uploadAvatar($_FILES['foto']);
                
                if (!$foto) {
                    Flash::set('warning', 'A foto não foi enviada. Verifique o formato (JPG, PNG, GIF, WEBP) e tamanho (máx 5MB).');
                }
            }

            $artista = new Artista();
            if ($artista->cadastrar($nome, $foto)) {
                Flash::set('success', 'Artista cadastrado com sucesso!');
            } else {
                Flash::set('danger', 'Erro ao cadastrar artista.');
            }

            header('Location: ' . BASE_URL . '/admin/artistas');
            exit;
        }

        $this->view('admin/artistas/cadastrar');
    }

    public function editar(int $id)
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artista = $artistaModel->buscarPorId($id);

        if (!$artista) {
            Flash::set('danger', 'Artista não encontrado.');
            header('Location: ' . BASE_URL . '/admin/artistas');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);

            if (empty($nome)) {
                Flash::set('danger', 'O nome do artista é obrigatório.');
                header('Location: ' . BASE_URL . '/admin/artistas/editar/' . $id);
                exit;
            }

            // Upload da nova foto (opcional)
            $foto = $artista['foto'];
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $uploadHelper = new UploadHelper();
                $novaFoto = $uploadHelper->uploadAvatar($_FILES['foto']);
                
                if ($novaFoto) {
                    // Remove a foto antiga se existir
                    if ($foto && file_exists(__DIR__ . '/../../public/uploads/artistas/' . $foto)) {
                        unlink(__DIR__ . '/../../public/uploads/artistas/' . $foto);
                    }
                    $foto = $novaFoto;
                } else {
                    Flash::set('warning', 'A foto não foi atualizada. Verifique o formato (JPG, PNG, GIF, WEBP) e o tamanho (máx. 5MB).');
                }
            }

            if ($artistaModel->atualizar($id, $nome, $foto)) {
                Flash::set('success', 'Artista atualizado com sucesso!');
            } else {
                Flash::set('danger', 'Erro ao atualizar artista.');
            }

            header('Location: ' . BASE_URL . '/admin/artistas');
            exit;
        }

        $this->view('admin/artistas/editar', [
            'artista' => $artista
        ]);
    }

    public function excluir(int $id)
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artista = $artistaModel->buscarPorId($id);

        if (!$artista) {
            Flash::set('danger', 'Artista não encontrado.');
            header('Location: ' . BASE_URL . '/admin/artistas');
            exit;
        }

        // Remove a foto se existir
        if ($artista['foto'] && file_exists(__DIR__ . '/../../public/uploads/artistas/' . $artista['foto'])) {
            unlink(__DIR__ . '/../../public/uploads/artistas/' . $artista['foto']);
        }

        if ($artistaModel->excluir($id)) {
            Flash::set('success', 'Artista excluído com sucesso!');
        } else {
            Flash::set('danger', 'Erro ao excluir artista.');
        }

        header('Location: ' . BASE_URL . '/admin/artistas');
        exit;
    }

    /**
     * Redireciona para uma URL (mantendo compatibilidade)
     */
    protected function redirect(string $path)
    {
        header('Location: ' . BASE_URL . $path);
        exit;
    }
}