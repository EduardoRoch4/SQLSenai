<?php
$msg = '';
$msgClass = '';

$coon = new mysqli("localhost", "root", "senaisp", "oficina");
if ($coon->connect_error) {
    $msg = 'Erro de conexão: ' . $coon->connect_error;
    $msgClass = 'error';
} else {
    if (!isset($_GET['id_cliente'])) {
        $msg = 'ID do cliente não especificado.';
        $msgClass = 'error';
    } else {
        $id = (int) $_GET['id_cliente'];
        try {
            $coon->begin_transaction();

            // 1️⃣ Buscar todos os veículos do cliente
            $stmtVeiculos = $coon->prepare('SELECT id_veiculo FROM veiculo WHERE id_cliente = ?');
            $stmtVeiculos->bind_param('i', $id);
            $stmtVeiculos->execute();
            $resultVeiculos = $stmtVeiculos->get_result();
            $veiculos = [];
            while ($row = $resultVeiculos->fetch_assoc()) {
                $veiculos[] = $row['id_veiculo'];
            }
            $stmtVeiculos->close();

            // 2️⃣ Excluir OS de cada veículo
            if (!empty($veiculos)) {
                $ids = implode(',', $veiculos);
                $coon->query("DELETE FROM os WHERE id_veiculo IN ($ids)");
            }

            // 3️⃣ Excluir veículos do cliente
            $stmtExcluirVeiculos = $coon->prepare('DELETE FROM veiculo WHERE id_cliente = ?');
            $stmtExcluirVeiculos->bind_param('i', $id);
            $stmtExcluirVeiculos->execute();
            $stmtExcluirVeiculos->close();

            // 4️⃣ Excluir cliente
            $stmtCliente = $coon->prepare('DELETE FROM clientes WHERE id_cliente = ?');
            $stmtCliente->bind_param('i', $id);
            $stmtCliente->execute();
            $stmtCliente->close();

            $coon->commit();

            $msg = 'Cliente, veículos e ordens de serviço excluídos com sucesso!';
            $msgClass = 'success';
        } catch (Exception $e) {
            $coon->rollback();
            $msg = 'Erro ao excluir cliente: ' . $e->getMessage();
            $msgClass = 'error';
        }
    }
    $coon->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<link rel="stylesheet" href="../style.css">
<head>
    <meta charset="UTF-8">
    <title>Exclusão de Cliente</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f8; display: flex; justify-content: center; padding: 40px; }
        .message-box { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; max-width: 500px; }
        .message-box h2 { margin-bottom: 20px; }
        .message-box.success h2 { color: #28a745; }
        .message-box.error h2 { color: #dc3545; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; background-color: #0077cc; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; transition: background-color 0.3s; }
        a:hover { background-color: #005fa3; }
    </style>
</head>
<body>
    <div class="message-box <?php echo $msgClass; ?>">
        <h2><?php echo htmlspecialchars($msg); ?></h2>
        <a href="listarClientes.php">Voltar para Lista de clientes</a>
        <br><br>
        <a href="../index.html">Menu Principal</a>
    </div>
</body>
</html>
