CREATE database sistema;

use sistema;


CREATE TABLE IF NOT EXISTS produtos (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    foto VARCHAR(255) NOT NULL
);