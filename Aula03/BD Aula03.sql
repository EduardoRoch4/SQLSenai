create database Biblioteca;

use Biblioteca;

create table Livros (
id_livro int auto_increment primary key not null,
ano_publicacao year not null,
titulo varchar(100) not null,
genero varchar (100) not null,
autor varchar(100) not null
);

create table Usuarios (
id_usuario int auto_increment primary key not null,
telefone varchar(100) not null,
nome varchar(100) not null,
email varchar (100) not null,
data_cadastro date not null
);

create table Funcionarios (
id_funcionario int auto_increment primary key not null,
nome varchar(100) not null,
cargo varchar (100) not null,
salario decimal(10,2) not null,
ano_publicacao year not null
);


create table Emprestimos (
id_emprestimo int auto_increment primary key not null,
id_livro int not null,
id_usuario int not null,
data_emprestimo year not null,
foreign key (id_livro) references  Livros (id_livro),
foreign key (id_usuario) references Usuarios(id_usuario)
);


create table reservas (
id_reserva int auto_increment primary key not null,
id_livro int not null,
id_usuario int not null,
data_reserva date not null,
status varchar(100) not null,
foreign key (id_livro) references  Livros (id_livro),
foreign key (id_usuario) references Usuarios(id_usuario)
);

select * from reservas

