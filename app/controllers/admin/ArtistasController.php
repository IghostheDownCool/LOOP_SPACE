<?php

class ArtistasController extends Controller
{
    public function index()
    {
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

            // Validação: nome é obrigatório
            if (empty($nome)) {
                Flash::set('danger', 'O nome do artista é obrigatório.');
                header('Location: ' . BASE_URL . '/admin/artistas/cadastrar');
                exit;
            }

            // Upload da foto (opcional)
            $foto = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $foto = UploadHelper::upload(
                    $_FILES['foto'],
                    __DIR__ . '/../../public/uploads/artistas/',
                    ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    5242880 // 5MB
                );

                if (!$foto) {
                    Flash::set('warning', 'A foto não foi enviada.');
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
            $foto = $artista['foto']; // Mantém a foto atual
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $novaFoto = UploadHelper::upload(
                    $_FILES['foto'],
                    __DIR__ . '/../../public/uploads/artistas/',
                    ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    5242880 // 5MB
                );
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
}