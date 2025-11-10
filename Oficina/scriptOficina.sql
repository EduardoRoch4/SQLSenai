-- USE do banco
CREATE DATABASE IF NOT EXISTS mecanica;
USE mecanica;

-- TABELA CLIENTES
CREATE TABLE IF NOT EXISTS Clientes (
    id_cliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE,
    telefone VARCHAR(13),
    endereco VARCHAR(100)
);

-- TABELA VEÍCULO
CREATE TABLE IF NOT EXISTS Veiculo (
    id_veiculo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    ano INT,
    placa VARCHAR(8) UNIQUE,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABELA MECÂNICO
CREATE TABLE IF NOT EXISTS Mecanico (
    id_mecanico INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE,
    especialidade VARCHAR(100)
);

-- TABELA SERVIÇO
CREATE TABLE IF NOT EXISTS Servico (
    id_servico INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100),
    valor_mao_de_obra DECIMAL(10,2)
);

-- TABELA PEÇA
CREATE TABLE IF NOT EXISTS Peca (
    id_peca INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100),
    quantidade_estoque INT,
    preco_unitario DECIMAL(10,2)
);

-- TABELA ORDEM DE SERVIÇO
CREATE TABLE IF NOT EXISTS OS (
    id_OS INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_veiculo INT NOT NULL,
    data_abertura DATE,
    data_fechamento DATE,
    observacoes VARCHAR(200),
    status VARCHAR(50),
    FOREIGN KEY (id_veiculo) REFERENCES Veiculo(id_veiculo) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABELA ESTOQUE
CREATE TABLE IF NOT EXISTS Estoque (
    id_estoque INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    responsavel VARCHAR(100),
    localizacao VARCHAR(100),
    capacidade_total INT
);

-- INSERIR DADOS

-- 1. CLIENTES
INSERT INTO Clientes (nome, cpf, telefone, endereco) VALUES
('João Silva', '123.456.789-00', '(11)999991111', 'Rua das Flores, 123'),
('Maria Oliveira', '987.654.321-00', '(11)988882222', 'Av. Paulista, 500'),
('Carlos Souza', '111.222.333-44', '(21)977773333', 'Rua A, 45'),
('Ana Santos', '555.666.777-88', '(31)966664444', 'Rua B, 77'),
('Pedro Lima', '999.888.777-66', '(41)955555555', 'Rua C, 90');

-- 2. VEÍCULO
INSERT INTO Veiculo (id_cliente, ano, placa, marca, modelo) VALUES
(1, 2018, 'ABC1D23', 'Toyota', 'Corolla'),
(2, 2020, 'EFG4H56', 'Honda', 'Civic'),
(3, 2015, 'IJK7L89', 'Ford', 'Fiesta'),
(4, 2022, 'MNO0P12', 'Chevrolet', 'Onix'),
(5, 2019, 'QRS3T45', 'Volkswagen', 'Gol');

-- 3. MECÂNICO
INSERT INTO Mecanico (nome, cpf, especialidade) VALUES
('Rogério Almeida', '123.111.222-33', 'Motor e transmissão'),
('Carlos Mendes', '321.222.111-44', 'Freios e suspensão'),
('Marcos Silva', '444.555.666-77', 'Elétrica automotiva');

-- 4. SERVIÇO
INSERT INTO Servico (descricao, valor_mao_de_obra) VALUES
('Troca de óleo', 150.00),
('Revisão de freios', 300.00),
('Alinhamento e balanceamento', 180.00),
('Substituição de embreagem', 900.00),
('Troca de bateria', 250.00);

-- 5. PEÇA
INSERT INTO Peca (descricao, quantidade_estoque, preco_unitario) VALUES
('Filtro de óleo', 50, 35.00),
('Pastilha de freio', 40, 120.00),
('Correia dentada', 30, 200.00),
('Bateria 60Ah', 20, 480.00),
('Amortecedor dianteiro', 25, 350.00);

-- 6. OS (Ordem de Serviço)
INSERT INTO OS (id_veiculo, data_abertura, data_fechamento, observacoes, status) VALUES
(1, '2025-11-01', '2025-11-03', 'Troca de óleo e filtro', 'Concluída'),
(2, '2025-11-05', NULL, 'Revisão completa', 'Em andamento'),
(3, '2025-11-07', NULL, 'Problema no motor', 'Aberta'),
(4, '2025-11-02', '2025-11-06', 'Troca de embreagem', 'Concluída'),
(5, '2025-11-09', NULL, 'Troca de bateria', 'Aberta');

-- 7. ESTOQUE
INSERT INTO Estoque (responsavel, localizacao, capacidade_total) VALUES
('Ricardo Costa', 'Galpão Central', 1000),
('Fernanda Nunes', 'Filial Zona Norte', 600),
('Eduardo Pereira', 'Filial Zona Sul', 800);
