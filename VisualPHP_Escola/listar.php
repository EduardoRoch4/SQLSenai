<?php
$coon = new mysqli("localhost", "root", "senaisp", "mecanica");

if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

$result = $coon->query("SELECT * FROM aluno");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        } {
            background-color: #218838;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data Nasc.</th>
            <th>CPF</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_aluno']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['data_nasc']; ?></td>
                <td><?php echo $row['CPF']; ?></td>
                <td><?php echo $row['endereço']; ?></td>
                <td>
                    <a href="editar.php?id_aluno=<?php echo $row['id_aluno']; ?>">Editar</a>
                    <a href="index.html?id_aluno=<?php echo $row['id_aluno']; ?>">Adicionar</a>
                    <a href="delete.php?id_aluno=<?php echo $row['id_aluno']; ?>">Deletar</a>



                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

