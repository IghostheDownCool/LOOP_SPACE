<?php

class MusicasController extends AdminController
{
    public function index()
    {
        AdminMiddleware::verificar();
    $musica = new Musica();
    $musicas = $musica->listarTodas();  // ← MUDOU para listarTodas()

    $this->view('admin/musicas/index', [
        'musicas' => $musicas
    ]);
    }

    /**
     * Ativar música (admin)
     */
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
        
        // Ativa a música
        $musicaModel->toggleAtiva($id);
        
        Flash::set('success', 'Música ativada com sucesso!');
        header('Location: ' . BASE_URL . '/admin/musicas');
        exit;
    }

    /**
     * Desativar música (admin)
     */
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
        
        // Desativa a música
        $musicaModel->toggleAtiva($id);
        
        Flash::set('success', 'Música desativada com sucesso!');
        header('Location: ' . BASE_URL . '/admin/musicas');
        exit;
    }

    /**
     * Excluir música (admin)
     */
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
        
        // Remove o arquivo de áudio se existir
        if (!empty($musica['arquivo'])) {
            $arquivoPath = __DIR__ . '/../../../public/uploads/musicas/' . $musica['arquivo'];
            if (file_exists($arquivoPath)) {
                unlink($arquivoPath);
            }
        }
        
        // Remove a capa se existir
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