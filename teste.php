<?php
    session_start();
    $array = $_SESSION['array'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qrcode</title>
    <style>
        .botao{
            padding: 20px 30px;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: #36b04b;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php 
    foreach ($array as $valor) { ?>
        <center><img id="teste" src=<?php echo "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=" .$valor ?>><center>
        <br>
        <br>
        <?php } ?>

        <button class='botao' onclick="javascript:window.print();">Imprimir</button>
        
</body>
</html>