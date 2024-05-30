<?php
include 'db.php';
include 'templates/header.php';

if (isset($_GET['idPeca'])) {
    $idPeca = $_GET['idPeca'];

    $sql = "SELECT * FROM Peca WHERE idPeca = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPeca);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Detalhes da Peça</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>ID: " . $row['idPeca'] . "</p>";
            echo "<p>Nome: " . $row['nome'] . "</p>";
            echo "<p>Entrada: " . $row['entrada'] . "</p>";
            echo "<p>Saída: " . $row['saida'] . "</p>";
            echo "<p>ID da Produção: " . $row['Producao_idProducao'] . "</p>";
            echo "<p>ID do Processo: " . $row['Processo_idProcesso'] . "</p>";
            echo "<p>ID da Categoria: " . $row['Categoria_Peca_idCategoria_Peca'] . "</p>";
            echo "<p>Já Entrou: " . $row['jaEntrou'] . "</p>";
            echo "<p>Já Saiu: " . $row['jaSaiu'] . "</p>";
            echo "<p>Dias de Atraso: " . $row['dias_atraso'] . "</p>";
            echo "<p>Duração Esperada: " . $row['duracao_esperada'] . "</p>";
        }
    } else {
        echo "<p>Nenhuma peça encontrada com o ID $idPeca.</p>";
    }
    
    $stmt->close();
}

include 'templates/footer.php';
?>
