<?php


    if(isset($_POST['submit']))
    {   
        include('config.php');
        $empresa = $_POST['Nome_cadastro'];
        $cnpj = $_POST['cnpj_cadastro'];
        $email = $_POST['email_cadastro'];
        $senha = $_POST['senha_cadastro'];

        $select = "SELECT * FROM empresas where cnpj = '$cnpj' or email = '$email'";
        $sql = "INSERT INTO empresas(nome, CNPJ, email, senha) values('$empresa', '$cnpj', '$email', '$senha')";

        $result = $conexao->query($select);
        if(mysqli_num_rows($result) < 1)
        {
            $adicionar =  $conexao->query($sql);
        }
        else
        {
            echo "Conta ja cadastrada!";
        }
    }
    session_start();
    if(isset($_POST['logar']))
    {
        include('config.php');
        $lcnpj = $_POST['cnpj'];
        $lsenha = $_POST['senha'];

        $select = "SELECT * FROM empresas where cnpj = '$lcnpj' and senha = '$lsenha'";
        $result = $conexao->query($select);
        if(mysqli_num_rows($result) == 1)
        {
            $dados = mysqli_fetch_array($result);
            $_SESSION['logado'] = true;
            $_SESSION['id_usuario'] = $dados['id'];
            $_SESSION['nome'] = $dados['nome'];
            header('location: principal.php');
        }
        else
        {
            echo "email ou senha incoreto!";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(90deg, #ebf3e7, green);
        }

        .bloco-login{
            background-color: #ffffff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding-left: 800px;
            padding-top: 200px;
            border-radius: 15px;
            color: #36b04b;
            
        }

        input{
            padding: 10px;
            outline: none;
            font-size: 15px;
            border-radius: 10px;  
        }

        button{
           background-color: #36b04b;
           color: white;
           border: none;
           padding: 15px;
           width: 100%;
           border-radius: 15px;
           font-size: 18px;
           cursor: pointer;
        }

        button:hover{
            background-color: #4bf367;
        }

        .cadastro{
            position: relative;
            right: 650px;
            bottom: 80px;
        }

        .login{
            position: relative;
            right: 200px;
            bottom: 330px;
        }

        #submit{
            background-color: #36b04b;
           color: white;
           border: none;
           padding: 15px;
           width: 100%;
           border-radius: 15px;
           font-size: 18px;
           cursor: pointer;
        }
    </style>


</head>
<body>
    <div class="bloco-login">
        <form action='login.php' method="POST">
            <div class="cadastro">
                <h1>Cadastrar Empresa</h1>
                <input type="text" name="Nome_cadastro" placeholder="Nome Empresa">
                <br><br>
                <input type="text" name="cnpj_cadastro" placeholder="CNPJ">
                <br><br>
                <input type="email" name="email_cadastro" placeholder="Email">
                <br><br>
                <input type="password" name="senha_cadastro" placeholder="Senha">
                <br><br>
                <input type="submit" name="submit" placeholder="Enviar" id="submit">
            </div>
        <form action='' method="POST">
            <div class="login">
                <h1>Entrar</h1>
                <input type="text" name ="cnpj" placeholder="CNPJ">
                <br><br>
                <input type="password" name="senha" placeholder="Senha">
                <br><br>
                <input type="submit" name="logar" placeholder="Enviar" id="submit">
        </div>
    </div>
</body>
</html>