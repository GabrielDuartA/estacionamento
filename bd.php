CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL
);

INSERT INTO usuarios (usuario, senha) VALUES ('admin', 'senha');

CREATE TABLE carros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(7) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    ano INT NOT NULL
);