<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databaseV1";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
//echo "Conexão bem-sucedida!";
?>
