<?php
// Conexão com o banco de dados
$coon = new mysqli("localhost", "root", "senaisp", "escola");

// Verifica conexão
if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Recebendo o ID via GET
$id_aluno = isset($_GET['id_aluno']) ? $_GET['id_aluno'] : null;

if (!$id_aluno) {
    die("Nenhum ID fornecido.");
}

// Deletando o registro
$sql = "DELETE FROM aluno WHERE id_aluno = '$id_aluno'";

if ($coon->query($sql) === TRUE) {
    echo "Registro deletado com sucesso!";
    echo "<br><a href='listar.php'>Voltar para lista</a>";
} else {
    echo "Erro ao delete: " . $coon->error;
}

$coon->close();
?>
