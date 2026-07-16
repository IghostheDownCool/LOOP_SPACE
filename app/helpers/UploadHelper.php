<?php

class UploadHelper
{
    public static function upload(array $file, string $destino, array $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'], int $maxSize = 5242880): ?string
    {
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
        $novoNome = uniqid() . '.' . $extensao;
        $caminho = $destino . '/' . $novoNome;

        // Move o arquivo
        if (move_uploaded_file($file['tmp_name'], $caminho)) {
            return $novoNome;
        }

        return null;
    }
}