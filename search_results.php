<?php
include 'db.php';
include 'templates/header.php';

$idPeca = $_GET['idPeca'] ?? '';
$Processo_idProcesso = $_GET['Processo_idProcesso'] ?? '';
$Categoria_Peca_idCategoria_Peca = $_GET['Categoria_Peca_idCategoria_Peca'] ?? '';
$useProcesso = isset($_GET['useProcesso']);
$useCategoria = isset($_GET['useCategoria']);

$sql = "SELECT * FROM Peca WHERE 1=1";

if ($idPeca !== '') {
    $sql .= " AND idPeca = " . intval($idPeca);
}
if ($useProcesso && $Processo_idProcesso !== '') {
    $sql .= " AND Processo_idProcesso = " . intval($Processo_idProcesso);
}
if ($useCategoria && $Categoria_Peca_idCategoria_Peca !== '') {
    $sql .= " AND Categoria_Peca_idCategoria_Peca = " . intval($Categoria_Peca_idCategoria_Peca);
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Resultados da Pesquisa</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='piece_details.php?idPeca=" . $row['idPeca'] . "'>" . $row['nome'] . " (ID: " . $row['idPeca'] . ")</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>Nenhuma peça encontrada.</p>";
}

$conn->close();
include 'templates/footer.php';
?>
