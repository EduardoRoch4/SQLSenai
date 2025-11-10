<?php
$conn = new mysqli("localhost", "root", "senaisp", "oficina");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Buscar todos os clientes
$result = $conn->query("SELECT * FROM clientes ORDER BY nome");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            padding: 5px 20px;
            border-radius: 5px;
            margin-right: 5px;
            display: inline-block;
            margin-bottom: 10px; 
        }

        .btnExcluir {
            background-color: #dc3545;
        }

        .menu-btn {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background-color: #0077cc;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .menu-btn:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Clientes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_cliente']); ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['cpf']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($row['endereco']); ?></td>
                    <td>
                        <?php $clienteId = isset($row['id_cliente']) ? intval($row['id_cliente']) : ''; ?>
                        <a class="btn" href="editarClientes.php?id_cliente=<?php echo $clienteId; ?>">Editar</a>
                        <a class="btnExcluir" href="excluirClientes.php?id_cliente=<?php echo $clienteId; ?>" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <a class="menu-btn" href="../index.html">Voltar ao Menu Principal</a>
        <a class="menu-btn" href="FormClientes.php">Cadastrar Cliente</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
