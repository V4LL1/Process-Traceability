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

$processoOptions = getOptions('Processo', 'idProcesso', 'nome');
$categoriaOptions = getOptions('Categoria_Peca', 'idCategoria_Peca', 'categoria');
?>

<h2>Buscar Peça</h2>
<form action="search_results.php" method="get">
    <label for="idPeca">ID da Peça:</label>
    <input type="number" id="idPeca" name="idPeca"><br>

    <label for="Processo_idProcesso">Processo:</label>
    <select id="Processo_idProcesso" name="Processo_idProcesso">
        <option value="">Selecione</option>
        <?php echo $processoOptions; ?>
    </select><br>
    <input type="checkbox" id="useProcesso" name="useProcesso">
    <label for="useProcesso">Filtrar por Processo</label><br>

    <label for="Categoria_Peca_idCategoria_Peca">Categoria da Peça:</label>
    <select id="Categoria_Peca_idCategoria_Peca" name="Categoria_Peca_idCategoria_Peca">
        <option value="">Selecione</option>
        <?php echo $categoriaOptions; ?>
    </select><br>
    <input type="checkbox" id="useCategoria" name="useCategoria">
    <label for="useCategoria">Filtrar por Categoria</label><br>

    <button type="submit">Buscar</button>
</form>

<h2>Gerar QR Code para Peça</h2>
<form action="qrcode_piece.php" method="get" target="_blank">
    <label for="qrIdPeca">ID da Peça:</label>
    <input type="number" id="qrIdPeca" name="idPeca" required><br>
    <button type="submit">Gerar QR Code</button>
</form>

<br>
<button onclick="window.location.href='add_piece.php'">Adicionar Peça</button>
<button onclick="window.location.href='remove_piece.php'">Remover Peça</button>

<?php include 'templates/footer.php'; ?>
