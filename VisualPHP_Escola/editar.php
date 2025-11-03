<?php
// Conexão com o banco de dados
$coon = new mysqli("localhost", "root", "senaisp", "escola");

if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Verifica se o ID foi enviado via GET
if (isset($_GET['id_aluno'])) {
    $id = $_GET['id_aluno'];

    $stmt = $coon->prepare("SELECT * FROM aluno WHERE id_aluno = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p style='text-align:center;color:red;'>Aluno não encontrado!</p>";
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
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Navegação -->
        <nav>
            <a href="listar.php">Listar Alunos</a>
            <a href = "index.html">Adcionar Alunos
            <a href = "Deletar.php">Deletar Alunos
        </nav>

        <h2>Editar Aluno</h2>

        <!-- Formulário de edição -->
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id_aluno" value="<?php echo $row['id_aluno']; ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>

            <label>Data de Nascimento:</label>
            <input type="date" name="data_nasc" value="<?php echo $row['data_nasc']; ?>" required>

            <label>CPF:</label>
            <input type="text" name="CPF" value="<?php echo $row['CPF']; ?>" required>

            <label>Endereço:</label>
            <input type="text" name="endereco" value="<?php echo htmlspecialchars($row['endereço']); ?>" required>

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>
