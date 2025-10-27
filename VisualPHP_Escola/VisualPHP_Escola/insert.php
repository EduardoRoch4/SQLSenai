<?php
// Recebendo os dados do formulário
$nome = $_POST['nome'];
$data_nasc = $_POST['data_nasc'];
$CPF = $_POST['CPF'];
$endereço = $_POST['endereço'];

// Conexão com o banco de dados (MySQLi)
$coon = new mysqli("localhost", "root", "senaisp", "escola");

// Verifica se houve erro na conexão
if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Comando SQL de inserção
$sql = "INSERT INTO aluno (nome, data_nasc, CPF, endereço) VALUES ('$nome', '$data_nasc', '$CPF', '$endereço')";

if ($coon->query($sql) === TRUE) {
    echo "Dados salvos com sucesso!";
} else {
    echo "Erro: " . $coon->error;
}

// Fecha a conexão
$coon->close();
?>
