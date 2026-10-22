CREATE DATABASE IF NOT EXISTS fretefacil
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE fretefacil;

CREATE TABLE produto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT,
  peso DECIMAL(10,2) NOT NULL,
  altura DECIMAL(10,2),
  largura DECIMAL(10,2),
  comprimento DECIMAL(10,2)
);

CREATE TABLE endereco (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cep VARCHAR(9) NOT NULL,
  rua VARCHAR(150) NOT NULL,
  numero VARCHAR(10) NOT NULL,
  complemento VARCHAR(100),
  bairro VARCHAR(100) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  estado CHAR(2) NOT NULL
);

CREATE TABLE transportador (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  documento VARCHAR(18) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  placa_veiculo VARCHAR(10)
);

CREATE TABLE frete (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_transportador INT NOT NULL,
  id_origem INT NOT NULL,
  id_destino INT NOT NULL,
  data DATE NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'Aguardando coleta',
  FOREIGN KEY (id_transportador) REFERENCES transportador(id),
  FOREIGN KEY (id_origem) REFERENCES endereco(id),
  FOREIGN KEY (id_destino) REFERENCES endereco(id)
);

CREATE TABLE frete_item (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_frete INT NOT NULL,
  id_produto INT NOT NULL,
  quantidade INT NOT NULL,
  FOREIGN KEY (id_frete) REFERENCES frete(id) ON DELETE CASCADE,
  FOREIGN KEY (id_produto) REFERENCES produto(id)
);
