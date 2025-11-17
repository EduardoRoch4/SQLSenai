<?php
$conn = new mysqli("localhost", "root", "senaisp", "mecanica");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Seleciona OS com dados do veículo
$sql = "SELECT os.id_OS, os.data_abertura, os.data_fechamento, os.observacoes, os.status,
        v.id_veiculo, v.ano, v.marca, v.modelo, v.placa
        FROM OS os
        LEFT JOIN Veiculo v ON os.id_veiculo = v.id_veiculo
        ORDER BY os.data_abertura DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<link rel="stylesheet" href="../style.css">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ordens de Serviço</title>
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
            width: 95%;
            max-width: 1200px;
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

        .menu-btn {
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

        .menu-btn:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Ordens de Serviço</h2>
        <table>
            <tr>
                <th>ID OS</th>
                <th>Data Abertura</th>
                <th>Data Fechamento</th>
                <th>Status</th>
                <th>Observações</th>
                <th>ID Veículo</th>
                <th>Ano</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placa</th>
            </tr>

            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_OS']); ?></td>
                        <td><?= htmlspecialchars($row['data_abertura']); ?></td>
                        <td><?= htmlspecialchars($row['data_fechamento'] ?? '—'); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                        <td><?= htmlspecialchars($row['observacoes']); ?></td>
                        <td><?= htmlspecialchars($row['id_veiculo']); ?></td>
                        <td><?= htmlspecialchars($row['ano']); ?></td>
                        <td><?= htmlspecialchars($row['marca']); ?></td>
                        <td><?= htmlspecialchars($row['modelo']); ?></td>
                        <td><?= htmlspecialchars($row['placa']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="10" style="text-align:center;">Nenhuma ordem de serviço encontrada.</td></tr>
            <?php endif; ?>
        </table>

        <a class="menu-btn" href="../index.html">Voltar ao Menu Principal</a>
    </div>
</body>
</html>
