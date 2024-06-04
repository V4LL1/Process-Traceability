<?php
include 'db.php';
include 'templates/header.php';

// Função para obter opções de uma tabela
function getOptions($table, $idField, $nameField, $selectedValue = null) {
    global $conn;
    $options = "";
    $sql = "SELECT $idField, $nameField FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selected = ($selectedValue == $row[$idField]) ? "selected" : "";
            $options .= "<option value='" . $row[$idField] . "' $selected>" . $row[$nameField] . "</option>";
        }
    }
    return $options;
}

if (isset($_GET['idPeca'])) {
    $idPeca = $_GET['idPeca'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $entrada = $_POST['entrada'];
        $Producao_idProducao = intval($_POST['Producao_idProducao']);
        $Processo_idProcesso = intval($_POST['Processo_idProcesso']);
        $Categoria_Peca_idCategoria_Peca = intval($_POST['Categoria_Peca_idCategoria_Peca']);
        $jaEntrou = $_POST['jaEntrou'];
        $duracao_esperada = intval($_POST['duracao_esperada']);

        $sql = "UPDATE Peca SET nome=?, entrada=?, Producao_idProducao=?, Processo_idProcesso=?, Categoria_Peca_idCategoria_Peca=?, jaEntrou=?, duracao_esperada=? WHERE idPeca=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiiisii", $nome, $entrada, $Producao_idProducao, $Processo_idProcesso, $Categoria_Peca_idCategoria_Peca, $jaEntrou, $duracao_esperada, $idPeca);

        if ($stmt->execute()) {
            echo "<p>Peça atualizada com sucesso!</p>";
        } else {
            echo "<p>Erro ao atualizar peça: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $sql = "SELECT * FROM Peca WHERE idPeca = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPeca);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $processoOptions = getOptions('Processo', 'idProcesso', 'nome', $row['Processo_idProcesso']);
        $categoriaOptions = getOptions('Categoria_Peca', 'idCategoria_Peca', 'categoria', $row['Categoria_Peca_idCategoria_Peca']);
        $producaoOptions = getOptions('Producao', 'idProducao', 'nome', $row['Producao_idProducao']);
?>

<h2>Editar Peça</h2>
<form method="post" action="edit_piece.php?idPeca=<?php echo $idPeca; ?>">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required><br>

    <label for="entrada">Entrada:</label>
    <input type="datetime-local" id="entrada" name="entrada" value="<?php echo $row['entrada']; ?>" required><br>

    <label for="Producao_idProducao">Produção:</label>
    <select id="Producao_idProducao" name="Producao_idProducao">
        <?php echo $producaoOptions; ?>
    </select><br>

    <label for="Processo_idProcesso">Processo:</label>
    <select id="Processo_idProcesso" name="Processo_idProcesso">
        <?php echo $processoOptions; ?>
    </select><br>

    <label for="Categoria_Peca_idCategoria_Peca">Categoria da Peça:</label>
    <select id="Categoria_Peca_idCategoria_Peca" name="Categoria_Peca_idCategoria_Peca">
        <?php echo $categoriaOptions; ?>
    </select><br>

    <label for="jaEntrou">Já Entrou:</label>
    <input type="text" id="jaEntrou" name="jaEntrou" value="<?php echo $row['jaEntrou']; ?>" required><br>

    <label for="duracao_esperada">Duração Esperada:</label>
    <input type="number" id="duracao_esperada" name="duracao_esperada" value="<?php echo $row['duracao_esperada']; ?>" required><br>

    <button type="submit">Salvar</button>
</form>

<?php
    } else {
        echo "<p>Peça não encontrada.</p>";
    }

    $stmt->close();
} else {
    echo "<p>ID da peça não especificado.</p>";
}

$conn->close();
include 'templates/footer.php';
?>
