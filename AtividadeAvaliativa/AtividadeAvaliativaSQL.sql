create database	AtividadeAvaliativa;

use AtividadeAvaliativa;

create table Fornecedor(
Fcodigo int auto_increment primary key,
nome varchar (100),
status varchar(100),
cidade varchar (50)
);

create table Peca(
Pcodigo int auto_increment primary key not null ,
nome varchar (100) not null,
Status varchar(100) not null,
cidade varchar (50) not null,
Icod varchar (50) not null
);

create table Instituicao(
Icodigo int auto_increment primary key ,
nome varchar (100)
);

create table Projeto(
PRcodigo int auto_increment primary key,
nome varchar (100),
cidade varchar (50),
Icod varchar (50)
);

CREATE TABLE Fornecimento (
    Fcod INT,
    Pcod INT,
    PRcod INT,
    Quantidade INT NOT NULL,
    PRIMARY KEY (Fcod, Pcod, PRcod),
    FOREIGN KEY (Fcod) REFERENCES Fornecedor(Fcodigo),
    FOREIGN KEY (Pcod) REFERENCES Peca(Pcodigo),
    FOREIGN KEY (PRcod) REFERENCES Projeto(PRcodigo)
    );
    
    CREATE TABLE Cidade (
    Ccod INT PRIMARY KEY,
	Cnome VARCHAR(100) NOT NULL,
	UF CHAR(2) NOT NULL
    );

-- Índices na tabela Fornecedor
CREATE INDEX idx_fornecedor_nome ON Fornecedor(nome);
CREATE INDEX idx_fornecedor_cidade ON Fornecedor(cidade);

-- Índices na tabela Peca
CREATE INDEX idx_peca_nome ON Peca(nome);
CREATE INDEX idx_peca_cidade ON Peca(cidade);
CREATE INDEX idx_peca_Icod ON Peca(Icod); -- útil para relacionar com Instituicao

-- Índices na tabela Projeto
CREATE INDEX idx_projeto_nome ON Projeto(nome);
CREATE INDEX idx_projeto_cidade ON Projeto(cidade);
CREATE INDEX idx_projeto_Icod ON Projeto(Icod); -- para relacionar com Instituicao

-- Índices na tabela Fornecimento
CREATE INDEX idx_fornecimento_Fcod ON Fornecimento(Fcod);
CREATE INDEX idx_fornecimento_Pcod ON Fornecimento(Pcod);
CREATE INDEX idx_fornecimento_PRcod ON Fornecimento(PRcod);

-- Índices na tabela Cidade
CREATE INDEX idx_cidade_Cnome ON Cidade(Cnome);
CREATE INDEX idx_cidade_UF ON Cidade(UF);

    
    