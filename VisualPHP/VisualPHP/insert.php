<?php
// Recebendo os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];

// Conexão com o banco de dados (MySQLi)
$coon = new mysqli("localhost", "root", "senaisp", "TestePHP");

// Verifica se houve erro na conexão
if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Comando SQL de inserção
$sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";

if ($coon->query($sql) === TRUE) {
    echo "Dados salvos com sucesso!";
} else {
    echo "Erro: " . $coon->error;
}

// Fecha a conexão
$coon->close();
?>
