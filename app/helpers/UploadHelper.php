<?php

class UploadHelper
{

    public static function upload(array $file, string $destino, array $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'], int $maxSize = 5242880): ?string
    {
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extensao, $extensoesPermitidas)) {
            return null;
        }

        if ($file['size'] > $maxSize) {
            return null;
        }

        $novoNome = uniqid('avatar_') . '.' . $extensao;
        $caminho = rtrim($destino, '/') . '/' . $novoNome;

        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }

    public function uploadMusica(array $file): ?string
    {
        $destino = __DIR__ . '/../../public/uploads/musicas/';
        
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['mp3', 'wav', 'ogg', 'm4a'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            return null;
        }

        $maxSize = 20 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            return null;
        }

        $novoNome = uniqid('musica_') . '.' . $extensao;
        $caminho = rtrim($destino, '/') . '/' . $novoNome;

        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }

    public function uploadCapa(array $file): ?string
    {
        $destino = __DIR__ . '/../../public/uploads/capas/';
        
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            return null;
        }

        $maxSize = 5 * 1024 * 1024; 
        if ($file['size'] > $maxSize) {
            return null;
        }

        $novoNome = uniqid('capa_') . '.' . $extensao;
        $caminho = rtrim($destino, '/') . '/' . $novoNome;

        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }

    public function uploadAvatar(array $file): ?string
    {
        $destino = __DIR__ . '/../../public/uploads/avatars/';
        
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            return null;
        }

        $maxSize = 2 * 1024 * 1024; 
        if ($file['size'] > $maxSize) {
            return null;
        }

        $novoNome = uniqid('avatar_') . '.' . $extensao;
        $caminho = rtrim($destino, '/') . '/' . $novoNome;

        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }

public function uploadArtistaFoto(array $file): ?string
{
    $destino = __DIR__ . '/../../public/uploads/artistas/';
    
    if (!is_dir($destino)) {
        mkdir($destino, 0777, true);
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($extensao, $extensoesPermitidas)) {
        return null;
    }

    $maxSize = 5 * 1024 * 1024; 
    if ($file['size'] > $maxSize) {
        return null;
    }

    $novoNome = uniqid('artista_') . '.' . $extensao;
    $caminho = rtrim($destino, '/') . '/' . $novoNome;

    if (move_uploaded_file($file['tmp_name'], $caminho)) {
        return $novoNome;
    }

    return null;
}
}