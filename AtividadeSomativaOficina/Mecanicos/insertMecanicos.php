<?php
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$especialidade = $_POST['especialidade'];

$coon = new mysqli("localhost", "root", "senaisp", "mecanica");

if ($coon->connect_error) {
  die("Erro de conexão: " . $coon->connect_error);
}

$stmt = $coon->prepare("INSERT INTO mecanico (nome, cpf, especialidade) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $cpf, $especialidade);

// Executa só uma vez e salva o resultado
$resultado = $stmt->execute();

$stmt->close();
$coon->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
      <link rel="stylesheet" href="../style.css">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Mecanico</title>
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
        h2 {
            color: #28a745;
            margin-bottom: 20px;
        }
        .error {
            color: #dc3545;
        }
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
        a:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php
        if ($resultado) {
            echo "<h2>Mecanico cadastrado com sucesso!</h2>";
        } else {
            echo "<h2 class='error'>Erro ao cadastrar!</h2>";
        }
        ?>
        <a href="listarMecanicos.php">Voltar para Lista de Mecanicos</a>
        <br><br>
        <a href="../index.html">Menu Principal</a>
    </div>
</body>
</html>
