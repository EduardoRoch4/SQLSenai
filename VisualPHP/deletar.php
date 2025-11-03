<?php
// Conexão com o banco de dados
$coon = new mysqli("localhost", "root", "senaisp", "TestePHP");

// Verifica conexão
if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Recebendo o ID via GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    die("Nenhum ID fornecido.");
}

// Deletando o registro
$sql = "DELETE FROM usuarios WHERE id = '$id'";

if ($coon->query($sql) === TRUE) {
    echo "Registro deletado com sucesso!";
    echo "<br><a href='listar.php'>Voltar para lista</a>";
} else {
    echo "Erro ao deletar: " . $coon->error;
}

$coon->close();
?>
