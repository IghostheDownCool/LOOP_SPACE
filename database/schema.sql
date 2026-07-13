-- cria as tabelas

DROP TABLE IF EXISTS favoritos;
DROP TABLE IF EXISTS playlist_musicas;
DROP TABLE IF EXISTS playlists;
DROP TABLE IF EXISTS musicas;
DROP TABLE IF EXISTS albuns;
DROP TABLE IF EXISTS artistas;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    foto_perfil VARCHAR(255) DEFAULT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE artistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE albuns (
    id INT AUTO_INCREMENT PRIMARY KEY,

    artista_id INT NOT NULL,

    titulo VARCHAR(150) NOT NULL,

    ano YEAR NULL,

    capa VARCHAR(255) NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_album_artista
        FOREIGN KEY (artista_id)
        REFERENCES artistas(id)
        ON DELETE CASCADE
);

CREATE TABLE musicas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    duracao INT NOT NULL,
    numero_faixa INT,
    arquivo VARCHAR(255) NOT NULL,
    capa VARCHAR(255),

    reproducoes INT DEFAULT 0,

    ativa BOOLEAN DEFAULT TRUE,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_musica_album
        FOREIGN KEY (album_id)
        REFERENCES albuns(id)
        ON DELETE CASCADE
);

CREATE TABLE playlists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_playlist_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
);

CREATE TABLE playlist_musicas (
    playlist_id INT NOT NULL,
    musica_id INT NOT NULL,
    adicionado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (playlist_id, musica_id),

    CONSTRAINT fk_pm_playlist
        FOREIGN KEY (playlist_id)
        REFERENCES playlists(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_pm_musica
        FOREIGN KEY (musica_id)
        REFERENCES musicas(id)
        ON DELETE CASCADE
);

CREATE TABLE favoritos (
    usuario_id INT NOT NULL,
    musica_id INT NOT NULL,
    favoritado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (usuario_id, musica_id),

    CONSTRAINT fk_favorito_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_favorito_musica
        FOREIGN KEY (musica_id)
        REFERENCES musicas(id)
        ON DELETE CASCADE
);