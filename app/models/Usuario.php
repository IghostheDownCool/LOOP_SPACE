<?php

class Usuario
{
    use SoftDelete;

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function cadastrar(string $nome, string $email, string $senha): int|false
{
    $sql = "
        INSERT INTO usuarios (nome, email, senha)
        VALUES (:nome, :email, :senha)
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha  // ✅ Agora a senha já vem hashed do Controller
    ]);

    return $this->pdo->lastInsertId();
}
    public function buscarPorEmail(string $email): bool
{
    $sql = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch() !== false;
}
public function buscarPorEmailLogin(string $email)
{
    $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function contar(): int
{
    $sql = "SELECT COUNT(*) as total FROM usuarios";
    $stmt = $this->pdo->query($sql);
    return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function ultimos(int $limite = 5): array
{
    $sql = "
        SELECT id, nome, email, data_cadastro AS created_at
        FROM usuarios
        ORDER BY data_cadastro DESC
        LIMIT :limite
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function atualizarAvatar(int $usuarioId, ?string $avatar): bool
{
    $sql = "
        UPDATE usuarios
        SET avatar = :avatar
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $usuarioId,
        ':avatar' => $avatar
    ]);
}

public function buscarPorId(int $id): array|false
{
    $sql = "
        SELECT id, nome, email, avatar, senha, data_cadastro, role, artista_id  -- 🔥 ADICIONEI artista_id
        FROM usuarios
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function atualizarNome(int $usuarioId, string $nome): bool
{
    $sql = "UPDATE usuarios SET nome = :nome WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $usuarioId,
        ':nome' => $nome
    ]);
}

public function atualizarSenha(int $usuarioId, string $senha): bool
{
    $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $usuarioId,
        ':senha' => $senha
    ]);
}

public function isAdmin(int $usuarioId): bool
{
    $sql = "SELECT role FROM usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $usuarioId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($result['role'] ?? 'user') === 'admin';
}

public function definirComoAdmin(int $usuarioId): bool
{
    $sql = "UPDATE usuarios SET role = 'admin' WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([':id' => $usuarioId]);
}

public function listarTodos(): array
{
    $sql = "
        SELECT id, nome, email, role, data_cadastro
        FROM usuarios
        ORDER BY data_cadastro DESC
    ";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function removerAdmin(int $usuarioId): bool
{
    $sql = "UPDATE usuarios SET role = 'user' WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([':id' => $usuarioId]);
}

public function excluir(int $usuarioId): bool
{
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([':id' => $usuarioId]);
}
    /**
     * Vincula um usuário a um artista (cria o perfil de artista)
     */
    public function vincularArtista(int $usuarioId, string $nomeArtista, ?string $foto = null): bool
    {
        try {
            // Primeiro verifica se o usuário já é artista
            $sqlCheck = "
                SELECT artista_id 
                FROM usuarios 
                WHERE id = :usuario_id
            ";
            $stmtCheck = $this->pdo->prepare($sqlCheck);
            $stmtCheck->execute([':usuario_id' => $usuarioId]);
            $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            if ($result && !empty($result['artista_id'])) {
                // Já é artista
                return true;
            }
            
            // Cria o artista
            $sql = "
                INSERT INTO artistas (nome, foto)
                VALUES (:nome, :foto)
            ";
            
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([
                ':nome' => $nomeArtista,
                ':foto' => $foto
            ]);
            
            if (!$result) {
                return false;
            }
            
            $artistaId = $this->pdo->lastInsertId();
            
            // Atualiza o usuário com o ID do artista
            $sqlUpdate = "
                UPDATE usuarios
                SET artista_id = :artista_id
                WHERE id = :usuario_id
            ";
            
            $stmtUpdate = $this->pdo->prepare($sqlUpdate);
            return $stmtUpdate->execute([
                ':artista_id' => $artistaId,
                ':usuario_id' => $usuarioId
            ]);
            
        } catch (PDOException $e) {
            error_log('Erro ao vincular artista: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Verifica se um usuário é artista
     */
    public function isArtista(int $usuarioId): bool
    {
        $sql = "
            SELECT artista_id 
            FROM usuarios 
            WHERE id = :id AND artista_id IS NOT NULL
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $usuarioId]);
        return $stmt->fetch() !== false;
    }

    /**
     * Busca o artista de um usuário
     */
    public function getArtistaDoUsuario(int $usuarioId): array|false
    {
        $sql = "
            SELECT a.*
            FROM artistas a
            INNER JOIN usuarios u ON u.artista_id = a.id
            WHERE u.id = :usuario_id
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}