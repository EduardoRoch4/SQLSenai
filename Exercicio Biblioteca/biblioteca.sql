-- Exercicio 1 - Criar o Banco de dados de uma biblioteca com 2 tabelas

create database AtividadeBiblioteca;

use AtividadeBiblioteca;

create table livro(
codigo int not null,
nome varchar (100) not null, 
ano_lancamento int not null,
autor varchar (100) not null,
primary key(codigo));

create table funcionarios(
codigo int not null,
nome varchar (100) not null, 
cargo varchar(100) not null,
salario decimal(7,2) not null,
primary key(codigo));

-- Exercicio 2 - Alterar as duas tabelas inserindo novas colunas
alter table livro
add column ISPM varchar(20);

alter table funcionarios
add column telefone varchar(20);


-- Exercicio 3 - Inserir valores e atualizar valores das duas tabelas
INSERT INTO livro (codigo, nome, ano_lancamento, autor, ISPM)
VALUES
(1, 'Dom Quixote', 1605, 'Miguel de Cervantes', '978-3-16-148410-0'),
(2, '1984', 1949, 'George Orwell', '978-0-14-103613-7'),
(3, 'O Senhor dos Anéis', 1954, 'J.R.R. Tolkien', '978-0-261-10238-3'),
(4, 'A Revolução dos Bichos', 1945, 'George Orwell', '978-0-452-28424-1'),
(5, 'Cem Anos de Solidão', 1967, 'Gabriel García Márquez', '978-0-06-088328-7');


INSERT INTO funcionarios (codigo, nome, cargo, salario, telefone)
VALUES
(1, 'Ana Souza', 'Analista', 2500.00, '(11) 91234-5678'),
(2, 'Carlos Lima', 'Gerente', 3200.50, '(21) 99876-5432'),
(3, 'Beatriz Costa', 'Assistente', 2800.75, '(31) 98765-4321'),
(4, 'João Pedro', 'Gerente', 3100.00, '(41) 97654-3210'),
(5, 'Mariana Alves', 'Analista', 2700.25, '(51) 96543-2109');

UPDATE livro 
SET nome = 'Dom-Quixote'
WHERE codigo = 1;

UPDATE funcionarios 
SET cargo = 'CEO'
WHERE codigo = 1;

select * from livro;
select * from funcionarios;


-- Exercicio 4 excluir dados
DELETE from funcionarios;
DELETE from livro;


