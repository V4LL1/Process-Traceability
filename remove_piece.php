<?php
include 'db.php';
include 'templates/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPeca = intval($_POST['idPeca']);

    $sql = "DELETE FROM Peca WHERE idPeca = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPeca);

    if ($stmt->execute()) {
        echo "<p>Peça removida com sucesso!</p>";
    } else {
        echo "<p>Erro ao remover peça: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<h2>Remover Peça</h2>
<form method="post" action="remove_piece.php">
    <label for="idPeca">ID da Peça:</label>
    <input type="number" id="idPeca" name="idPeca" required><br>
    <button type="submit">Remover Peça</button>
</form>

<?php include 'templates/footer.php'; ?>
