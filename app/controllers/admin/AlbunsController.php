<?php

class AlbunsController extends AdminController
{
    public function index()
    {
        $this->requireLogin();

        $album = new Album();
        $albuns = $album->listar();

        $this->view('admin/albuns/index', [
            'albuns' => $albuns
        ]);
    }

    public function cadastrar()
    {
        $this->requireLogin();

        $artista = new Artista();
        $artistas = $artista->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo']);
            $artistaId = (int) $_POST['artista_id'];
            $ano = (int) $_POST['ano'];

            // Validação: título é obrigatório
            if (empty($titulo)) {
                Flash::set('danger', 'O título do álbum é obrigatório.');
                header('Location: ' . BASE_URL . '/admin/albuns/cadastrar');
                exit;
            }

            // Validação: artista é obrigatório
            if ($artistaId <= 0) {
                Flash::set('danger', 'Selecione um artista para o álbum.');
                header('Location: ' . BASE_URL . '/admin/albuns/cadastrar');
                exit;
            }

            // Upload da capa (opcional)
            $capa = null;
            if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
                $capa = UploadHelper::upload(
                    $_FILES['capa'],
                    __DIR__ . '/../../public/uploads/capas/',
                    ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    5242880 // 5MB
                );
                if (!$capa) {
                    Flash::set('warning', 'A capa não foi enviada. Verifique o formato (JPG, PNG, GIF, WEBP) e o tamanho (máx. 5MB).');
                }
            }

            $album = new Album();
            if ($album->cadastrar($titulo, $artistaId, $ano, $capa)) {
                Flash::set('success', 'Álbum cadastrado com sucesso!');
            } else {
                Flash::set('danger', 'Erro ao cadastrar álbum.');
            }

            header('Location: ' . BASE_URL . '/admin/albuns');
            exit;
        }

        $this->view('admin/albuns/cadastrar', [
            'artistas' => $artistas
        ]);
    }

    public function editar(int $id)
    {
        $this->requireLogin();

        $albumModel = new Album();
        $album = $albumModel->buscarPorId($id);

        if (!$album) {
            Flash::set('danger', 'Álbum não encontrado.');
            header('Location: ' . BASE_URL . '/admin/albuns');
            exit;
        }

        $artista = new Artista();
        $artistas = $artista->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo']);
            $artistaId = (int) $_POST['artista_id'];
            $ano = (int) $_POST['ano'];

            if (empty($titulo)) {
                Flash::set('danger', 'O título do álbum é obrigatório.');
                header('Location: ' . BASE_URL . '/admin/albuns/editar/' . $id);
                exit;
            }

            if ($artistaId <= 0) {
                Flash::set('danger', 'Selecione um artista para o álbum.');
                header('Location: ' . BASE_URL . '/admin/albuns/editar/' . $id);
                exit;
            }

            // Upload da nova capa (opcional)
            $capa = $album['capa']; // Mantém a capa atual
            if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
                $novaCapa = UploadHelper::upload(
                    $_FILES['capa'],
                    __DIR__ . '/../../public/uploads/capas/',
                    ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    5242880 // 5MB
                );
                if ($novaCapa) {
                    // Remove a capa antiga se existir
                    if ($capa && file_exists(__DIR__ . '/../../public/uploads/capas/' . $capa)) {
                        unlink(__DIR__ . '/../../public/uploads/capas/' . $capa);
                    }
                    $capa = $novaCapa;
                } else {
                    Flash::set('warning', 'A capa não foi atualizada. Verifique o formato (JPG, PNG, GIF, WEBP) e o tamanho (máx. 5MB).');
                }
            }

            if ($albumModel->atualizar($id, $titulo, $artistaId, $ano, $capa)) {
                Flash::set('success', 'Álbum atualizado com sucesso!');
            } else {
                Flash::set('danger', 'Erro ao atualizar álbum.');
            }

            header('Location: ' . BASE_URL . '/admin/albuns');
            exit;
        }

        $this->view('admin/albuns/editar', [
            'album' => $album,
            'artistas' => $artistas
        ]);
    }

    public function excluir(int $id)
    {
        $this->requireLogin();

        $albumModel = new Album();
        $album = $albumModel->buscarPorId($id);

        if (!$album) {
            Flash::set('danger', 'Álbum não encontrado.');
            header('Location: ' . BASE_URL . '/admin/albuns');
            exit;
        }

        // Remove a capa se existir
        if ($album['capa'] && file_exists(__DIR__ . '/../../public/uploads/capas/' . $album['capa'])) {
            unlink(__DIR__ . '/../../public/uploads/capas/' . $album['capa']);
        }

        if ($albumModel->excluir($id)) {
            Flash::set('success', 'Álbum excluído com sucesso!');
        } else {
            Flash::set('danger', 'Erro ao excluir álbum.');
        }

        header('Location: ' . BASE_URL . '/admin/albuns');
        exit;
    }
}