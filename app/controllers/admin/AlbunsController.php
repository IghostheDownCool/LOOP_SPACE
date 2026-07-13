<?php

class AlbunsController extends AdminController
{
    public function index()
    {
        $album = new Album();

        $albuns = $album->listar();

        $this->view('admin/albuns/index', [
            'albuns' => $albuns
        ]);
    }
}