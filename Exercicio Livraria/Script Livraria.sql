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
SELECT * FROM clientes;

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

-- Consulta por campos
select nome from autores;
select genero, titulo from livros;

-- Consulta por data com condição
select nome, nacionalidade from autores
where data_nasc_autor <= 1948;

-- Consulta por crescente e decrescente
select nome, data_nasc_autor from autores
order by data_nasc_autor desc;

-- Consulta por limite de resultado
select titulo from livros
limit 3;

-- Renomear colunas com as
select titulo as nome, genero as Categoria
from livros;

-- Funções agregadas
select count(*) as Total_Livros
from livros;

select sum(preco) as Total_Valor_Livros
from livros;

select avg(preco) as Média_Valor_lLivros
from livros;

-- Agrupamentos com group by
SELECT nome, COUNT(*) as Quantidade
FROM Autores
GROUP BY nome;

-- Uso de and ou or
select titulo, preco from livros
where titulo = "Harry" or preco > 30;

select titulo, preco from livros
where titulo = "Dom Casmurro" and preco > 30;

-- Condições extras com group by, having e order by
SELECT ID_autor, COUNT(*) AS Total_Livros
FROM Livros
GROUP BY ID_autor
HAVING Total_Livros > 1
ORDER BY Total_Livros DESC;

-- Uso do like
SELECT titulo 
FROM Livros
WHERE titulo LIKE '%Harry%';

-- Uso do like com inicio por letras
SELECT titulo 
FROM Livros
WHERE titulo LIKE '%H%';

-- Uso do like com termino por letras
SELECT titulo 
FROM Livros
WHERE titulo LIKE '%Rh%';

-- Uso do like com quantidade por letras
SELECT titulo 
FROM Livros
WHERE titulo LIKE 'D__________o';

-- Atividades Feitas em aula

-- 1) Inserir 5 campos em cada tabela

INSERT INTO autores (ID_autor, nome, nacionalidade, data_nasc_autor)
VALUES
(4, 'Stephen King', 'Americano', '1947-09-21'),
(5, 'Gabriel García Márquez', 'Colombiano', '1927-03-06'),
(6, 'Clarice Lispector', 'Brasileira', '1920-12-10'),
(7, 'Agatha Christie', 'Britânica', '1890-09-15'),
(8, 'Paulo Coelho', 'Brasileiro', '1947-08-24');


INSERT INTO Editoras (nome_editora, endereco, contato, telefone, cidade, cnpj)
VALUES
('Saraiva', 'Rua do Comércio, 100', 'Lucas Mendes', '1122334455', 'São Paulo', '22.333.444/0001-55'),
('Intrínseca', 'Av. Brasil, 250', 'Fernanda Costa', '1133224455', 'Rio de Janeiro', '33.444.555/0001-66'),
('Planeta', 'Rua da Cultura, 75', 'Rafael Souza', '1144556677', 'Belo Horizonte', '44.555.666/0001-77'),
('Editora Abril', 'Av. Paulista, 1500', 'Mariana Lima', '1199887766', 'São Paulo', '55.666.777/0001-88'),
('Companhia de Bolso', 'Rua das Letras, 500', 'Carlos Oliveira', '2122334455', 'Porto Alegre', '66.777.888/0001-99');


INSERT INTO Clientes (nome_cliente, cpf, email, telefone, data_nasc_cliente)
VALUES
('Carlos Silva', '321.654.987-00', 'carlos@email.com', '21988776655', '1992-03-15'),
('Fernanda Lima', '654.987.321-00', 'fernanda@email.com', '21911223344', '1988-07-22'),
('Rafael Costa', '987.321.654-00', 'rafael@email.com', '21955667788', '1995-11-30'),
('Mariana Oliveira', '147.258.369-00', 'mariana@email.com', '21999887766', '2001-01-05'),
('Lucas Mendes', '963.852.741-00', 'lucas@email.com', '21944556677', '1998-09-12');


INSERT INTO Livros (titulo, genero, preco, quantidade, ID_autor, ID_editora)
VALUES
('O Hobbit', 'Fantasia', 49.90, 70, 2, 2),
('Cem Anos de Solidão', 'Romance', 59.90, 40, 5, 3),
('O Iluminado', 'Terror', 69.90, 30, 4, 4),
('Orgulho e Preconceito', 'Romance', 39.90, 50, 7, 5),
('O Alquimista', 'Ficção', 29.90, 60, 8, 1);


INSERT INTO Vendas (data_venda, valor_total, ID_cliente, ID_livro)
VALUES
('2025-09-23', 49.90, 1, 5), -- Maria comprou O Hobbit
('2025-09-24', 69.90, 2, 7), -- João comprou O Iluminado
('2025-09-25', 29.90, 3, 9), -- Ana comprou O Alquimista
('2025-09-26', 39.90, 4, 8), -- Mariana comprou Orgulho e Preconceito
('2025-09-27', 59.90, 5, 6); -- Lucas comprou Cem Anos de Solidão

-- 2) Trazer quantidade de livros
select count(*) as Quantidade
from livros;

-- 3) Consultar livros que começam com a letra A e o preço acima de 29,90
SELECT titulo 
FROM Livros
WHERE titulo LIKE '%A%' and preco > 29.90; 

-- 4) Demonstrar a soma dos livros vendidos
select count(*) as Soma_Venda_Livros
from Vendas;

-- 5) Demonstrar a quantidade dos livros em estoque 
select sum(quantidade) as Qtd_Livros
from livros;

-- 6) Apagar o livro com o código 5
DELETE FROM livros WHERE ID_livro = 5;

-- 7) Alterar a tabela livros e inserir a coluna ano publicação com titulo de dados DATE
ALTER TABLE Livros
ADD COLUMN ano_publicacao DATE;







