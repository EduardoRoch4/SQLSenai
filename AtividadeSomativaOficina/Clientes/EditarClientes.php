<?php
require_once "../conectar.php";

$msg = '';
$msgClass = '';
$cliente = null;

if (!isset($_GET['id_cliente']) || empty($_GET['id_cliente'])) {
    $msg = "ID não informado!";
    $msgClass = "error";
} else {
    $id = (int) $_GET['id_cliente'];

    $stmt = $conn->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $msg = "Cliente não encontrado!";
        $msgClass = "error";
    } else {
        $cliente = $result->fetch_assoc();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 40px; display: flex; justify-content: center; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 400px; }
        .message-box.success h2 { color: #28a745; }
        .message-box.error h2 { color: #dc3545; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #0077cc; color: white; border: none; border-radius: 6px; cursor: pointer; }
        button:hover { background-color: #005fa3; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #0077cc; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($cliente): ?>
            <h2>Editar Cliente</h2>
            <form action="AtualizarClientes.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
                
                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>

                <label>CPF:</label>
                <input type="text" name="cpf" value="<?php echo htmlspecialchars($cliente['cpf']); ?>" required>

                <label>Telefone:</label>
                <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required>

                <label>Endereço:</label>
                <input type="text" name="endereco" value="<?php echo htmlspecialchars($cliente['endereco']); ?>" required>

                <button type="submit">Atualizar Cliente</button>
            </form>
        <?php else: ?>
            <div class="message-box <?php echo $msgClass; ?>">
                <h2><?php echo htmlspecialchars($msg); ?></h2>
                <a href="ListarClientes.php">Voltar para Lista de Clientes</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
