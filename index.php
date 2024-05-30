<?php include 'templates/header.php'; ?>

<h2>Buscar Peça</h2>
<form action="search.php" method="get">
    <label for="idPeca">ID da Peça:</label>
    <input type="number" id="idPeca" name="idPeca" required>
    <button type="submit">Buscar</button>
</form>

<?php include 'templates/footer.php'; ?>
