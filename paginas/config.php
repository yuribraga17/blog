<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Conexão com o MySQL
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Verifica se houve erro de conexão
if (!$conn) {
    die("Erro de conexão com o banco de dados: " . mysqli_connect_error());
}
?>
