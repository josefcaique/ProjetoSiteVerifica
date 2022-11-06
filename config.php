<?php
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "12345";
    $dbName = "verifica";

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if ($conexao->connect_errno){
        echo "Falha";
    }