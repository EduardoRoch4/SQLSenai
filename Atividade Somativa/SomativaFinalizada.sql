create database PlataformaCursos;

use PlataformaCursos;


-------- Parte 2 ---------

CREATE TABLE Alunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    email VARCHAR(100),
    data_nascimento DATE
);

CREATE TABLE Cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100),
    descricao TEXT,
    carga_horaria INT,
    status ENUM('ativo', 'inativo')
);

CREATE TABLE Inscricoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    aluno_id INT,
    curso_id INT,
    data_inscricao DATE,
    FOREIGN KEY (aluno_id) REFERENCES Alunos(id),
    FOREIGN KEY (curso_id) REFERENCES Cursos(id)
);

CREATE TABLE Avaliacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    inscricao_id INT UNIQUE,
    nota DECIMAL(4,2),
    comentario TEXT,
    FOREIGN KEY (inscricao_id) REFERENCES Inscricoes(id)
);

-------- Parte 3 ---------

-- Alunos
INSERT INTO Alunos (nome, email, data_nascimento) VALUES
('Ana Souza', 'ana@email.com', '1998-05-12'),
('Bruno Lima', NULL, '1994-11-23'),
('Carlos Mendes', 'carlos@email.com', '1990-07-30'),
('Daniela Rocha', 'daniela@email.com', '2000-01-15'),
('Eduardo Silva', 'eduardo@email.com', '1996-09-08');

-- Cursos
INSERT INTO Cursos (titulo, descricao, carga_horaria, status) VALUES
('Matemática Básica', 'Curso introdutório de matemática', 40, 'ativo'),
('História Geral', 'Panorama histórico mundial', 35, 'ativo'),
('Programação em Python', 'Curso de introdução à programação', 50, 'ativo'),
('Inglês Intermediário', 'Curso de inglês nível médio', 30, 'ativo'),
('Filosofia Moderna', 'Estudo dos pensadores modernos', 25, 'inativo');

-- Inscrições
INSERT INTO Inscricoes (aluno_id, curso_id, data_inscricao) VALUES
(1, 1, '2025-09-01'),
(2, 2, '2025-09-02'),
(3, 3, '2025-09-03'),
(4, 4, '2025-09-04'),
(5, 5, '2025-09-05');

-- Avaliações
INSERT INTO Avaliacoes (inscricao_id, nota, comentario) VALUES
(1, 0, 'Péssimo'),
(2, 6, 'Passou raspando'),
(3, 9.5, 'Excelente desempenho'),
(4, 8.0, 'Bom, mas pode melhorar'),
(5, 10.0, 'Nota máxima!');

-------- Parte 4 ---------
-- Atualizar email de um aluno
UPDATE Alunos SET email = 'ana.souza@email.com' WHERE id = 1;

-- Alterar carga horária de um curso
UPDATE Cursos SET carga_horaria = 45 WHERE id = 2;

-- Corrigir nome de aluno
UPDATE Alunos SET nome = 'Bruno Oliveira' WHERE id = 2;

-- Mudar status de curso
UPDATE Cursos SET status = 'ativo' WHERE id = 5;

-- Alterar nota de uma avaliação
UPDATE Avaliacoes SET nota = 9.0 WHERE id = 2;

-------- Parte 5 ---------

-- Excluir uma inscrição
DELETE FROM Inscricoes WHERE id = 1;

-- Excluir um curso
DELETE FROM Cursos WHERE id = 4;

-- Excluir uma avaliação ofensiva
DELETE FROM Avaliacoes WHERE comentario LIKE '%ofensivo%';

-- Excluir um aluno
DELETE FROM Alunos WHERE id = 5;

-- Excluir todas inscrições de um curso encerrado
DELETE FROM Inscricao WHERE curso_id IN (
    SELECT id FROM Curso WHERE status = 'inativo'
);

-------- Parte 6 ---------

-- 1. Listar todos os alunos cadastrados
SELECT * FROM Alunos;

-- 2. Exibir apenas os nomes e e-mails dos alunos
SELECT nome, email FROM Alunos;

-- 3. Listar cursos com carga horária maior que 30 horas
SELECT * FROM Cursos WHERE carga_horaria > 30;

-- 4. Exibir cursos que estão inativos
SELECT * FROM Cursos WHERE status = 'inativo';

-- 5. Buscar alunos nascidos após o ano 1995
SELECT * FROM Alunos WHERE YEAR(data_nascimento) > 1995;

-- 6. Exibir avaliações com nota acima de 9
SELECT * FROM Avaliacoes WHERE nota > 9;

-- 7. Contar quantos cursos estão cadastrados
SELECT COUNT(*) AS total_cursos FROM Cursos;

-- 8. Listar os 3 cursos com maior carga horária
SELECT * FROM Cursos ORDER BY carga_horaria DESC LIMIT 3;

----------- Parte 7 ---------
CREATE INDEX idx_email_aluno ON alunos(email);

