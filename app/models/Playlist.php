<?php

class Playlist extends Model
{
    public function listar(int $usuarioId): array
    {
        $sql = "
            SELECT *
            FROM playlists
            WHERE usuario_id = :usuario_id
            ORDER BY nome ASC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':usuario_id' => $usuarioId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar(
    int $usuarioId,
    string $nome,
    int $publica = 0
): bool {
    // Gera um token único para compartilhamento
    $token = bin2hex(random_bytes(16));

    $sql = "
        INSERT INTO playlists
        (
            usuario_id,
            nome,
            publica,
            token
        )
        VALUES
        (
            :usuario_id,
            :nome,
            :publica,
            :token
        )
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':nome' => $nome,
        ':publica' => $publica,
        ':token' => $token
    ]);
}

    public function buscarPorId(int $id): array|false
    {
        $sql = "
            SELECT *
            FROM playlists
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(
        int $id,
        string $nome,
        int $publica
    ): bool {

        $sql = "
            UPDATE playlists
            SET
                nome = :nome,
                publica = :publica
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':publica' => $publica
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "
            DELETE FROM playlists
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function listarMusicas(int $playlistId): array
{
    $sql = "
        SELECT
            musicas.*,
            albuns.titulo AS album,
            artistas.nome AS artista,
            albuns.capa
        FROM playlist_musicas

        INNER JOIN musicas
            ON musicas.id = playlist_musicas.musica_id

        INNER JOIN albuns
            ON albuns.id = musicas.album_id

        INNER JOIN artistas
            ON artistas.id = albuns.artista_id

        WHERE playlist_musicas.playlist_id = :playlist_id

        ORDER BY artistas.nome,
                 album,
                 musicas.numero_faixa
    ";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':playlist_id' => $playlistId
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function adicionarMusica(
    int $playlistId,
    int $musicaId
): bool {

    $sql = "
        INSERT IGNORE INTO playlist_musicas
        (
            playlist_id,
            musica_id
        )
        VALUES
        (
            :playlist_id,
            :musica_id
        )
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':playlist_id' => $playlistId,
        ':musica_id' => $musicaId
    ]);
}
public function listarIdsMusicas(int $playlistId): array
{
    $sql = "
        SELECT musica_id
        FROM playlist_musicas
        WHERE playlist_id = :playlist_id
    ";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':playlist_id' => $playlistId
    ]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
public function removerMusica(
    int $playlistId,
    int $musicaId
): bool {

    $sql = "
        DELETE FROM playlist_musicas
        WHERE
            playlist_id = :playlist_id
        AND
            musica_id = :musica_id
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':playlist_id' => $playlistId,
        ':musica_id' => $musicaId
    ]);
}
public function editar(int $id)
{
    $this->requireLogin();

    $playlistModel = new Playlist();

    $playlist = $playlistModel->buscarPorId($id);

    if (!$playlist) {
        die('Playlist não encontrada.');
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome = trim($_POST['nome']);

        $publica = isset($_POST['publica']) ? 1 : 0;


        if ($nome !== '') {

            $playlistModel->atualizar(
                $id,
                $nome,
                $publica
            );


            header(
                'Location: ' . BASE_URL . '/playlists'
            );

            exit;
        }
    }


    $this->view('playlists/editar', [
        'playlist' => $playlist
    ]);
}

public function buscarPorToken(string $token): array|false
{
    $sql = "
        SELECT
            playlists.*,
            usuarios.nome AS usuario_nome
        FROM playlists
        INNER JOIN usuarios ON usuarios.id = playlists.usuario_id
        WHERE playlists.token = :token
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':token' => $token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}