<?php
$coon = new mysqli("localhost", "root", "senaisp", "mecanica");

$msg = '';
$msgClass = '';

if ($coon->connect_error) {
    $msg = 'Erro de conexão: ' . $coon->connect_error;
    $msgClass = 'error';
} else {
    // detectar coluna de id na tabela funcionarios
    $idCol = null;
    $colsRes = $coon->query("SHOW COLUMNS FROM mecanico");
    if ($colsRes) {
        while ($col = $colsRes->fetch_assoc()) {
            if ($col['Field'] === 'id') { $idCol = 'id'; break; }
            if ($col['Field'] === 'id_mecanico') { $idCol = 'id_mecanico'; }
        }
    }
    if ($idCol === null) {
        // fallback: tentar primeira coluna
        $colsRes = $coon->query("SHOW COLUMNS FROM mecanico");
        if ($colsRes && $first = $colsRes->fetch_assoc()) {
            $idCol = $first['Field'];
        }
    }

    if (!isset($_GET['id']) && !isset($_GET['id_mecanico'])) {
        $msg = 'ID do mecanico não especificado.';
        $msgClass = 'error';
    } else {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : (int) $_GET['id_mecanico'];
        $coon->begin_transaction();
        try {
            // Se tabela cursos tem coluna que referencia funcionário, apagar essas linhas
            $OSIdCol = null;
            $colsCursos = $coon->query("SHOW COLUMNS FROM OS");
            if ($colsCursos) {
                while ($c = $colsCursos->fetch_assoc()) {
                    if ($c['Field'] === 'id_mecanico') { $OSIdCol = 'id_mecanico'; break; }
                    if ($c['Field'] === $idCol) { $OSIdCol = $idCol; break; }
                }
            }
            if ($OSIdCol) {
                $sql = "DELETE FROM OS WHERE `" . $OSIdCol . "` = ?";
                $stmt = $coon->prepare($sql);
                if ($stmt === false) throw new Exception('Falha ao preparar exclusão em OS: ' . $coon->error);
                $stmt->bind_param('i', $id);
                if (!$stmt->execute()) throw new Exception('Erro ao excluir OS: ' . $stmt->error);
                $stmt->close();
            }

            // Agora exclui o funcionário
            $sql2 = "DELETE FROM mecanico WHERE `" . $idCol . "` = ?";
            $stmt = $coon->prepare($sql2);
            if ($stmt === false) throw new Exception('Falha ao preparar exclusão em mecanico: ' . $coon->error);
            $stmt->bind_param('i', $id);
            if (!$stmt->execute()) throw new Exception('Erro ao excluir mecanico: ' . $stmt->error);
            $stmt->close();

            $coon->commit();
            $msg = 'Mecanico excluído com sucesso!';
            $msgClass = 'success';
        } catch (Exception $e) {
            $coon->rollback();
            $msg = 'Erro ao excluir mecanico (transação revertida): ' . $e->getMessage();
            $msgClass = 'error';
        }
    }
    $coon->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exclusão de Mecanico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            padding: 40px;
        }
        .message-box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }
        .message-box h2 { margin-bottom: 20px; }
        .message-box.success h2 { color: #28a745; }
        .message-box.error h2 { color: #dc3545; }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #0077cc;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        a:hover { background-color: #005fa3; }
    </style>
</head>
<body>
    <div class="message-box <?php echo $msgClass; ?>">
        <h2><?php echo htmlspecialchars($msg); ?></h2>
        <a href="listarMecanicos.php">Voltar para Lista de Mecanicos</a>
        <br><br>
        <a href="../index.html">Menu Principal</a>
    </div>
</body>
</html>
