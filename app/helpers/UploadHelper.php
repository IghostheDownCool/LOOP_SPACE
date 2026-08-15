<?php

class UploadHelper
{
    /**
     * Upload genérico
     */
    public static function upload(array $file, string $destino, array $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'], int $maxSize = 5242880): ?string
    {
        // Cria a pasta se não existir
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        // Verifica se houve erro no upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Verifica extensão
        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extensao, $extensoesPermitidas)) {
            return null;
        }

        // Verifica tamanho
        if ($file['size'] > $maxSize) {
            return null;
        }

        // Gera nome único
        $novoNome = uniqid('avatar_') . '.' . $extensao;
        $caminho = rtrim($destino, '/') . '/' . $novoNome;

        // Move o arquivo
        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }

    /**
     * Upload de música (MP3)
     */
    public function uploadMusica(array $file): ?string
    {
        $destino = __DIR__ . '/../../public/uploads/musicas/';
        
        // Cria a pasta se não existir
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        // Verifica se houve erro no upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Verifica extensão (apenas MP3)
        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['mp3', 'wav', 'ogg', 'm4a'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            return null;
        }

        // Verifica tamanho (máximo 20MB)
        $maxSize = 20 * 1024 * 1024; // 20MB
        if ($file['size'] > $maxSize) {
            return null;
        }

        // Gera nome único
        $novoNome = uniqid('musica_') . '.' . $extensao;
        $caminho = rtrim($destino, '/') . '/' . $novoNome;

        // Move o arquivo
        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }

    /**
     * Upload de capa (imagem)
     */
    public function uploadCapa(array $file): ?string
    {
        $destino = __DIR__ . '/../../public/uploads/capas/';
        
        // Cria a pasta se não existir
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        // Verifica se houve erro no upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Verifica extensão
        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            return null;
        }

        // Verifica tamanho (máximo 5MB)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            return null;
        }

        // Gera nome único
        $novoNome = uniqid('capa_') . '.' . $extensao;
        $caminho = rtrim($destino, '/') . '/' . $novoNome;

        // Move o arquivo
        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }

    /**
     * Upload de avatar do usuário
     */
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

        $maxSize = 2 * 1024 * 1024; // 2MB
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
}