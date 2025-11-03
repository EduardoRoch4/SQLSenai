<?php
// Conexão com o banco de dados (MySQLi)
$coon = new mysqli("localhost", "root", "senaisp", "TestePHP");

// Verifica a conexão
if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Verifica se recebeu o ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta segura ao banco de dados
    $stmt = $coon->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Usuário não encontrado!";
        exit;
    }
} else {
    echo "ID não informado!";
    exit;
}
?>

<form action="atualizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    Nome: <input type="text" name="nome" value="<?php echo $row['nome']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>

    <input type="submit" value="Atualizar">
</form>
