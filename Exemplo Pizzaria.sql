create database Pizzaria;
use Pizzaria;

create table Pizzas (
ID_Pizza int,
Ingredientes varchar(100),
Nome_Pizza varchar(100),
Sabores varchar(100)
);
 
 create table Clientes (
ID_Clientes int,
CPF varchar(14),
Endereco varchar(100),
Nome_Cliente varchar(100),
Telefone varchar(20)
);
 
 create table Estoque (
ID_Estoque int,
QTD_Prod int,
Nome_Produto varchar(100),
Data_Entrada varchar(100),
Data_saida varchar(20)
);
 
create table Funcionarios (
ID_Funcionario int,
Salario int,
Nome_Funcionario varchar(100),
Celular varchar(100)
);

select * from Clientes