<?php
$coon = new mysqli("localhost", "root", "senaisp", "mecanica");

if ($coon->connect_error) {
    die("Erro: " . $coon->connect_error);
}

// aceitar tanto 'id' quanto 'id_mecanico' vindo do formulário
$id = isset($_POST['id']) ? $_POST['id'] : (isset($_POST['id_mecanico']) ? $_POST['id_mecanico'] : null);
$nome = $_POST['nome'] ?? '';
$CPF = $_POST['cpf'] ?? '';
$especialidade = $_POST['especialidade'] ?? '';

if ($id === null) {
    die('ID do funcionário não informado.');
}

// Detectar coluna de ID correta (id ou id_mecanico)
$idColumn = null;
$colRes = $coon->query("SHOW COLUMNS FROM mecanico");
if ($colRes) {
    while ($col = $colRes->fetch_assoc()) {
        if ($col['Field'] === 'id') { $idColumn = 'id'; break; }
        if ($col['Field'] === 'id_mecanico') { $idColumn = 'id_mecanico'; break; }
    }
}
if (!$idColumn) {
    die('Coluna de ID não encontrada na tabela mecanicos.');
}

$sql = "UPDATE mecanico SET nome=?, CPF=?, especialidade=? WHERE `" . $idColumn . "`=?";
$stmt = $coon->prepare($sql);
if (!$stmt) {
    die('Falha ao preparar UPDATE: ' . $coon->error);
}
$stmt->bind_param("sssi", $nome, $CPF, $especialidade, $id);

?>
<!DOCTYPE html>
<html lang="pt-BR">
        <link rel="stylesheet" href="../style.css">

<head>
    <meta charset="UTF-8">
    <title>Atualização de Mecanicos</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f8; display:flex; justify-content:center; padding:40px; }
        .message-box { background:#fff; padding:30px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1); text-align:center; max-width:500px; }
        h2 { color:#28a745; margin-bottom:20px; }
        .error { color:#dc3545; }
        a { display:inline-block; margin-top:20px; text-decoration:none; background:#0077cc; color:#fff; padding:10px 20px; border-radius:6px; font-weight:bold; }
        a:hover{ background:#005fa3; }
    </style>
</head>
<body>
    <div class="message-box">
        <?php
        if ($stmt->execute()) {
            echo "<h2>Dados do mecanico atualizados com sucesso!</h2>";
        } else {
            echo "<h2 class='error'>Erro ao atualizar: " . htmlspecialchars($stmt->error) . "</h2>";
        }
        ?>
        <a href="listarmecanicos.php">Voltar para Lista de mecanicos</a>
        <br><br>
        <a href="../index.html">Menu Principal</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$coon->close();
?>
