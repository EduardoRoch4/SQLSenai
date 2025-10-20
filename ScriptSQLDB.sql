create database DB_joins;
use DB_joins;

create table cliente(
idCliente char(3) not null primary key,
nome varchar(40) not null,
endereco varchar (50) not null, 
cidade varchar(20),
estado char(2) not null,
cep char(9) not null
);

CREATE TABLE vendas (
duplicatas CHAR(6) NOT NULL PRIMARY KEY,
valor DECIMAL(10,2) NOT NULL,
vencimento DATE NOT NULL, 
idCliente CHAR(3) NOT NULL,
FOREIGN KEY (idCliente) REFERENCES cliente(idCliente)
);

insert into cliente values(
'250','Banco Barca S/A','R.Vito, 34','Sao Sebastiao','CE', '62380-000'
);

insert into cliente values(
'820','Mecanica Sao Paulo','R.Do Macuco, 99','Santo Antonio','ES', '29810-020'
);

insert into cliente values(
'652','Mercado Sao Joao','R.Do Marcio, 55','Espirito Santos','ES', '75602-698'
);

INSERT INTO cliente VALUES
('654', 'Supermercado Alfa', 'Rua das Flores, 200', 'Vila Velha', 'ES', '29100-000');

INSERT INTO cliente VALUES
('653', 'Loja Bom Preco', 'Av. Central, 100', 'Vitória', 'ES', '29000-000');




insert into vendas values(
'230001','1300.00','2001-06-10','250'
);

insert into vendas values(
'367425','2500.00','2010-01-13','652'
);

insert into vendas values(
'220001','6300.00','2009-06-10','653'
);

insert into vendas values(
'220001','6300.00','2009-06-10','653'
);


insert into vendas values(
'965818','3500.00','2001-11-11','654'
);


-- Consultas
SELECT vendas.duplicatas, cliente.nome
FROM cliente, vendas
WHERE cliente.idCliente = vendas.idCliente;

-- Com inner join
SELECT vendas.duplicatas, cliente.nome
FROM cliente
INNER JOIN vendas
ON cliente.idCliente = vendas.idCliente;

-- Com alias
SELECT v.duplicatas, c.nome
FROM cliente AS c
INNER JOIN vendas AS v
ON c.idCliente = v.idCliente;

-- Com Order by
SELECT ven.duplicatas, c.nome
FROM cliente AS c
INNER JOIN vendas AS ven
ON c.idCliente = ven.idCliente
ORDER BY c.nome;

-- Com left join
SELECT ven.duplicatas, cli.nome
FROM cliente AS cli
LEFT JOIN vendas AS ven
ON cli.idCliente = ven.idCliente
ORDER BY cli.nome;

-- Com right join
SELECT ven.duplicatas, cli.nome
FROM cliente AS cli
right JOIN vendas AS ven
ON cli.idCliente = ven.idCliente
ORDER BY cli.nome;

-- Quantidade 
SELECT cliente.nome, COUNT(*) AS QTDE
FROM cliente
INNER JOIN vendas
ON cliente.idCliente = vendas.idCliente
GROUP BY cliente.nome;

-- Soma
SELECT cliente.nome, SUM(vendas.valor) AS Total
FROM cliente
INNER JOIN vendas
ON cliente.idCliente = vendas.idCliente
GROUP BY cliente.nome;





