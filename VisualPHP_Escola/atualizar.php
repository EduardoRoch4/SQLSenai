<?php
$coon = new mysqli("localhost", "root", "senaisp", "escola");

if ($coon->connect_error) {
    die("Erro: " . $coon->connect_error);
}

$id = $_POST['id_aluno'];
$nome = $_POST['nome'];
$data_nasc = $_POST['data_nasc'];
$CPF = $_POST['CPF'];
$endereco = $_POST['endereco'];

$sql = "UPDATE aluno 
        SET nome='$nome', data_nasc='$data_nasc', CPF='$CPF', endereço='$endereco' 
        WHERE id_aluno='$id'";

if ($coon->query($sql) === TRUE) {
    echo "Dados atualizados!";
    echo "<br><a href='listar.php'>Voltar</a>";
} else {
    echo "Erro: " . $coon->error;
}

$coon->close();
?>
