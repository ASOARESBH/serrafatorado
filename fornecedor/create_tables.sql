
CREATE TABLE fornecedores (
    id_fornecedor INT AUTO_INCREMENT PRIMARY KEY,
    nome_empreendimento VARCHAR(255) NOT NULL,
    cpf_cnpj VARCHAR(18) NOT NULL UNIQUE,
    endereco VARCHAR(255) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    site VARCHAR(255),
    instagram VARCHAR(255),
    segmento VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    media_avaliacao DECIMAL(2,1) DEFAULT 0.0,
    total_avaliacoes INT DEFAULT 0
);

CREATE TABLE associados (
    id_associado INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    unidade VARCHAR(50) NOT NULL
);

CREATE TABLE contratacoes (
    id_contratacao INT AUTO_INCREMENT PRIMARY KEY,
    id_associado INT NOT NULL,
    id_fornecedor INT NOT NULL,
    data_solicitacao DATETIME NOT NULL,
    data_aceitacao DATETIME,
    data_finalizacao DATETIME,
    status VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_associado) REFERENCES associados(id_associado),
    FOREIGN KEY (id_fornecedor) REFERENCES fornecedores(id_fornecedor)
);

CREATE TABLE avaliacoes (
    id_avaliacao INT AUTO_INCREMENT PRIMARY KEY,
    id_contratacao INT NOT NULL,
    id_associado INT NOT NULL,
    id_fornecedor INT NOT NULL,
    pontuacao INT NOT NULL CHECK (pontuacao BETWEEN 1 AND 5),
    feedback TEXT,
    data_avaliacao DATETIME NOT NULL,
    FOREIGN KEY (id_contratacao) REFERENCES contratacoes(id_contratacao),
    FOREIGN KEY (id_associado) REFERENCES associados(id_associado),
    FOREIGN KEY (id_fornecedor) REFERENCES fornecedores(id_fornecedor)
);


