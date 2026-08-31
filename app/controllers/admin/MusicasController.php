<?php

class MusicasController extends AdminController
{
    public function index()
    {
        AdminMiddleware::verificar();
    $musica = new Musica();
    $musicas = $musica->listarTodas();

    $this->view('admin/musicas/index', [
        'musicas' => $musicas
    ]);
    }

    public function ativar(int $id)
    {
        AdminMiddleware::verificar();
        
        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);
        
        if (!$musica) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/admin/musicas');
            exit;
        }
        
        $musicaModel->toggleAtiva($id);
        
        Flash::set('success', 'Música ativada com sucesso!');
        header('Location: ' . BASE_URL . '/admin/musicas');
        exit;
    }


    public function desativar(int $id)
    {
        AdminMiddleware::verificar();
        
        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);
        
        if (!$musica) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/admin/musicas');
            exit;
        }
        
        $musicaModel->toggleAtiva($id);
        
        Flash::set('success', 'Música desativada com sucesso!');
        header('Location: ' . BASE_URL . '/admin/musicas');
        exit;
    }


    public function excluir(int $id)
    {
        AdminMiddleware::verificar();
        
        $musicaModel = new Musica();
        $musica = $musicaModel->buscarPorId($id);
        
        if (!$musica) {
            Flash::set('danger', 'Música não encontrada.');
            header('Location: ' . BASE_URL . '/admin/musicas');
            exit;
        }
        
        if (!empty($musica['arquivo'])) {
            $arquivoPath = __DIR__ . '/../../../public/uploads/musicas/' . $musica['arquivo'];
            if (file_exists($arquivoPath)) {
                unlink($arquivoPath);
            }
        }
        
        if (!empty($musica['capa'])) {
            $capaPath = __DIR__ . '/../../../public/uploads/capas/' . $musica['capa'];
            if (file_exists($capaPath)) {
                unlink($capaPath);
            }
        }
        
        $musicaModel->excluir($id);
        
        Flash::set('success', 'Música excluída com sucesso!');
        header('Location: ' . BASE_URL . '/admin/musicas');
        exit;
    }
}