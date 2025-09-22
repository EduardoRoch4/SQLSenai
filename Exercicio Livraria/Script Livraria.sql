CREATE DATABASE Livraria;
USE Livraria;

-- Tabela Autores
CREATE TABLE Autores (
    ID_autor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    nacionalidade VARCHAR(150),
    data_nasc_autor DATE
);

-- Tabela Editoras
CREATE TABLE Editoras (
    ID_editora INT AUTO_INCREMENT PRIMARY KEY,
    nome_editora VARCHAR(150) NOT NULL,
    endereco VARCHAR(150),
    contato VARCHAR(150),
    telefone VARCHAR(20),
    cidade VARCHAR(150),
    cnpj VARCHAR(20) UNIQUE
);

-- Tabela Clientes
CREATE TABLE Clientes (
    ID_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(150) NOT NULL,
    cpf VARCHAR(25) UNIQUE NOT NULL,
    email VARCHAR(150),
    telefone VARCHAR(20),
    data_nasc_cliente DATE
);

-- Tabela Livros
CREATE TABLE Livros (
    ID_livro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    genero VARCHAR(150),
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT DEFAULT 0,
    ID_autor INT,	
    ID_editora INT,
    FOREIGN KEY (ID_autor) REFERENCES Autores(ID_autor),
    FOREIGN KEY (ID_editora) REFERENCES Editoras(ID_editora)
);

-- Tabela Vendas (aqui cada venda está ligada a 1 cliente e 1 livro)
CREATE TABLE Vendas (
    ID_venda INT AUTO_INCREMENT PRIMARY KEY,
    data_venda DATE NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    ID_cliente INT,
    ID_livro INT,
    FOREIGN KEY (ID_cliente) REFERENCES Clientes(ID_cliente),
    FOREIGN KEY (ID_livro) REFERENCES Livros(ID_livro)
);



------ Insert ------ 
-- Autores
INSERT INTO Autores (nome, nacionalidade, data_nasc_autor)
VALUES
('J. K. Rowling', 'Britânica', '1965-07-31'),
('George R. R. Martin', 'Americano', '1948-09-20'),
('Machado de Assis', 'Brasileiro', '1839-06-21');

-- Editoras
INSERT INTO Editoras (nome_editora, endereco, contato, telefone, cidade, cnpj)
VALUES
('Rocco', 'Rua das Letras, 123', 'Ana Souza', '21999990000', 'Rio de Janeiro', '12.345.678/0001-99'),
('Leya', 'Av. Paulista, 500', 'Carlos Silva', '1133334444', 'São Paulo', '98.765.432/0001-11'),
('Companhia das Letras', 'Rua Augusta, 2500', 'Fernanda Lima', '1132323232', 'São Paulo', '11.222.333/0001-44');

-- Clientes
INSERT INTO Clientes (nome_cliente, cpf, email, telefone, data_nasc_cliente)
VALUES
('Maria Silva', '123.456.789-00', 'maria@email.com', '21988887777', '1990-05-12'),
('João Pereira', '987.654.321-00', 'joao@email.com', '21911112222', '1985-11-03'),
('Ana Costa', '456.789.123-55', 'ana@email.com', '11955554444', '2000-02-28');

-- Livros
INSERT INTO Livros (titulo, genero, preco, quantidade, ID_autor, ID_editora)
VALUES
('Harry Potter e a Pedra Filosofal', 'Fantasia', 59.90, 100, 1, 1),
('Harry Potter e a Câmara Secreta', 'Fantasia', 65.00, 80, 1, 1),
('A Guerra dos Tronos', 'Fantasia', 89.90, 50, 2, 2),
('Dom Casmurro', 'Romance', 39.90, 60, 3, 3);

-- Vendas (1 cliente comprando 1 livro por vez)
INSERT INTO Vendas (data_venda, valor_total, ID_cliente, ID_livro)
VALUES
('2025-09-20', 59.90, 1, 1), -- Maria comprou Harry Potter 1
('2025-09-21', 89.90, 2, 3), -- João comprou A Guerra dos Tronos
('2025-09-22', 39.90, 3, 4); -- Ana comprou Dom Casmurro



----- Consultas ------	
-- Listar todos os livros
SELECT * FROM Livros;

-- Listar todos os clientes
SELECT * FROM Clientes;

-- Ver todas as vendas (com cliente e livro)
SELECT V.ID_venda, V.data_venda, C.nome_cliente, L.titulo, V.valor_total
FROM Vendas V
JOIN Clientes C ON V.ID_cliente = C.ID_cliente
JOIN Livros L ON V.ID_livro = L.ID_livro;

-- Livros mais caros que 60 reais
SELECT titulo, preco FROM Livros WHERE preco > 60;

-- Quantidade de livros em estoque
SELECT titulo, quantidade FROM Livros;


-- Atualizações de registros ---
-- Atualizar o preço de um livro
UPDATE Livros
SET preco = 69.90
WHERE titulo = 'Harry Potter e a Câmara Secreta';

-- Atualizar telefone de um cliente
UPDATE Clientes
SET telefone = '21900001111'
WHERE nome_cliente = 'Maria Silva';


-- Exclusão de registros ----

-- Excluir uma venda
DELETE FROM Vendas WHERE ID_venda = 3;

-- Excluir um cliente (só se não tiver vendas relacionadas)
DELETE FROM Clientes WHERE ID_cliente = 2;

-- Excluir um livro (só se não tiver em Vendas)
DELETE FROM Livros WHERE ID_livro = 4;





select*
from Vendas;