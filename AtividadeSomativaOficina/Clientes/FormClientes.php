<?php
include '../conectar.php'; 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Cliente</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="container">
    <nav>
      <a href="listarClientes.php">Listar Clientes</a>
      <a href="../index.html">Menu Principal</a>
    </nav>

    <h2>Cadastro de Cliente</h2>
    <form action="insertClientes.php" method="POST">
      <label>Nome:</label>
      <input type="text" name="nome" required>

      <label>CPF:</label>
      <input type="text" name="cpf" maxlength="14" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" 
             title="Digite o CPF no formato 000.000.000-00">

      <label>Telefone:</label>
      <input type="text" name="telefone" maxlength="13" pattern="\(\d{2}\)\d{4,5}-\d{4}" required
             title="Digite o telefone no formato (XX)XXXXX-XXXX">

      <label>Endereço:</label>
      <input type="text" name="endereco" required>

      <button type="submit">Enviar</button>
    </form>
  </div>
</body>
</html>

