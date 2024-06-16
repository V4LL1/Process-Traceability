<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code da Peça</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .qr-code {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['idPeca']) && !empty($_GET['idPeca'])) {
        $idPeca = urlencode($_GET['idPeca']);
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=http://10.0.0.175/process%20Traceability/piece_details.php?idPeca={$idPeca}";
        echo "<div class=\"qr-code\"><img src=\"{$qrCodeUrl}\" alt=\"QR Code\"></div>";
    } else {
        echo "<div class=\"qr-code\">ID da peça não fornecido.</div>";
    }
    ?>
</body>
</html>
