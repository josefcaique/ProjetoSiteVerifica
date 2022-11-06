<?php
    session_start();
    include('config.php');
    $nome = $_SESSION['nome'];
    $consulta = "SELECT * FROM produtos where empresa = '$nome' order by id_produto desc LIMIT 5";
    $con = $conexao->query($consulta) or die($conexao->error);

    if(isset($_POST['envio']))
    {
        $array = array();
        $quantidade = $_POST['quantidade'];
        for( $z = 0; $z < $quantidade; $z++ )
        {
        $x = 0;
        $y = 16;
        $Strings = '0123456789abcdefghijklmnopqrstuvwxyz';
        $qrcode = substr(str_shuffle($Strings), $x, $y);
        $descricao = $_POST['descricao'];
        $produto = $_POST['produto'];
        $cor = $_POST['cor'];
        $inserir = "INSERT INTO produtos(descricao, empresa, qrcode, modelo, produto) VALUES ('$descricao', '$nome', '$qrcode', '$cor', '$produto')";
        $query = $conexao->query($inserir);
        array_push($array, $qrcode);
        }
        $_SESSION['array'] = $array;
        header('location: teste.php');
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/empresa.css">
    <title>Principal</title>
    <style>
    *{
        margin:0;
        padding:0;
        font-family: Arial, Helvetica, sans-serif;
        border: none;
    }

    .header{
        margin: 0%;
        background-color: #36b04b;
        height: 90px;
    }

    .header h1{
        position: absolute;
        color: #ffffff;
        left:7%;
        top: 3.5%;
        display: inline-block;
    }

    .header img{
        display: inline-block;
        position: absolute;
        top:8px;
        left: 45%
    }

    .header button{
        display: inline-block;
        position: absolute;
        left: 90%;
        top: 30px;
        padding: 10px 20px;
        background-color: ddd;
        color: black;
        cursor: pointer;
        border-radius: 5px;
        
    }

    .principal{
        background-color: #89bb9168;
        height: 2000px;
        width: 1300px;
        margin-left: 300px;
    }

    .button2{
        position: absolute;
        top: 70%;
        left: 45%;
        padding: 20px 30px;
        border-radius: 5px;
        border: none;
        color: white;
        background-color: #36b04b;
        font-size: 18px;
        cursor: pointer;
    }


    .principal  h1{
        padding-top: 100px;
        color: #36b04b;
        font-size: 35px;
    }

    table, td, th{
        border: 1px solid black;
        border-collapse:  collapse;
    }

    td {
        padding: 20px 30px;
    }

    table tr:nth-child(odd){
        background-color: #ddd;
    }

    table tr:nth-child(even){
        background-color: white;
    }

    table{
        position: absolute;
        left: 35%;
        top: 26%;
    }

    .cadastro_produtos{
        width: 800px;
        background-color: white;
        position: absolute;
        top: 750px;
        left:543px;
        border-radius: 10px;
        height: 850px;
    }

    .cadastro_produtos h1{
        position: absolute;
        top: -40px;
        left: 190px;
        font-size: 35px;
    }

    .formulario{
        margin-top: 150px;
        display: flex;
        flex-wrap: wrap;
    }

    input{
        border-bottom: 2px solid black;
        color: #36b04b;
    }

    input:focus, label:focus{
        outline: none;
    }

    input, label{
        font-size: 27px;
        width: 80%;
        padding-top: 25px;
        margin-left: 80px;
    }

    #enviar{
        border-bottom: none;
        position: absolute;
        bottom: 25px;
        left: 25%;
        width: 30%;
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
<header>
    <div class='header'>
        <h1>Olá, <?php echo $_SESSION['nome']; ?></h1>
        <img src="img/logo.png" width="200px" height="80px">
        <button onclick = <?php session_destroy(); header('location: login.php');?> >Sair</button>
        
    </div>
</header>
<body>
    <div class='principal'>
            <div class = 'lista'>
                <center><h1>Seus produtos cadastrados</h1><center>
                <?php if(mysqli_num_rows($con) > 0){ ?>
                <table border="2">
                    <tr>
                        <td>ID</td>
                        <td>Produto</td>
                        <td>Descrição</td>
                        <td>Cor</td>
                        <td>QRCODE</td>
                    </tr>
                    <?php while($dado = $con->fetch_array()){ ?>
                    <tr>
                        <td><?php echo $dado["id_produto"]; ?></td> 
                        <td><?php echo $dado["produto"]; ?></td>
                        <td><?php echo $dado["descricao"]; ?></td>
                        <td><?php echo $dado["modelo"]; ?></td>
                        <td><?php echo $dado["qrcode"]; ?></td>     
                    </tr>
                    <?php } ?>
                </table>
                <?php }
                else{ ?>
                    <img src="img/cadastre.jpg">
                <?php } ?>
                 
            </div>
            <div class="botoes">
                <button class="button2">Listagem Completa</button>
            </div>
            <div class="cadastro_produtos">
                <h1>Cadastre novos produtos</h1>
            <form class= 'formulario' id="cad" method="POST">
                <label for="produto">Produto:</label>
                <input type="text" name="produto" id="produtos">
                <label for="descrição">Descrição:</label>
                <input type="text" name="descricao" id="descricao">
                <label for="cor">Cor:</label>
                <input type="text" name="cor" id="cor">
                <label for="quandidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quandidade">
                <label for="quandidade">Link foto:</label>
                <input type="text" name="foto" id="foto">
                <input type="submit" name="envio" id="enviar">
            </form>    
            </div>        
            
    </div>
</body>
</html>