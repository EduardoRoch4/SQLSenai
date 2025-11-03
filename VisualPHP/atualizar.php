<?php
// Conexão com o banco de dados (MySQLi)
$coon = new mysqli("localhost", "root", "senaisp", "TestePHP");

// Verifica a conexão
if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Recebendo os dados do formulário
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];

// Atualizando os dados
$sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id='$id'";

if ($coon->query($sql) === TRUE) {
    echo "Dados atualizados com sucesso!";
    echo "<br><a href='listar.php'>Voltar para lista</a>";
} else {
    echo "Erro ao atualizar: " . $coon->error;
}

// Fecha a conexão
$coon->close();
?>
