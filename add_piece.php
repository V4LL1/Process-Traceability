<?php
include 'db.php';
include 'templates/header.php';

// Função para obter opções de uma tabela
function getOptions($table, $idField, $nameField) {
    global $conn;
    $options = "";
    $sql = "SELECT $idField, $nameField FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row[$idField] . "'>" . $row[$nameField] . "</option>";
        }
    }
    return $options;
}

$producaoOptions = getOptions('Producao', 'idProducao', 'nome');
$processoOptions = getOptions('Processo', 'idProcesso', 'nome');
$categoriaOptions = getOptions('Categoria_Peca', 'idCategoria_Peca', 'categoria');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPeca = $_POST['idPeca'];
    $nome = $_POST['nome'];
    $entrada = $_POST['entrada'];
    $Producao_idProducao = $_POST['Producao_idProducao'];
    $Processo_idProcesso = $_POST['Processo_idProcesso'];
    $Categoria_Peca_idCategoria_Peca = $_POST['Categoria_Peca_idCategoria_Peca'];
    $jaEntrou = $_POST['jaEntrou'];
    $duracao_esperada = $_POST['duracao_esperada'];

    $sql = "INSERT INTO Peca (idPeca, nome, entrada, Producao_idProducao, Processo_idProcesso, Categoria_Peca_idCategoria_Peca, jaEntrou, duracao_esperada) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issiiisi", $idPeca, $nome, $entrada, $Producao_idProducao, $Processo_idProcesso, $Categoria_Peca_idCategoria_Peca, $jaEntrou, $duracao_esperada);

    if ($stmt->execute()) {
        echo "<p>Peça adicionada com sucesso!</p>";
    } else {
        echo "<p>Erro ao adicionar peça: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<h2>Adicionar Nova Peça</h2>
<form method="post" action="add_piece.php">
    <label for="idPeca">ID da Peça:</label>
    <input type="number" id="idPeca" name="idPeca" required><br>

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br>

    <label for="entrada">Data de Entrada:</label>
    <input type="datetime-local" id="entrada" name="entrada" required><br>

    <label for="Producao_idProducao">Produção:</label>
    <select id="Producao_idProducao" name="Producao_idProducao" required>
        <?php echo $producaoOptions; ?>
    </select><br>

    <label for="Processo_idProcesso">Processo:</label>
    <select id="Processo_idProcesso" name="Processo_idProcesso" required>
        <?php echo $processoOptions; ?>
    </select><br>

    <label for="Categoria_Peca_idCategoria_Peca">Categoria da Peça:</label>
    <select id="Categoria_Peca_idCategoria_Peca" name="Categoria_Peca_idCategoria_Peca" required>
        <?php echo $categoriaOptions; ?>
    </select><br>

    <label for="jaEntrou">Já Entrou:</label>
    <input type="text" id="jaEntrou" name="jaEntrou"><br>

    <label for="duracao_esperada">Duração Esperada:</label>
    <input type="number" id="duracao_esperada" name="duracao_esperada" required><br>

    <button type="submit">Adicionar Peça</button>
</form>

<?php include 'templates/footer.php'; ?>
