<?php
$servername = "localhost";
$username = "root";
$password = "senaisp";
$dbname = "mecanica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco: " . $conn->connect_error);
}