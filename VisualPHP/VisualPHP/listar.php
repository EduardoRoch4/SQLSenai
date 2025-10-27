<?php
// Conexão com o banco de dados (MySQLi) 
$coon = new mysqli("localhost", "root", "senaisp", "TestePHP");

// Verifica conexão
if ($coon->connect_error) {
    die("Erro de conexão: " . $coon->connect_error);
}

// Consulta ao banco de dados
$result = $coon->query("SELECT * FROM usuarios");
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>

<?php
// Exibe os dados na tabela
while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
        </td>
    </tr>
<?php } ?>
</table>
