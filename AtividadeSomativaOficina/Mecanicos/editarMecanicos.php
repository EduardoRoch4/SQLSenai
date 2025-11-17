<?php
$coon = new mysqli("localhost", "root", "senaisp", "mecanica");

if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

if (isset($_GET['id']) || isset($_GET['id_mecanico'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : $_GET['id_mecanico'];

    // Detectar qual coluna de ID existe na tabela: 'id' ou 'id_mecanico'
    $idColumn = null;
    $colRes = $coon->query("SHOW COLUMNS FROM mecanico");
    if ($colRes) {
        while ($col = $colRes->fetch_assoc()) {
            if ($col['Field'] === 'id') { $idColumn = 'id'; break; }
            if ($col['Field'] === 'id_mecanico') { $idColumn = 'id_mecanico'; break; }
        }
    }
    if (!$idColumn) {
        echo "<p style='text-align:center;color:red;'>Coluna de ID não encontrada na tabela mecanicos.</p>";
        exit;
    }

    $sql = "SELECT * FROM mecanico  WHERE `" . $idColumn . "` = ?";
    $stmt = $coon->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p style='text-align:center;color:red;'>Mecanico não encontrado!</p>";
        exit;
    }
} else {
    echo "<p style='text-align:center;color:red;'>ID não informado!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Mecanico</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <nav>
            <a href="listarmecanicos.php">Listar Mecanicos</a>
            <a href="formMecanicos.html">Adicionar Mecanicos</a>
            <a href="../index.html">Menu Principal</a>
        </nav>

        <h2>Editar Mecanico</h2>

        <form action="atualizarMecanicos.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row[$idColumn]); ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome'] ?? ''); ?>" required>


            <label>CPF:</label>
            <input type="text" name="cpf" value="<?php echo htmlspecialchars($row['cpf'] ?? ''); ?>" required>

            <label>Especialidade:</label>
            <input type="text" name="especialidade" value="<?php echo htmlspecialchars($row['especialidade'] ?? ''); ?>" required>
            
            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>
